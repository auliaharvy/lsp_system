<?php
/**
 * File UjiKompController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;
use App\Http\Resources\MasterResource;
use App\Http\Resources\UjiKompResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\UjiKomp;
use App\Laravue\Models\UjiKompApl1;
use App\Laravue\Models\UjiKompApl2;
use App\Laravue\Models\UjiKompApl2Detail;
use App\Laravue\Models\UjiKompIa01;
use App\Laravue\Models\UjiKompIa01Detail;
use App\Laravue\Models\UjiKompIa02;
use App\Laravue\Models\UjiKompIa03;
use App\Laravue\Models\UjiKompIa03Detail;
use App\Laravue\Models\UjiKompIa11;
use App\Laravue\Models\UjiKompIa11Detail;
use App\Laravue\Models\Tuk;
use App\Laravue\Models\JadwalAsesor;
use App\Laravue\Models\Skema;
use App\Laravue\Models\User;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use App\Laravue\Models\MstFrIa03;
use App\Laravue\Models\MstFrAk03;
use App\Laravue\Models\MstFrIa11;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
use App\Image;
use Carbon\Carbon;

/**
 * Class UjiKompController
 *
 * @package App\Http\Controllers\Api
 */
class UjiKompController extends BaseController
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $jadwal = Arr::get($searchParams, 'id_jadwal', '');
        $user_id = Arr::get($searchParams, 'user_id', '');
        $role = Arr::get($searchParams, 'role', '');
        $foundUser = User::where('id',$user_id)->first();

        $query = UjiKomp::query();
        $query->join('trx_uji_komp_apl_01 as b', 'b.id', '=', 'trx_uji_komp.id_apl_01');
        $query->join('trx_jadwal_asesmen as c', 'c.id', '=', 'b.id_jadwal');
        $query->join('mst_skema_sertifikasi as d', 'd.id', '=', 'b.id_skema');
        $query->join('mst_tuk as e', 'e.id', '=', 'b.id_tuk')
        ->select('trx_uji_komp.*', 'b.nik', 'b.nama_sekolah', 'b.email as email_peserta', 'c.start_date as mulai', 'c.end_date as selesai', 
        'd.skema_sertifikasi', 'd.kode_skema', 'e.nama as nama_tuk', 'c.jadwal', 'b.id_jadwal');

        if ($role === 'user') {
            $query->where('b.email', $foundUser->email);
        }
        if (!empty($jadwal)) {
            $query->where('b.id_jadwal', $jadwal);
        }

        if (!empty($keyword)) {
            $query->where('b.email', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('e.nama', 'LIKE', '%' . $keyword . '%');
        }

        return UjiKompResource::collection($query->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRules(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                // upload identitas
                $file = $request->file('identitas');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_fileId = $now . '-' . $params['nik'] . '-' . $file->getClientOriginalName();
                $file->move('uploads/users/identitas/', $nama_fileId);
                // upload foto
                $file = $request->file('foto');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_fileFoto = $now . '-' . $params['nik'] . '-' . $file->getClientOriginalName();
                $file->move('uploads/users/foto/', $nama_fileFoto);
                // upload rapot
                $file = $request->file('raport');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_fileRaport = $now . '-' . $params['nik'] . '-' . $file->getClientOriginalName();
                $file->move('uploads/users/raport/', $nama_fileRaport);
                // upload sertifikat
                $file = $request->file('sertifikat');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_fileSertifikat = $now . '-' . $params['nik'] . '-' . $file->getClientOriginalName();
                $file->move('uploads/users/sertifikat/', $nama_fileSertifikat);

                // upload ke folder file_siswa di dalam folder public
                $apl01 = UjiKompApl1::create([
                    'id_skema' => $params['id_skema'],
                    'id_tuk' => $params['id_tuk'],
                    'id_jadwal' => $params['id_jadwal'],
                    'nik' => $params['nik'],
                    'nama_lengkap' => $params['nama_lengkap'],
                    'nama_sekolah' => $params['nama_sekolah'],
                    'tempat_lahir' => $params['tempat_lahir'],
                    'tanggal_lahir' => $params['tanggal_lahir'],
                    'jenis_kelamin' => $params['jenis_kelamin'],
                    'alamat' => $params['alamat'],
                    'kode_pos' => $params['kode_pos'],
                    'no_hp' => $params['no_hp'],
                    'email' => $params['email'],
                    'tingkatan' => $params['tingkatan'],
                    'foto' => $nama_fileFoto,
                    'identitas' => $nama_fileId,
                    'raport' => $nama_fileRaport,
                    'sertifikat' => $nama_fileSertifikat,
                    'status' => 0,
                ]);

                $apl02 = UjiKompApl2::create([
                    'status' => 'kompeten',
                    'updated_by' => 1,
                ]);

                $ujiKomp = UjiKomp::create([
                    'nama_peserta' => $params['nama_lengkap'],
                    'id_asesi' => 1,
                    'id_skema' => $params['id_skema'],
                    'id_apl_01' => $apl01->id,
                    'id_apl_02' => $apl02->id,
                    'status' => 0,
                    'persentase' => 6,
                ]);

                $elemen = json_decode($params['detail_apl_02'], true);
                // return response()->json(['message' => $elemen], 200);
                for ($i = 0; $i < count($elemen); $i++) {
                    if($elemen[$i]['type'] == 'kuk') {
                        $apl02Detail = UjiKompApl2Detail::create([
                            'id_uji_komp' => $ujiKomp->id,
                            'id_apl_02' => $apl02->id,
                            'id_kuk_elemen' => $elemen[$i]['id'],
                            'is_kompeten' => $elemen[$i]['is_kompeten'],// created
                            'bukti_pendukung_id' => $elemen[$i]['jenis_bukti_id'],
                        ]);
                    }
                }

                

                DB::commit();
                return response()->json(['message' => "Sukses membuat Uji Kompetensi"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkUser(Request $request)
    {
        $params = $request->all();
        $foundUser = User::where('email',$params['email'])->first();

        if ($foundUser) {
            return response()->json(['msg' => 'User sudah terdaftar'], 200);
        } else {
            return response()->json(['msg' => 'User belum terdaftar'], 200);
        }
        // $file = base64_decode($request['signature']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newUser(Request $request)
    {
        $params = $request->all();
        
        

        $validator = Validator::make(
            $request->all(),
            array_merge(
                $this->getValidationRulesUser(),
                [
                    'password' => ['required', 'min:6'],
                    'confirmPassword' => 'same:password',
                ]
            )
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                //upload sign
                $file = $request['signature'];
                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                // membuat nama file unik
                $nama_file = $now . '-' . $params['nik'] . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

                $user = User::create([
                    'name' => $params['nama_lengkap'],
                    'email' => $params['email'],
                    'nik' => $params['nik'],
                    'nama_lengkap' => $params['nama_lengkap'],
                    'nama_sekolah' => $params['nama_sekolah'],
                    'tempat_lahir' => $params['tempat_lahir'],
                    'tanggal_lahir' => $params['tanggal_lahir'],
                    'jenis_kelamin' => $params['jenis_kelamin'],
                    'alamat' => $params['alamat'],
                    'kode_pos' => $params['kode_pos'],
                    'no_hp' => $params['no_hp'],
                    'tingkatan' => $params['tingkatan'], 
                    'signature' => $nama_file,   
                    'password' => Hash::make($params['password']),
                ]);

                $role = Role::findByName('user');
                $user->syncRoles($role);

                DB::commit();
                return response()->json(['message' => "Success Create User"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  UjiKomp $UjiKomp
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $query = UjiKomp::where('id',$id)->first();
       
        return $query;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UjiKomp $ujikom
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, UjiKomp $ujikom)
    {
        if ($ujikom === null) {
            return response()->json(['error' => 'Form APL 02 not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {

                $ujikom->id_skema = $request->get('id_skema');
                $ujikom->id_tuk = $request->get('id_tuk');
                $ujikom->nik = $request->get('nik');
                $ujikom->nama_lengkap = $request->get('nama_lengkap');
                $ujikom->nama_sekolah = $request->get('nama_sekolah');
                $ujikom->tempat_lahir = $request->get('tempat_lahir');
                $ujikom->tanggal_lahir = $request->get('tanggal_lahir');
                $ujikom->jenis_kelamin = $request->get('jenis_kelamin');
                $ujikom->alamat = $request->get('alamat');
                $ujikom->kode_pos = $request->get('kode_pos');
                $ujikom->no_hp = $request->get('no_hp');
                $ujikom->email = $request->get('email');
                $ujikom->tingkatan = $request->get('tingkatan');
                $ujikom->foto = $request->get('foto');
                $ujikom->identitas = $request->get('identitas');
                $ujikom->raport = $request->get('raport');
                $ujikom->sertifikat = $request->get('sertifikat');
                $ujikom->status = $request->get('status');
                $ujikom->save();

                DB::commit();
                return new MasterResource($ujikom);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UjiKomp $UjiKomp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            UjiKomp::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete APL 02"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  UjiKomp $UjiKomp
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function showApl01($id)
    {
       
        $query = UjiKompApl1::where('trx_uji_komp_apl_01.id',$id)
        ->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_uji_komp_apl_01.id_skema')
        ->join('mst_tuk as c', 'c.id', '=', 'trx_uji_komp_apl_01.id_tuk')
        ->join('trx_jadwal_asesmen as d', 'd.id', '=', 'trx_uji_komp_apl_01.id_jadwal')
        ->join('users as e', 'e.email', '=', 'trx_uji_komp_apl_01.email')
        ->select('trx_uji_komp_apl_01.*', 'b.skema_sertifikasi', 'b.kode_skema', 'c.nama as nama_tuk', 'd.jadwal', 'e.signature')
        ->first();
       
        return $query;
    }

    public function indexIa03(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa03::query();
        $query->where('mst_perangkat_ia_03.id_skema', $id_skema)
        ->select('mst_perangkat_ia_03.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexIa11(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa11::query();
        $query->where('mst_perangkat_ia_11.id_skema', $id_skema)
        ->select('mst_perangkat_ia_11.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexAk03(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrAk03::query();
        $query->where('mst_perangkat_ak_03.id_skema', $id_skema)
        ->select('mst_perangkat_ak_03.*');

        return MasterResource::collection($query->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeIa01(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa01(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ia01 = UjiKompIa01::create([
                    'status' => $params['status'],
                    'note' => $params['note'],
                    'updated_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_01 = $ia01->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                $elemen = $params['detail_ia_01'];
                for ($i = 0; $i < count($elemen); $i++) {
                    if($elemen[$i]['type'] == 'kuk') {
                        $ia01Detail = UjiKompIa01Detail::create([
                            'id_uji_komp' => $foundUjiKomp->id,
                            'id_ia_01' => $ia01->id,
                            'id_kuk_elemen' => $elemen[$i]['id'],
                            'is_kompeten' => $elemen[$i]['is_kompeten'],
                            'penilaian_lanjut' => $elemen[$i]['penilaian_lanjut'],
                            'updated_by' => $params['user_id'],
                        ]);
                    }
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 01"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeIa02(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ia02 = UjiKompIa02::create([
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_02 = $ia02->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();


                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 01"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeIa03(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ia03 = UjiKompIa03::create([
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'umpan_balik' => $params['umpanBalikAsesi'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_03 = $ia03->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                $elemen = $params['detail_ia_03'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia03Detail = UjiKompIa03Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ia_03' => $ia03->id,
                        'id_perangkat_ia_03' => $elemen[$i]['id'],
                        'tanggapan' => $elemen[$i]['tanggapan'],
                        'rekomendasi' => $elemen[$i]['is_kompeten'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 03"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeIa11(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa11(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ia11 = UjiKompIa11::create([
                    'komentar' => $params['komentar'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_11 = $ia11->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                $elemen = $params['detail_ia_11'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia11Detail = UjiKompIa11Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ia_11' => $ia11->id,
                        'id_perangkat_ia_11' => $elemen[$i]['id'],
                        'tanggapan' => $elemen[$i]['jawaban'],
                        'komentar' => $elemen[$i]['komentar'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 11"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    private function getValidationRules($isNew = true)
    {
        return [
            'nik' => 'required',
        ];
    }

    public function upload($fileupload, $itemuser, $folder) {
        $path = $fileupload->store('files');
        $inputangambar['url'] = $path;
        $inputangambar['user_id'] = $itemuser;
        return Image::create($inputangambar);
    }

    private function getValidationRulesIa01($isNew = true)
    {
        return [
            'note' => 'required',
        ];
    }

    private function getValidationRulesIa02($isNew = true)
    {
        return [
            'rekomendasi_asesor' => 'required',
        ];
    }

    private function getValidationRulesIa11($isNew = true)
    {
        return [
            'komentar' => 'required',
        ];
    }
    
    /**
     * @param bool $isNew
     * @return array
     */
    private function getValidationRulesUser($isNew = true)
    {
        return [
            'nama_lengkap' => 'required',
            'email' => $isNew ? 'required|email|unique:users' : 'required|email',
            // 'roles' => [
            //     'required',
            //     'array'
            // ],
        ];
    }
}
