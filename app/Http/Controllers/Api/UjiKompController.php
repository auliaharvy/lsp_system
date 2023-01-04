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
use App\Laravue\Models\UjiKompAk01;
use App\Laravue\Models\UjiKompAk03;
use App\Laravue\Models\UjiKompAk03Detail;
use App\Laravue\Models\UjiKompAk02;
use App\Laravue\Models\UjiKompAk02Detail;
use App\Laravue\Models\UjiKompAk04;
use App\Laravue\Models\UjiKompAk05;
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

    public function showApl02($id)
    {
       
        $queryApl02 = UjiKompApl2::where('trx_uji_komp_apl_02.id',$id)->first();
        $queryDetailApl02 = UjiKompApl2Detail::where('trx_uji_komp_apl_02_detail.id_apl_02',$id)->get();
       
        $data = [
            'status' => $queryApl02->status,
            'detail' => $queryDetailApl02,
        ];
        return $data;
    }

    public function showAk01($id)
    {
       
        $query = UjiKompAk01::where('trx_uji_komp_ak_01.id',$id)->first();
       
        return $query;
    }

    public function showAk05($id)
    {
       
        $query = UjiKompAk05::where('trx_uji_komp_ak_05.id',$id)->first();
       
        return $query;
    }

    public function showIa01($id)
    {
       
        $queryIa01 = UjiKompIa01::where('trx_uji_komp_ia_01.id',$id)->first();
        $queryDetailIa01 = UjiKompIa01Detail::where('trx_uji_komp_ia_01_detail.id_ia_01',$id)->get();
       
        $data = [
            'ia_01' => $queryIa01,
            // 'note' => $queryIa01->note,
            'detail' => $queryDetailIa01,
        ];
        return $data;
    }

    public function showIa02($id)
    {
       
        $query = UjiKompIa02::where('trx_uji_komp_ia_02.id',$id)->first();
       
        return $query;
    }

    public function showIa03($id)
    {
       
        $queryIa03 = UjiKompIa03::where('trx_uji_komp_ia_03.id',$id)->first();
        $queryDetailIa03 = UjiKompIa03Detail::where('trx_uji_komp_ia_03_detail.id_ia_03',$id)->get();
       
        $data = [
            'ia_03' => $queryIa03,
            // 'note' => $queryIa01->note,
            'detail' => $queryDetailIa03,
        ];
        return $data;
       
    }

    public function showIa11($id)
    {
       
        $queryIa11 = UjiKompIa11::where('trx_uji_komp_ia_11.id',$id)->first();
        $queryDetailIa11 = UjiKompIa11Detail::where('trx_uji_komp_ia_11_detail.id_ia_11',$id)->get();
       
        $data = [
            'ia_11' => $queryIa11,
            // 'note' => $queryIa01->note,
            'detail' => $queryDetailIa11,
        ];
        return $data;
       
    }
    
    public function indexIa02(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa02::query();
        $query->where('mst_perangkat_ia_02.id_skema', $id_skema)
        ->select('mst_perangkat_ia_02.*');

        return MasterResource::collection($query->paginate($limit));
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
     
        $query = MstFrIa11::query()
        ->select('mst_perangkat_ia_11.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexAk03(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $query = MstFrAk03::query()
        ->select('mst_perangkat_ak_03.*');

        return MasterResource::collection($query->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitApl01(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesSubmitApl01(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_apl_01 = $request->get('id_apl_01');
            $foundApl01 = UjiKompApl1::where('id', $id_apl_01)->first();
            try {
                $params = $request->all();
                $foundUser = User::where('id', $params['userId'])->first();
                $foundApl01->status = $params['status'];
                $foundApl01->ttd_admin = $foundUser->signature;
                $foundApl01->save();

                DB::commit();
                return response()->json(['message' => "Sukses Submit FR APL 01"], 200);
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
                        // echo $elemen[$i]['type'],
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
                // upload file
                $file = $request->file('file');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . '-' . $file->getClientOriginalName();
                $file->move('uploads/ia-02/jawaban/', $nama_file);
                $file = 'uploads/ia-02/jawaban/'.$nama_file;

                $ia02 = UjiKompIa02::create([
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'file' =>  $file,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAk01Asesi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk01(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $foundUser = User::where('email', $params['email_asesi'])->first();
                $foundAk01 = UjiKompAk01::where('id', $params['id_ak_01'])->first();

                $foundAk01->tanda_tangan_asesi = $foundUser->signature;
                $foundAk01->save();

                DB::commit();
                return response()->json(['message' => "Sukses Submit FR AK 01"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeAk01(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk01(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();

                $foundUser = User::where('email', $params['email_asesi'])->first();
                $ak01 = UjiKompAk01::create([
                    'nama_asesi' => $params['nama_asesi'],
                    'nama_asesor' => $params['nama_asesor'],
                    'verifikasi_portofolio' => $params['verifikasi_portofolio'],
                    'observasi_langsung' => $params['observasi_langsung'],
                    'hasil_tes_tulis' => $params['hasil_tes_tulis'],
                    'hasil_tes_lisan' => $params['hasil_tes_lisan'],
                    'hasil_tes_wawancara' => $params['hasil_tes_wawancara'],
                    'hari' => $params['hari'],
                    'tanggal' => $params['tanggal'],
                    'bulan' => $params['bulan'],
                    'tahun' => $params['tahun'],
                    'jam' => $params['jam'],
                    'tuk' => $params['tuk'],
                    'pernyataan_asesor' => $params['pernyataan_asesor'],
                    'pernyataan_asesi' => $params['pernyataan_asesi'],
                    'tanda_tangan_asesor' => $params['tanda_tangan_asesor'],
                    // 'tanda_tangan_asesi' => $foundUser->signature,
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_01 = $ak01->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 01"], 200);
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
    public function storeAk02(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ak02 = UjiKompAk02::create([
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'tindak_lanjut' => $params['tindak_lanjut'],
                    'komentar' => $params['komentar'],
                    'updated_by' => $params['userId'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_02 = $ak02->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                $elemen = $params['detail'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia02Detail = UjiKompAk02Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ak_02' => $ak02->id,
                        'id_unit' => $elemen[$i]['id'],
                        'observasi_demonstrasi' => $elemen[$i]['observasi_demonstrasi'],
                        'portofolio' => $elemen[$i]['portofolio'],
                        'pernyataan_pihak_3' => $elemen[$i]['pernyataan_pihak_3'],
                        'pernyataan_lisan' => $elemen[$i]['pernyataan_lisan'],
                        'pernyataan_tertulis' => $elemen[$i]['pernyataan_tertulis'],
                        'proyek_kerja' => $elemen[$i]['proyek_kerja'],
                        'lainnya' => $elemen[$i]['lainnya'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 02"], 200);
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
    public function storeAk03(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk03(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ak03 = UjiKompAk03::create([
                    'nama_asesi' => $params['nama_asesi'],
                    'nama_asesor' => $params['nama_asesor'],
                    'hari' => $params['hari'],
                    'tanggal' => $params['tanggal'],
                    'waktu' => $params['jam'],
                    'komentar' => $params['komentar'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_03 = $ak03->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                $elemen = $params['detail'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia01Detail = UjiKompAk03Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ak_03' => $ak03->id,
                        'komponen' => $elemen[$i]['komponen'],
                        'hasil' => $elemen[$i]['hasil'],
                        'catatan' => $elemen[$i]['komentar'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 03"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeAk04(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk03(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            $foundUser = User::where('email', $params['email_asesi'])->first();
            try {
                $ak04 = UjiKompAk04::create([
                    'nama_asesi' => $params['nama_asesi'],
                    'nama_asesor' => $params['nama_asesor'],
                    'tanggal_asesmen' => $params['tanggal_asesmen'],
                    'penjelasan' => $params['penjelasan'],
                    'diskusi' => $params['diskusi'],
                    'melibatkan' => $params['melibatkan'],
                    'skema' => $params['skema'],
                    'no_skema' => $params['no_skema'],
                    'alasan_banding' => $params['alasan_banding'],
                    'ttd_asesi' => $foundUser->signature,
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_04 = $ak04->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 04"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeAk05(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk05(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $ak05 = UjiKompAk05::create([
                    'nama_asesi' => $params['namaAsesi'],
                    'rekomendasi' => $params['rekomendasi'],
                    'keterangan' => $params['keterangan'],
                    'aspek' => $params['aspek'],
                    'pencatatan_penolakan' => $params['catatanPenolakan'],
                    'saran_perbaikan' => $params['saranPerbaikan'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_05 = $ak05->id;
                $foundUjiKomp->persentase = $progress + 3;
                $foundUjiKomp->save();


                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 05"], 200);
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

    private function getValidationRulesSubmitApl01($isNew = true)
    {
        return [
            'status' => 'required',
        ];
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
    
    private function getValidationRulesAk01()
    {
        return [
            'nama_asesi' => 'required',
        ];
    }

    private function getValidationRulesAk02()
    {
        return [
            'id_uji_komp' => 'required',
        ];
    }

    private function getValidationRulesAk03()
    {
        return [
            'nama_asesi' => 'required',
        ];
    }

    private function getValidationRulesAk05()
    {
        return [
            'namaAsesi' => 'required',
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
