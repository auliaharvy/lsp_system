<?php
/**
 * File UjiKompController.phpp
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;
use App\Http\Resources\MasterResource;
use App\Http\Resources\UjiKompResource;
use App\Http\Resources\Mapa2Resource;
use App\Http\Resources\Ak06Resource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Assesor;
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
use App\Laravue\Models\UjiKompAk07PotensiAsesi;
use App\Laravue\Models\UjiKompAk07Persyaratan;
use App\Laravue\Models\UjiKompAk07;
use App\Laravue\Models\UjiKompAk06;
use App\Laravue\Models\UjiKompIa01;
use App\Laravue\Models\UjiKompIa01Detail;
use App\Laravue\Models\UjiKompIa02;
use App\Laravue\Models\UjiKompIa02Detail;
use App\Laravue\Models\UjiKompIa03;
use App\Laravue\Models\UjiKompIa03Detail;
use App\Laravue\Models\UjiKompIa05;
use App\Laravue\Models\UjiKompIa05Detail;
use App\Laravue\Models\UjiKompIa06;
use App\Laravue\Models\UjiKompIa06Detail;
use App\Laravue\Models\UjiKompIa07;
use App\Laravue\Models\UjiKompIa07Detail;
use App\Laravue\Models\UjiKompIa11;
use App\Laravue\Models\UjiKompIa11Detail;
use App\Laravue\Models\UjiKompMapa02;
use App\Laravue\Models\UjiKompVa;
use App\Laravue\Models\UjiKompVaAspek;
use App\Laravue\Models\UjiKompVaRencana;
use App\Laravue\Models\UjiKompVaTemuan;
use App\Laravue\Models\Tuk;
use App\Laravue\Models\JadwalAsesor;
use Illuminate\Support\Collection\Paginate;
use App\Laravue\Models\Skema;
use App\Laravue\Models\User;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use App\Laravue\Models\MstFrIa02;
use App\Laravue\Models\MstFrIa03;
use App\Laravue\Models\MstFrIa05;
use App\Laravue\Models\MstFrIa07;
use App\Laravue\Models\MstFrAk03;
use App\Laravue\Models\MstFrAk04;
use App\Laravue\Models\MstFrAk07PotensiAsesi;
use App\Laravue\Models\MstFrAk07Persyaratan;
use App\Laravue\Models\MstFrAk07PersyaratanDetail;
use App\Laravue\Models\TrxAk07Persyaratan;
use App\Laravue\Models\TrxAk07PotensiAsesi;
use App\Laravue\Models\MstFrIa11;
use App\Http\Controllers\Api\SendEmailController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Validator;
use File;
use App\Image;
use App\Laravue\Models\MstFrMapa02;
use Carbon\Carbon;

/**
 * Class UjiKompController
 *
 * @package App\Http\Controllers\Api
 */
class UjiKompController extends BaseController
{
    const ITEM_PER_PAGE = 1000;

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
        $visibility = Arr::get($searchParams, 'visibility', 0);
        $skema = Arr::get($searchParams, 'id_skema', '');
        $idapl01 = Arr::get($searchParams, 'idapl01', '');
        $isPrint = Arr::get($searchParams, 'isPrint', false);

        $query = UjiKomp::query();
        $query->join('trx_uji_komp_apl_01 as b', 'b.id', '=', 'trx_uji_komp.id_apl_01');
        $query->join('trx_jadwal_asesmen as c', 'c.id', '=', 'b.id_jadwal');
        $query->join('mst_skema_sertifikasi as d', 'd.id', '=', 'b.id_skema');
        $query->join('mst_tuk as e', 'e.id', '=', 'b.id_tuk');
        $query->join('mst_asesor as f', 'f.id', '=', 'c.id_asesor')
        ->orderBy('c.created_at', 'desc')
        // ->where('trx_uji_komp.status', '=', 0)  
        ->select('trx_uji_komp.*', 'b.nik', 'b.nama_lengkap', 'b.nama_sekolah', 'b.email as email_peserta', 'c.start_date as mulai', 'c.end_date as selesai', 
        'd.skema_sertifikasi', 'd.kode_skema', 'e.nama as nama_tuk', 'c.jadwal', 'c.password_asesi', 'b.id_jadwal', 'f.nama as nama_asesor', 'f.email as email_asesor');

        if(!$isPrint){
            $query->where('trx_uji_komp.status', '=', 0);
        }
        
        if ($visibility === 0) {
            $query->where('c.visibility', 0);
        }

        if ($role === 'user') {
            $query->where('b.email', $foundUser->email);
        }
        if ($role === 'assesor') {
            // $query->join('mst_tuk as e', 'e.id', '=', 'b.id_tuk')
            $query->where('f.email', $foundUser->email);
        }
        if (!empty($jadwal)) {
            $query->where('b.id_jadwal', $jadwal);
        }
        if (!empty($skema)) {
            $query->where('b.id_skema', $skema);
        }

        if (!empty($idapl01)) {
            $query->where('b.id', $idapl01);
        }

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) { // agar mempertahankan query where yang sudah dibuat diatas (karena jika tidak menggunakan ini maka query where akan direplace oleh query orWhere dibawah ini)
                $query->where('b.email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('trx_uji_komp.nama_peserta', 'LIKE', '%' . $keyword . '%');
            });
        }

        return UjiKompResource::collection($query->paginate($limit));
    }

    public function history(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', 10);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $jadwal = Arr::get($searchParams, 'id_jadwal', '');
        $skema = Arr::get($searchParams, 'id_skema', '');

        $historyQuery = DB::table('trx_uji_komp as a')
        ->select('a.id as id', 'a.nama_peserta', 'd.jadwal', 'e.skema_sertifikasi', 'e.kode_skema', 'f.nama as asesor', 'd.start_date as mulai', 'a.status', 'c.id_skema', 'c.id_jadwal')
        ->join('mst_pemegang_sertifikat as b', 'b.id_uji_komp', '=', 'a.id')
        ->join('trx_uji_komp_apl_01 as c', 'c.id', '=', 'a.id_apl_01')
        ->join('trx_jadwal_asesmen as d', 'd.id', '=', 'c.id_jadwal')
        ->join('mst_skema_sertifikasi as e', 'e.id', '=', 'c.id_skema')
        ->join('mst_asesor as f', 'f.id', '=', 'd.id_asesor');
    
        if (!empty($jadwal)) {
            $historyQuery->where('c.id_jadwal', $jadwal);
        }
        if (!empty($skema)) {
            $historyQuery->where('c.id_skema', $skema);
        }
        if (!empty($keyword)) {
            $historyQuery->where(function ($query) use ($keyword) {
                $query->where('c.email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('a.nama_peserta', 'LIKE', '%' . $keyword . '%');
            });
        }
        
        $history = $historyQuery->paginate($limit);

        return $history;
    }

    public function indexPreview($id)
    {
        $query = UjiKomp::query();
        $query->join('trx_uji_komp_apl_01 as b', 'b.id', '=', 'trx_uji_komp.id_apl_01');
        $query->join('trx_jadwal_asesmen as c', 'c.id', '=', 'b.id_jadwal');
        $query->join('mst_skema_sertifikasi as d', 'd.id', '=', 'b.id_skema');
        $query->join('mst_tuk as e', 'e.id', '=', 'b.id_tuk');
        $query->join('mst_asesor as f', 'f.id', '=', 'c.id_asesor')
        ->orderBy('c.created_at', 'desc')
        ->select('trx_uji_komp.*', 'b.nik', 'b.nama_sekolah', 'b.email as email_peserta', 'c.start_date as mulai', 'c.end_date as selesai', 
        'd.id as id_skema','d.skema_sertifikasi', 'd.kode_skema', 'e.nama as nama_tuk', 'c.jadwal', 'c.password_asesi', 'b.id_jadwal', 'f.nama as nama_asesor', 'f.email as email_asesor')
        ->where('trx_uji_komp.id', '=', $id)
        ->get();

        return UjiKompResource::collection($query->paginate(1));
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
                    'status' => 'belum di cek',
                    'updated_by' => 1,
                ]);

                $ujiKomp = UjiKomp::create([
                    'nama_peserta' => $params['nama_lengkap'],
                    'id_asesi' => 1,
                    'id_skema' => $params['id_skema'],
                    'id_apl_01' => $apl01->id,
                    'id_apl_02' => $apl02->id,
                    'status' => 0,
                    'persentase' => 15,
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
            return response()->json(['message' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                DB::commit();
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
            $foundUji = UjiKomp::where('id',$id)->first();
            UjiKomp::where('id',$id)->delete();
            UjiKompApl1::where('id', $foundUji->id_apl_01)->delete();
            UjiKompApl2::where('id', $foundUji->id_apl_02)->delete();
            UjiKompApl2Detail::where('id_apl_02', $foundUji->id_apl_02)->delete();
            UjiKompAk01::where('id', $foundUji->id_ak_01)->delete();
            UjiKompAk02::where('id', $foundUji->id_ak_02)->delete();
            UjiKompAk02Detail::where('id_ak_02', $foundUji->id_ak_02)->delete();
            UjiKompAk03::where('id', $foundUji->id_ak_03)->delete();
            UjiKompAk03Detail::where('id_ak_03', $foundUji->id_ak_03)->delete();
            UjiKompAk04::where('id', $foundUji->id_ak_04)->delete();
            UjiKompAk05::where('id', $foundUji->id_ak_05)->delete();
            UjiKompAk06::where('id', $foundUji->id_ak_06)->delete();
            UjiKompIa01::where('id', $foundUji->id_ia_01)->delete();
            UjiKompIa01Detail::where('id_ia_01', $foundUji->id_ia_01)->delete();
            UjiKompIa02::where('id', $foundUji->id_ia_02)->delete();
            UjiKompIa03::where('id', $foundUji->id_ia_03)->delete();
            UjiKompIa03Detail::where('id_ia_03', $foundUji->id_ia_03)->delete();
            UjiKompIa05::where('id', $foundUji->id_ia_05)->delete();
            UjiKompIa05Detail::where('id_ia_05', $foundUji->id_ia_05)->delete();
            UjiKompIa06::where('id', $foundUji->id_ia_06)->delete();
            UjiKompIa06Detail::where('id_ia_06', $foundUji->id_ia_06)->delete();
            UjiKompIa11::where('id', $foundUji->id_ia_11)->delete();
            UjiKompIa11Detail::where('id_ia_11', $foundUji->id_ia_11)->delete();            
            return response()->json(['message' => "Berhasil Hapus Uji Kompetensi"], 201);
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

    public function showJadwalAsesmen($id){
        $queryJumlahAsesor = DB::table('trx_jadwal_asesmen as a')
        ->select(DB::raw('COUNT(a.id_asesor) as jumlah_asesor' ))
        ->join('mst_skema_sertifikasi as b', 'a.id_skema', '=', 'b.id')
        ->join('mst_asesor as c', 'a.id_asesor', '=', 'c.id')
        ->where('b.id', $id)
        ->first();

        $queryPemegangSertifikat = DB::table('trx_uji_komp as a')
        ->select(DB::raw('COUNT(a.id) as jumlah_pemegang_sertifikat' ))
        ->where('a.id_skema', $id)
        ->first();

        $data = [
            'jumlah_asesor' => $queryJumlahAsesor->jumlah_asesor,
            'jumlah_pemegang_sertifikat' => $queryPemegangSertifikat->jumlah_pemegang_sertifikat
        ];
        return $data;
    }
    public function showAsesor(Request $request)
    {
        $searchParams = $request->all();

        $asesor = Arr::get($searchParams, 'asesor');

        $queryAsesor = User::where('name',$asesor)->first();
       
        $data = [
            'signature' => $queryAsesor->signature, 
        ];
        return $data;
    }

    public function showSignature(Request $request)
    {
        $searchParams = $request->all();

        $asesor = Arr::get($searchParams, 'asesor');
        $asesi = Arr::get($searchParams, 'asesi');
        $admin = Arr::get($searchParams, 'admin');

        $queryAsesi = User::where('name',$asesi)->first();
        $no_reg = Assesor::where('nama', $asesor)->first();

        $data = [];
        $queryAsesiIsObject = is_object($queryAsesi);

        if($queryAsesiIsObject){
            $data = [
                'asesi' => $queryAsesi->signature, 
                'no_reg'=> $no_reg
            ];
        }else{
            $data = [
                'asesi' => null,
                'no_reg' => $no_reg
            ];
        }
        return $data;
    }

    public function getSoalIa05AndIa07($id){
        if ($id !== null) {
            $queryIa05 = MstFrIa05::where('mst_perangkat_ia_05.id_skema',$id)->first();
            $queryIa07 = MstFrIa07::where('mst_perangkat_ia_07.id_skema',$id)->first();

            return [
                "soalIa05" => $queryIa05,
                "soalIa07" => $queryIa07,
            ];
        }
        return null;
    }

    public function showPreview($id)
    {
       
        $queryUjiKomp = UjiKomp::where('trx_uji_komp.id',$id)
            // $queryUjiKompApl1 = UjiKompApl1::where('trx_uji_komp_apl_01.id', $queryUjiKomp.id_apl_01)
            // ->join('mst_skema_sertifikasi as b', 'b.id', '=', $queryUjiKompApl1.id_skema)
        // ->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_uji_komp_apl_01.id_skema')
        // ->join('mst_tuk as c', 'c.id', '=', 'trx_uji_komp_apl_01.id_tuk')
        // ->join('trx_jadwal_asesmen as d', 'd.id', '=', 'trx_uji_komp_apl_01.id_jadwal')
        // ->join('users as e', 'e.email', '=', 'trx_uji_komp_apl_01.email')
        // ->leftJoin('users as f', 'f.id', '=', 'trx_uji_komp_apl_01.id_admin')
        // $data = [
        //     'ttd_asesor' => $queryApl02->ttd_asesor,
        //     'status' => $queryApl02->status,
        //     'detail' => $queryDetailApl02,
        // ];
 
        ->select('trx_uji_komp.*')
        ->first();
        // ->get();

        // $query = UjiKomp::query();
        // $query->where('trx_uji_komp.id', $id);
        // $query->select('trx_uji_komp.*');
        // $query->get();


        return $queryUjiKomp;
        // return MasterResource::collection($query->paginate(1));
    }

    public function showApl01($id)
    {
        $queryApl01 = UjiKompApl1::where('trx_uji_komp_apl_01.id',$id)->first();
        $queryAdmin = User::where('users.id', $queryApl01->id_admin)->first();
        // $users = User::where('nik',$queryApl01->nik)->first();

        // return ['apl_01' => $queryApl01, 'signature' => $users->signature];
        return ['apl_01' => $queryApl01, 'admin' => $queryAdmin ];
    }

    public function showApl02($id)
    {
        // $queryApl02 = UjiKompApl2::where('trx_uji_komp_apl_02.id',$id)->first();
        // $queryDetailApl02 = UjiKompApl2Detail::query()
        //     ->join('trx_uji_komp as a', 'trx_uji_komp_apl_02_detail.id_apl_02', '=', 'a.id_apl_02')
        //     ->join('mst_skema_sertifikasi_kuk_elemen as b', 'trx_uji_komp_apl_02_detail.id_kuk_elemen', '=', 'b.id')
        //     ->join('mst_skema_sertifikasi_unit_kompetensi as c', 'a.id_skema', '=', 'c.id_skema')
        //     ->join('mst_skema_sertifikasi_elemen_kompetensi as d', 'c.id', '=', 'd.id_unit')
        //     // ->join('mst_skema_sertifikasi_kuk_elemen as b', 'd.id', '=', 'b.id_elemen')
        //     ->where('trx_uji_komp_apl_02_detail.id_apl_02',$id)
        //     // ->select('b.kuk', 'b.pertanyaan_kuk', 'd.nama_elemen', 'c.kode_unit', 'c.unit_kompetensi')
        //     ->get();

        $queryApl02 = UjiKompApl2::where('trx_uji_komp_apl_02.id',$id)->first();
        $queryDetailApl02 = UjiKompApl2Detail::where('trx_uji_komp_apl_02_detail.id_apl_02',$id)->get();
       
        $data = [
            'apl_02' => $queryApl02,
            'detail' => $queryDetailApl02,
        ];

        return $data;
    }

    public function showAk01($id)
    {
       
        $query = UjiKompAk01::where('trx_uji_komp_ak_01.id',$id)->first();
       
        return $query;
    }

    public function showAk02($id)
    {
        $queryAk02 = UjiKompAk02::where('trx_uji_komp_ak_02.id',$id)->first();
        $queryDetailAk02 = UjiKompAk02Detail::query()->join('mst_perangkat_ia_03 as b', 'b.id', '=', 'trx_uji_komp_ak_02_detail.id_unit')
        ->where('trx_uji_komp_ak_02_detail.id_ak_02',$id)->get();
        $queryDetailAk02Preview = UjiKompAk02Detail::where('trx_uji_komp_ak_02_detail.id_ak_02',$id)->get();
       
        $data = [
            'ak_02' => $queryAk02,
            'detail' => $queryDetailAk02,
            'detail_for_preview' => $queryDetailAk02Preview,
        ];
        return $data;
    }

    public function showAk03($id)
    {
        $queryAk03 = UjiKompAk03::where('trx_uji_komp_ak_03.id',$id)->first();
        $queryDetailAk03 = UjiKompAk03Detail::where('trx_uji_komp_ak_03_detail.id_ak_03',$id)->get();
       
        $data = [
            'ak_03' => $queryAk03,
            'detail' => $queryDetailAk03,
        ];
        return $data;
    }

  

    public function showAk04($id)
    {
       
        $query = UjiKompAk04::where('trx_uji_komp_ak_04.id',$id)->first();
       
        return $query;
    }

    public function showAk05(Request $request)
    {
        $searchParams = $request->all();

        $id = Arr::get($searchParams, 'id');
        $asesor = Arr::get($searchParams, 'asesor');

        $query = UjiKompAk05::where('trx_uji_komp_ak_05.id',$id)->first();
        $queryAssesor = DB::table('mst_asesor as a')
        ->select(DB::raw('a.*'))
        ->where('a.nama', '=', $asesor) 
        ->first();
       
        $data = [
            'ak_05' => $query, 
            'reg' => $queryAssesor->no_reg,
        ];

        return $data;
    }

    public function showAk06($id)
    {
        $queryUjiKomp = UjiKomp::where('trx_uji_komp.id_ak_06', $id)->first();

        // $queryAk01 = UjiKompAk01::where('trx_uji_komp_ak_01.id', $queryUjiKomp->id_ak_01)
        // ->select('trx_uji_komp_ak_01.tanggal', 'trx_uji_komp_ak_01.bulan', 'trx_uji_komp_ak_01.tahun', 'trx_uji_komp_ak_01.nama_asesor')
        // ->first();
        
        $queryAk06 = UjiKompAk06::query();
        $queryAk06->where('trx_uji_komp_ak_06.id',$id)
        ->select('trx_uji_komp_ak_06.*')
        ->get();


        return [
            'data' => Ak06Resource::collection($queryAk06->paginate(static::ITEM_PER_PAGE)),
            // 'ak01' => $queryAk01
        ];
    }
    
    public function previewAk07PotensiAsesi($id)
    {
        $showAk07ByIdUjiKomp = UjiKompAk07PotensiAsesi::query()
            ->join('mst_perangkat_ak_07_potensi_asesi', 'mst_perangkat_ak_07_potensi_asesi.id', '=', 'trx_ak_07_potensi_asesi.id_mst_perangkat_ak_07_potensi_asesi')
            ->join('trx_uji_komp_ak_07', 'trx_uji_komp_ak_07.id', '=', 'trx_ak_07_potensi_asesi.id_trx_uji_komp_ak_07')
            ->where('trx_uji_komp_ak_07.id_uji_komp', '=', $id)
            ->select('trx_ak_07_potensi_asesi.potensi', 'mst_perangkat_ak_07_potensi_asesi.komponen')
            ->get();
        return [
            'data' => $showAk07ByIdUjiKomp,
        ];
    }

    public function previewAk07Persyaratan($id)
    {
        $showAk07ByIdUjiKomp = UjiKompAk07Persyaratan::query()
            ->join('trx_uji_komp_ak_07', 'trx_uji_komp_ak_07.id', '=', 'trx_ak_07_persyaratan.id_trx_uji_komp_ak_07')
            ->join('mst_perangkat_ak_07_persyaratan_detail', 'mst_perangkat_ak_07_persyaratan_detail.id', '=', 'trx_ak_07_persyaratan.id_mst_perangkat_ak_07_persyaratan_detail')
            ->join('mst_perangkat_ak_07_persyaratan', 'mst_perangkat_ak_07_persyaratan.id', '=', 'mst_perangkat_ak_07_persyaratan_detail.id_mst_perangkat_ak_07_persyaratan')
            ->where('trx_uji_komp_ak_07.id_uji_komp', '=', $id)
            ->select('mst_perangkat_ak_07_persyaratan.id', 'trx_ak_07_persyaratan.keterangan',  'mst_perangkat_ak_07_persyaratan_detail.komponen as child_component', 'mst_perangkat_ak_07_persyaratan.komponen as parent_component')
            ->get();
        return [
            'data' => $showAk07ByIdUjiKomp,
        ];
    }
    
    public function showAk07PotensiAsesi()
    {
        $showAk07ByIdUjiKomp = MstFrAk07PotensiAsesi::query()
            ->select(
                'mst_perangkat_ak_07_potensi_asesi.id', 
                'mst_perangkat_ak_07_potensi_asesi.komponen', 
                'mst_perangkat_ak_07_potensi_asesi.versi')
            ->get();
        return [
            'data' => $showAk07ByIdUjiKomp,
        ];
    }

    public function showAk07Persyaratan()
    {
        $showAk07ByIdUjiKomp = MstFrAk07Persyaratan::join(
            'mst_perangkat_ak_07_persyaratan_detail', 'mst_perangkat_ak_07_persyaratan.id', '=', 'mst_perangkat_ak_07_persyaratan_detail.id_mst_perangkat_ak_07_persyaratan')
            ->select( 'mst_perangkat_ak_07_persyaratan.id', 'mst_perangkat_ak_07_persyaratan_detail.id as id_mst_detail', 'mst_perangkat_ak_07_persyaratan_detail.komponen as child_component', 'mst_perangkat_ak_07_persyaratan.komponen as parent_component')
            ->get();
    
        return [
            'data' => $showAk07ByIdUjiKomp,
        ];
    }
    

    public function showAk07($id)
    {
        $showAk07ByIdUjiKomp = UjiKompAk07::query()
            ->where('trx_uji_komp_ak_07.id_uji_komp', '=', $id)
            ->get();
        return [
            'data' => $showAk07ByIdUjiKomp,
        ];
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
        $queryDetailIa03 = UjiKompIa03Detail::select('trx_uji_komp_ia_03_detail.*')
        ->join('mst_perangkat_ia_03 as a','a.id', '=', 'trx_uji_komp_ia_03_detail.id_perangkat_ia_03')
        ->where('trx_uji_komp_ia_03_detail.id_ia_03',$id)->get();
       
        $data = [
            'ia_03' => $queryIa03,
            // 'note' => $queryIa01->note,
            'detail' => $queryDetailIa03,
        ];
        return $data;
       
    }

    public function showIa05($id)
    {

        $queryIa05 = UjiKompIa05::where('trx_uji_komp_ia_05.id',$id)->first();
        $queryDetailIa05 = UjiKompIa05Detail::select('trx_uji_komp_ia_05_detail.*')
        ->join('mst_perangkat_ia_05 as a','a.id', '=', 'trx_uji_komp_ia_05_detail.id_perangkat_ia_05')
        ->join('mst_skema_sertifikasi_unit_kompetensi as b', 'a.id_unit_komp', '=', 'b.id')
        ->where('trx_uji_komp_ia_05_detail.id_ia_05',$id)->get();
        $queryJawaban = DB::table('mst_perangkat_ia_05_a as a')
        ->join('trx_uji_komp_ia_05_detail as b','a.id', '=', 'b.id_perangkat_ia_05')
        ->join('mst_perangkat_ia_05 as c','b.id_perangkat_ia_05', '=', 'c.id')
        ->select(DB::raw('a.*'))
        // ->where('a.id_trx_va', '=', $id) 
        ->get();

       
        $data = [
            'ia_05' => $queryIa05,
            // 'note' => $queryIa05->note,
            'detail' => $queryDetailIa05,
        ];
        return $data;
    }

    public function showIa06($id)
    {
       
        $queryIa06 = UjiKompIa06::where('trx_uji_komp_ia_06.id',$id)->first();
        $queryDetailIa06 = UjiKompIa06Detail::select('trx_uji_komp_ia_06_detail.*')
        ->join('mst_perangkat_ia_06 as a','a.id', '=', 'trx_uji_komp_ia_06_detail.id_perangkat_ia_06')->join('mst_skema_sertifikasi_unit_kompetensi as b', 'a.id_unit_komp', '=', 'b.id')
        ->where('trx_uji_komp_ia_06_detail.id_ia_06',$id)->get();
       
        $data = [
            'ia_06' => $queryIa06,
            // 'note' => $queryIa01->note,
            'detail' => $queryDetailIa06,
        ];
        return $data;
       
    }

    public function showIa07($id)
    {
        $queryIa07 = UjiKompIa07::where('trx_uji_komp_ia_07.id',$id)->first();
        $queryDetailIa07 = UjiKompIa07Detail::select('trx_uji_komp_ia_07_detail.*')
        ->join('mst_perangkat_ia_07 as a','a.id', '=', 'trx_uji_komp_ia_07_detail.id_perangkat_ia_07')
        ->join('mst_skema_sertifikasi_unit_kompetensi as b', 'a.id_unit_komp', '=', 'b.id')
        ->where('trx_uji_komp_ia_07_detail.id_ia_07',$id)->get();
       
        $data = [
            'ia_07' => $queryIa07,
            'detail' => $queryDetailIa07,
        ];
        return $data;
    }


    public function showIa11($id)
    {
    
        $queryIa11 = UjiKompIa11::where('trx_uji_komp_ia_11.id',$id)->first();
        $queryDetailIa11 = UjiKompIa11Detail::query()->join('mst_perangkat_ia_11 as a','a.id', '=', 'trx_uji_komp_ia_11_detail.id_perangkat_ia_11')
        ->where('trx_uji_komp_ia_11_detail.id_ia_11',$id)->get();
    
        $data = [
            'ia_11' => $queryIa11,
            // 'note' => $queryIa01->note,
            'detail' => $queryDetailIa11,
        ];
        return $data;
    
    }

    public function showVa($id)
    {
        // $queryIa07 = UjiKompIa07::where('trx_uji_komp_ia_07.id',$id)->first();
        // $queryDetailIa07 = UjiKompIa07Detail::where('trx_uji_komp_ia_07_detail.id_ia_07',$id)->get();
       
        // $data = [
        //     'ia_07' => $queryIa07,
        //     'detail' => $queryDetailIa07,
        // ];
        // return $data;

        $dataVa = DB::table('trx_uji_komp_va as a')
        ->join('trx_uji_komp_va_aspek_aspek as b', 'a.id', '=', 'b.id_trx_va')
        // ->join('trx_uji_komp_va_rencana_implementasi as c', 'a.id', '=', 'c.id_trx_va')
        // ->join('trx_uji_komp_va_temuan as d', 'a.id', '=', 'd.id_trx_va')
        ->join('trx_uji_komp as e', 'b.id_uji_komp', '=', 'e.id')
        ->join('mst_skema_sertifikasi as f', 'e.id_skema', '=', 'f.id')
        ->join('trx_uji_komp_apl_01 as g', 'e.id_apl_01', '=', 'g.id')
        ->join('mst_tuk as h', 'g.id_tuk', '=', 'h.id')
        ->leftJoin('mst_asesor as i', 'a.asesor_1', '=', 'i.id')
        ->leftJoin('mst_asesor as j', 'a.asesor_2', '=', 'j.id')
        ->leftJoin('mst_asesor as k', 'a.asesor_3', '=', 'k.id')
        ->leftJoin('mst_asesor as l', 'a.lead_asesor', '=', 'l.id')
        ->select(DB::raw('a.*, f.kode_skema, f.skema_sertifikasi, h.nama as nama_tuk, i.nama as nama_asesor_1, j.nama as nama_asesor_2, k.nama as nama_asesor_3, l.nama as nama_lead_asesor, e.id as id_uji_komp_for_va'))
        ->where('b.id_trx_va', '=', $id)
        ->groupBy('b.id_trx_va')
        ->get();

        $aspek = DB::table('trx_uji_komp_va_aspek_aspek as a')
        ->select(DB::raw('a.*'))
        ->where('a.id_uji_komp', '=', $dataVa[0]->id_uji_komp_for_va) 
        // ->where('a.id_trx_va', '=', $id) 
        ->get();

        $temuan = DB::table('trx_uji_komp_va_temuan as a')
        ->select(DB::raw('a.*'))
        ->where('a.id_uji_komp', '=', $dataVa[0]->id_uji_komp_for_va)
        // ->where('a.id_trx_va', '=', $id)
        ->get();

        $rencana = DB::table('trx_uji_komp_va_rencana_implementasi as a')
        ->select(DB::raw('a.*'))
        ->where('a.id_uji_komp', '=', $dataVa[0]->id_uji_komp_for_va)
        // ->where('a.id_trx_va', '=', $kd)
        ->get();

        return [
            'dataVa' => $dataVa,
            'aspek' => $aspek,
            'temuan' => $temuan,
            'rencana' => $rencana,
        ];
    }

    public function previewIa06($id)
    {
        $jawaban = DB::table('trx_uji_komp_ia_06_detail as a')
        ->leftJoin('trx_uji_komp_ia_06 as b', 'a.id_ia_06', '=', 'b.id')
        ->leftJoin('mst_perangkat_ia_06 as c', 'a.id_perangkat_ia_06', '=', 'c.id')
        ->leftJoin('mst_skema_sertifikasi_unit_kompetensi as d', 'c.id_unit_komp', '=', 'd.id')
        ->select(DB::raw('a.id, a.jawaban, c.pertanyaan, c.kunci_jawaban, d.kode_unit, d.unit_kompetensi'))
        ->where('a.id_ia_06', '=', $id)
        ->groupBy('a.id')
        ->get();

        return $jawaban;
    }

    public function previewIa11($id)
    {
        $jawaban = DB::table('trx_uji_komp_ia_11_detail as a')
        ->leftJoin('mst_perangkat_ia_11 as b', 'a.id_perangkat_ia_11', '=', 'b.id')
        ->leftJoin('trx_uji_komp_ia_11 as c', 'a.id_ia_11', '=', 'c.id')
        ->select(DB::raw('a.id, b.pertanyaan, a.tanggapan as jawaban, a.komentar, c.komentar as komentar_asesor'))
        ->where('a.id_ia_11', '=', $id)
        ->groupBy('a.id')
        ->get();

        return $jawaban;
    }

    public function previewAk03($id)
    {
        $jawaban = DB::table('trx_uji_komp_ak_03_detail as a')
        ->leftJoin('trx_uji_komp_ak_03 as b', 'a.id_ak_03', '=', 'b.id')
        ->select(DB::raw('a.id, a.komponen, a.hasil, a.catatan, b.komentar as komentar_asesor'))
        ->where('a.id_ak_03', '=', $id)
        ->groupBy('a.id')
        ->get();

        return $jawaban;
    }

    public function previewAk04($id)
    {
        $jawaban = DB::table('trx_uji_komp_ak_04 as a')
        ->select(DB::raw('a.*'))
        ->get();

        return $jawaban;
    }

    public function indexApl02(Request $request){
        $searchParams = $request->all();        
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $idapl02 = Arr::get($searchParams, 'idapl02', '');

        // $query = UjiKompApl2Detail::query()
        //     ->join('trx_uji_komp as a', 'trx_uji_komp_apl_02_detail.id_apl_02', '=', 'a.id_apl_02')
        //     // ->join('mst_skema_sertifikasi_kuk_elemen as b', 'trx_uji_komp_apl_02_detail.id_kuk_elemen', '=', 'b.id')
        //     // ->join('mst_skema_sertifikasi_unit_kompetensi as c', 'a.id_skema', '=', 'c.id_skema')
        //     // ->join('mst_skema_sertifikasi_elemen_kompetensi as d', 'c.id', '=', 'd.id_unit')
        //     // ->join('mst_skema_sertifikasi_kuk_elemen as b', 'd.id', '=', 'b.id_elemen')
        //     ->join(DB::raw('(SELECT id, id_skema, kode_unit, unit_kompetensi FROM mst_skema_sertifikasi_unit_kompetensi) as b'),
        //         function($join){
        //             $join->on('a.id_skema', '=', 'b.id_skema');
        //         })
        //     ->join(DB::raw('(SELECT id, nama_elemen, id_unit FROM mst_skema_sertifikasi_elemen_kompetensi) as c'),
        //         function($join){
        //             $join->on('b.id', '=', 'c.id_unit');
        //         })
        //     ->join(DB::raw('(SELECT id, id_elemen, kuk, pertanyaan_kuk FROM mst_skema_sertifikasi_kuk_elemen) as d'),
        //         function($join){
        //             $join->on('c.id', '=', 'd.id_elemen');
        //         })
        //     ->join('trx_uji_komp_apl_02 as e', 'trx_uji_komp_apl_02_detail.id_apl_02', '=', 'e.id')
        //     ->where('trx_uji_komp_apl_02_detail.id_apl_02',$idapl02)
        //     // ->where('b.id_elemen','=', 'd.id')
        //     ->select('e.ttd_asesor', 'd.kuk', 'd.pertanyaan_kuk', 'c.nama_elemen', 'b.kode_unit', 'b.unit_kompetensi')
        //     ->groupBy('d.id')
        //     ->get();

        $query = UjiKompApl2::query(); 
        $query->join('trx_uji_komp_apl_02_detail as a', 'trx_uji_komp_apl_02.id', '=', 'a.id_apl_02');
        $query->join('trx_uji_komp as e', 'e.id_apl_02', '=', 'a.id_apl_02');
        $query->join('mst_skema_sertifikasi_unit_kompetensi as d', 'e.id_skema', '=', 'd.id_skema');
        $query->join('mst_skema_sertifikasi_elemen_kompetensi as c', 'd.id', '=', 'c.id_unit');
        $query->join('mst_skema_sertifikasi_kuk_elemen as b', 'c.id', '=', 'b.id_elemen');
        $query->where('trx_uji_komp_apl_02.id',$idapl02)
        ->select('trx_uji_komp_apl_02.status', 'b.kuk', 'trx_uji_komp_apl_02.ttd_asesor', 'b.pertanyaan_kuk', 'c.nama_elemen', 'd.kode_unit', 'd.unit_kompetensi')
        ->groupBy('d.kode_unit')
        ->get();

        return MasterResource::collection($query->paginate($limit));
        // return $query;
        // return MasterResource::collection($query);
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

    public function indexIa02Detail(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');
        $id_trx_ia_02 = Arr::get($searchParams, 'id_trx_ia_02', '');

        $query = UjiKompIa02Detail::query();
        $query->where('trx_uji_komp_ia_02_detail.id_trx_ia_02', $id_trx_ia_02)
        ->select('trx_uji_komp_ia_02_detail.*');

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

    public function indexIa05(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa05::query();
        $query->where('mst_perangkat_ia_05.id_skema', $id_skema)
        ->select('mst_perangkat_ia_05.*');

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
    public function indexAk06($id)
    {
        $query = UjiKompAk06::query();
        $query->join('trx_uji_komp as a', 'a.id_ak_06', '=', 'trx_uji_komp_ak_06.id');
        $query->join('trx_uji_komp_ak_01 as b', 'b.id', '=', 'a.id_ak_01');
        $query->where('trx_uji_komp_ak_06.id',$id)->get();

        return new MasterResource($query->get());
    }

    public function showMapa02($id)
    {   
        $queryMapa02 = UjiKompMapa02::query();
        $queryMapa02->join('mst_perangkat_mapa_02','mst_perangkat_mapa_02.id','=','trx_uji_komp_mapa_02.id_mst_mapa_02');
        $queryMapa02->where('trx_uji_komp_mapa_02.id_uji_komp',$id);
        return MasterResource::collection($queryMapa02->get());
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
                //upload sign
                $email = $request['email'];
                $idAdmin = $request['user_id'];
                $file = $request['signature'];
                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                // membuat nama file unik
                $nama_file = $now . 'asesi-'. $email .'-admin-' .$idAdmin. '-apl01' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

                $foundApl01->status = $params['status'];
                $foundApl01->ttd_admin = $nama_file;
                $foundApl01->id_admin = $params['user_id'];
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

    public function submitApl02(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesSubmitApl01(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_apl_02 = $request->get('id_apl_02');
            $foundApl02 = UjiKompApl2::where('id', $id_apl_02)->first();
            try {
                $params = $request->all();
                //upload sign
                $file = $request['signature'];
                $nama_asesor = $request['nama_asesor'];
                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                // membuat nama file unik
                $nama_file = $now  . $nama_asesor .'-asesor-' . 'apl02' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

                $foundApl02->status = $params['status'];
                $foundApl02->ttd_asesor = $nama_file;
                $foundApl02->save();

                DB::commit();
                return response()->json(['message' => "Sukses Submit FR APL 02"], 200);
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
                //upload sign
                $file = $request['ttd_asesor'];
                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $id_user = $params['user_id'];
                // membuat nama file unik
                $nama_file = $now . $id_user . '-asesor-' . 'ia01' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

                //upload sign
                $file1 = $request['ttd_asesi'];
                $image1 = str_replace('data:image/png;base64,', '', $file1);
                $image1 = str_replace(' ', '+', $image1);
                // membuat nama file unik
                $nama_file1 = $now . $id_user .'-asesi-' . 'ia01' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file1, base64_decode($image1));

                $ia01 = UjiKompIa01::create([
                    'status' => $params['status'],
                    'note' => $params['note'],
                    'updated_by' => $params['user_id'],
                    'ttd_asesor' => $nama_file,
                    'ttd_asesi' => $nama_file1,
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_01 = $ia01->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                $elemen = json_decode($params['detail_ia_01'], true);
                // $elemen = $params['detail_ia_01'];
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
            $mstIa02 = MstFrIa02::where('id_skema', $foundUjiKomp->id_skema)->first();
            $countingJawaban = UjiKompIa02Detail::where('id_trx_ia_02', $foundUjiKomp->id_ia_02)->count();
            $ujiKompIa02;

            try {
                $params = $request->all();
                // upload file
                $file = $request->file('file');
                $user_id = $params['user_id'];
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . $user_id . '-' . $file->getClientOriginalName();
                $file->move('uploads/ia-02/jawaban/', $nama_file);
                $file = 'uploads/ia-02/jawaban/'.$nama_file;

                if ($mstIa02->jumlah > $countingJawaban) {
                    if ($foundUjiKomp->id_ia_02){
                        // create upload jawaban baru
                        $ia02Detail = UjiKompIa02Detail::create([
                            'id_trx_ia_02' => $foundUjiKomp->id_ia_02,
                            'jawaban' => $file
                        ]);    
                        $ujiKompIa02 = UjiKompIa02::find($foundUjiKomp->id_ia_02);
                    } else {
                        // trx_uji_komp_ia_02 terbuat
                        $ia02 = UjiKompIa02::create([
                            'rekomendasi_asesor' => 'Belum Penilaian',
                            'submit_by' => $params['user_id'],
                            'updated_by' => $params['user_id'],
                        ]);

                        $ujiKompIa02 = UjiKompIa02::find($ia02->id);
                        $foundUjiKomp->id_ia_02 = $ujiKompIa02->id;
                        $foundUjiKomp->save();

                        $ia02Detail = UjiKompIa02Detail::create([
                            'id_trx_ia_02' => $ia02->id,
                            'jawaban' => $file
                        ]);
                    }

                    $jumlahJawaban = UjiKompIa02Detail::where('id_trx_ia_02', $ujiKompIa02->id)->count();

                    if ($mstIa02->jumlah === $jumlahJawaban) {
                        $progress = $foundUjiKomp->persentase;
                        $foundUjiKomp->id_ia_02 = $ujiKompIa02->id;
                        $foundUjiKomp->persentase = $progress + 5;
                        if($foundUjiKomp->persentase === 100) {
                            $foundUjiKomp->status = 1;
                        }

                        $foundUjiKomp->save();
                    }

                    DB::commit();
                    return response()->json(['message' => "Sukses Upload Jawaban FR IA 02"], 200);
                } else {
                    return response()->json(['message' => "Upload Jawaban Sudah Melebihi Soal"], 200);
                }

            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }

    public function penilaianIa02(Request $request)
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
            $id_ia_02 = $request->get('id_ia_02');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            $foundIa02 = UjiKompIa02::where('id', $id_ia_02)->first();
            try {
                $params = $request->all();
                $foundIa02->rekomendasi_asesor = $params['rekomendasi_asesor'];
                $foundIa02->updated_by = $params['user_id'];
                $foundIa02->save();

                DB::commit();
                return response()->json(['message' => "Sukses menilai FR IA 02"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
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
                    // 'rekomendasi_asesor' => 'belum penilaian',
                    // 'umpan_balik' => 'belum penilaian',
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'umpan_balik' => $params['umpanBalikAsesi'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_03 = $ia03->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                $elemen = $params['detail_ia_03'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia03Detail = UjiKompIa03Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ia_03' => $ia03->id,
                        'id_perangkat_ia_03' => $elemen[$i]['id'],
                        'tanggapan' => $elemen[$i]['tanggapan'],
                        // 'rekomendasi' => 'belum penilaian',
                        // 'rekomendasi' => $elemen[$i]['is_kompeten'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 03"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }

    public function penilaianIa03(Request $request)
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
            $id_ia_03 = $request->get('id_ia_03');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            $foundIa03 = UjiKompIa03::where('id', $id_ia_03)->first();
            try {
                $params = $request->all();
                $foundIa03->rekomendasi_asesor = $params['rekomendasi_asesor'];
                $foundIa03->umpan_balik = $params['umpanBalikAsesi'];
                $foundIa03->updated_by = $params['user_id'];
                $foundIa03->save();

                $elemen = $params['detail_ia_03'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $foundIa03Detail = UjiKompIa03Detail::where('id', $elemen[$i]['id'])->first();
                    $foundIa03Detail->rekomendasi = $elemen[$i]['is_kompeten'];
                    $foundIa03Detail->save();
                }

                DB::commit();
                return response()->json(['message' => "Sukses menilai FR IA 03"], 200);
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
    public function storeIa05(Request $request)
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
                $ia05 = UjiKompIa05::create([
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_05 = $ia05->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                $elemen = $params['detail_ia_05'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia05Detail = UjiKompIa05Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ia_05' => $ia05->id,
                        'id_perangkat_ia_05' => $elemen[$i]['id_perangkat'],
                        'jawaban' => $elemen[$i]['jawaban'],
                        // 'rekomendasi' => 'belum penilaian',
                        // 'rekomendasi' => $elemen[$i]['is_kompeten'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 05"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function penilaianIa05(Request $request)
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
            $id_ia_05 = $request->get('id_ia_05');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            $foundIa05 = UjiKompIa05::where('id', $id_ia_05)->first();
            try {
                $params = $request->all();
                $foundIa05->rekomendasi_asesor = $params['rekomendasi_asesor'];
                $foundIa05->updated_by = $params['user_id'];
                $foundIa05->save();

                $elemen = $params['detail_ia_05'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $foundIa05Detail = UjiKompIa05Detail::where('id', $elemen[$i]['id'])->first();
                    // $foundIa05Detail->rekomendasi_asesor = $elemen[$i]['is_kompeten'];
                    $foundIa05Detail->rekomendasi = $elemen[$i]['is_kompeten'];
                    $foundIa05Detail->save();
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 05"], 200);
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
    public function storeIa06(Request $request)
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
                $ia06 = UjiKompIa06::create([
                    // 'rekomendasi_asesor' => 'belum penilaian',
                    // 'umpan_balik' => 'belum penilaian',
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'umpan_balik' => $params['umpanBalikAsesi'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_06 = $ia06->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                $elemen = $params['detail_ia_06'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia06Detail = UjiKompIa06Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ia_06' => $ia06->id,
                        'id_perangkat_ia_06' => $elemen[$i]['id'],
                        'jawaban' => $elemen[$i]['jawaban'],
                        // 'rekomendasi' => 'belum penilaian',
                        // 'rekomendasi' => $elemen[$i]['is_kompeten'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR IA 06"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function penilaianIa06(Request $request)
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
            $id_ia_06 = $request->get('id_ia_06');
            $foundUjiKomp = UjiKomp::where('id', $request->get('id_uji_komp'))->first();
            $foundIa06 = UjiKompIa06::where('id', $request->get('id_ia_06'))->first();
            try {
                $params = $request->all();
                $foundIa06->rekomendasi_asesor = $params['rekomendasi_asesor'];
                $foundIa06->umpan_balik = $params['umpanBalikAsesi'];
                $foundIa06->updated_by = $params['user_id'];
                $foundIa06->save();

                $elemen = $params['detail_ia_06'];
                for ($i = 0; $i < count($elemen); $i++) {
                    echo $elemen[$i]['id'];
                    $foundIa06Detail = UjiKompIa06Detail::where('id', $elemen[$i]['id'])->first();
                    
                    $foundIa06Detail->rekomendasi = $elemen[$i]['is_kompeten'];
                    $foundIa06Detail->save();
                }

                DB::commit();
                return response()->json(['message' => "Sukses menilai FR IA 06"], 200);
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
    public function storeIa07(Request $request)
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
                $ia07 = UjiKompIa07::create([
                    'rekomendasi_asesor' => $params['rekomendasi_asesor'],
                    'umpan_balik' => $params['umpanBalikAsesi'],
                    'submit_by' => $params['user_id'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ia_07 = $ia07->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                $elemen = $params['detail_ia_07'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $ia07Detail = UjiKompIa07Detail::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_ia_07' => $ia07->id,
                        'id_perangkat_ia_07' => $elemen[$i]['id'],
                        'jawaban' => $elemen[$i]['jawaban'],
                    ]);
                }

                DB::commit();
                return response()->json(['ia07' => $ia07, 'ia07detail' => $ia07Detail], 200);
                // return response()->json(['message' => "Sukses membuat FR IA 07"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function penilaianIa07(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $params = $request->all();

            $id_uji_komp = $params['id_uji_komp'];
            $id_ia_07 = $params['id_ia_07'];
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            $foundIa07 = UjiKompIa07::where('id', $id_ia_07)->first();
            try {
                $foundIa07->rekomendasi_asesor = $params['rekomendasi_asesor'];
                $foundIa07->umpan_balik = $params['umpanBalikAsesi'];
                $foundIa07->updated_by = $params['user_id'];
                $foundIa07->save();

                $elemen = $params['detail_ia_07'];
                for ($i = 0; $i < count($elemen); $i++) {
                    $foundIa07Detail = UjiKompIa07Detail::where('id', $elemen[$i]['id'])->first();
                    $foundIa07Detail->rekomendasi = $elemen[$i]['is_kompeten'];
                    $foundIa07Detail->save();
                }

                DB::commit();
                return response()->json(['message' => "Sukses menilai FR IA 07"], 200);
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
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

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

                //upload sign
                $file1 = $request['signature_asesi'];
                $image1 = str_replace('data:image/png;base64,', '', $file1);
                $image1 = str_replace(' ', '+', $image1);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                // membuat nama file unik
                $nama_file1 = $now . '-asesi-' . $id_uji_komp . '-ak01' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file1, base64_decode($image1));

                $params = $request->all();
                $foundAk01 = UjiKompAk01::where('id', $params['id_ak_01'])->first();

                $foundAk01->tanda_tangan_asesi = $nama_file1;
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
                //upload sign
                $file = $request['signature_asesor'];
                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                // membuat nama file unik
                $nama_file = $now . '-asesor-' . $id_uji_komp . '-ak01' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

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
                    'tanda_tangan_asesor' => $nama_file,
                    'tanda_tangan_asesi' => '',
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_01 = $ak01->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

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
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }
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

                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

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
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

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

                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                // dapetin email asesi
                $users = UjiKompApl1::where('id', $foundUjiKomp->id_apl_01)->first();

                // kirim email
                $sendEmailController = App::make(SendEmailController::class);
                $sendEmail = $sendEmailController->index(new Request([
                    'email' => $users->email,
                    'nama_asesi' => $ak05->nama_asesi,
                    'rekomendasi' => $ak05->rekomendasi,
                    'keterangan' => $ak05->keterangan,
                    'aspek' => $ak05->aspek,
                    'pencatatan_penolakan' => $ak05->pencatatan_penolakan,
                    'saran_perbaikan' => $ak05->saran_perbaikan
                ]));

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 05"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }
    public function storeAk06(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk06(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id = $request->get('id_uji');
            $foundUjiKomp = UjiKomp::where('id', $id)->first();
            $params = $request->all();
            $rekomendasi = $request->rekomendasi[0]['rekomendasi'];
            $rekomendasiPemenuhan = $request->rekomendasiPemenuhan[0]['rekomendasi'];
            $aspekPemenuhan = $params['aspekPemenuhan'];
            
            $komentar = $request->ttdTable[0]['komentar'];
            $file = $request->ttdTable[0]['ttd'];  
                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                // membuat nama file unik
                $nama_file = $now . '-asesor-' . 'ak-06' . '-' . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));
            $aspek = $params['dataAspek'];
            for ($i = 0 ; $i < count($aspek); $i++){
                if($aspek[$i]['item'] == '- Rencana Asesmen'){
                    $validitas_rencana_asesmen = $aspek[$i]['validitas'];
                    $reliabel_rencana_asesmen = $aspek[$i]['reliabel'];
                    $fleksibel_rencana_asesmen = $aspek[$i]['fleksibel'];
                    $adil_rencana_asesmen = $aspek[$i]['adil'];
                }else if($aspek[$i]['item'] == '- Persiapan Asesmen' ){
                    $validitas_persiapan_asesmen = $aspek[$i]['validitas'];
                    $reliabel_persiapan_asesmen = $aspek[$i]['reliabel'];
                    $fleksibel_persiapan_asesmen = $aspek[$i]['fleksibel'];
                    $adil_persiapan_asesmen = $aspek[$i]['adil'];
                }else if($aspek[$i]['item'] == '- Implementasi Asesmen' ){
                    $validitas_implementasi_asesmen = $aspek[$i]['validitas'];
                    $reliabel_implementasi_asesmen = $aspek[$i]['reliabel'];
                    $fleksibel_implementasi_asesmen = $aspek[$i]['fleksibel'];
                    $adil_implementasi_asesmen = $aspek[$i]['adil'];
                }else if($aspek[$i]['item'] == '- Keputusan Asesmen' ){
                    $validitas_keputusan_asesmen = $aspek[$i]['validitas'];
                    $reliabel_keputusan_asesmen = $aspek[$i]['reliabel'];
                    $fleksibel_keputusan_asesmen = $aspek[$i]['fleksibel'];
                    $adil_keputusan_asesmen = $aspek[$i]['adil'];
                }else if($aspek[$i]['item'] == '- Umpan Balik Asesmen' ){
                    $validitas_umpan_balik_asesmen = $aspek[$i]['validitas'];
                    $reliabel_umpan_balik_asesmen = $aspek[$i]['reliabel'];
                    $fleksibel_umpan_balik_asesmen = $aspek[$i]['fleksibel'];
                    $adil_umpan_balik_asesmen = $aspek[$i]['adil'];
                }
            };
            try {
                // $params = $request->all();
                $ak06 = UjiKompAk06::create([
                    'rencana_asesmen_validitas'=> $validitas_rencana_asesmen,
                    'persiapan_asesmen_validitas'=> $validitas_persiapan_asesmen,
                    'implementasi_asesmen_validitas'=> $validitas_implementasi_asesmen,
                    'keputusan_asesmen_validitas' => $validitas_keputusan_asesmen,
                    'umpan_balik_asesmen_validitas'=> $validitas_umpan_balik_asesmen,
                    'rencana_asesmen_reliabel'=> $reliabel_rencana_asesmen,
                    'persiapan_asesmen_reliabel'=> $reliabel_persiapan_asesmen,
                    'implementasi_asesmen_reliabel'=> $reliabel_implementasi_asesmen,
                    'keputusan_asesmen_reliabel' => $reliabel_keputusan_asesmen,
                    'umpan_balik_asesmen_reliabel'=> $reliabel_umpan_balik_asesmen,
                    'rencana_asesmen_fleksibel'=> $fleksibel_rencana_asesmen,
                    'persiapan_asesmen_fleksibel'=> $fleksibel_persiapan_asesmen,
                    'implementasi_asesmen_fleksibel'=> $fleksibel_implementasi_asesmen,
                    'keputusan_asesmen_fleksibel' => $fleksibel_keputusan_asesmen,
                    'umpan_balik_asesmen_fleksibel'=> $fleksibel_umpan_balik_asesmen,
                    'rencana_asesmen_adil'=> $adil_rencana_asesmen,
                    'persiapan_asesmen_adil'=> $adil_persiapan_asesmen,
                    'implementasi_asesmen_adil'=> $adil_implementasi_asesmen,
                    'keputusan_asesmen_adil' => $adil_keputusan_asesmen,
                    'umpan_balik_asesmen_adil'=> $adil_umpan_balik_asesmen,
                    'rekomendasi_prosedur' => $rekomendasi,
                    'task_skill'=> $aspekPemenuhan[0]['taskSkill'],
                    'task_management_skill' => $aspekPemenuhan[0]['taskManagementSkill'],
                    'contigency_management_skill' => $aspekPemenuhan[0]['contigency'],
                    'job_role' => $aspekPemenuhan[0]['jobRole'],
                    'transfer_skill' => $aspekPemenuhan[0]['transferSkill'],
                    'rekomendasi_konsistensi' => $rekomendasiPemenuhan,
                    'ttd_asesor' => $nama_file,
                    'submit_by' => $params['submitBy'],
                    'komentar' => $komentar,
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_06 = $ak06->id;

                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();


                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 06"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
            
        }
    }
    public function storeAk07(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $id = $request->get('id_uji_komp');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $file = $request->get('signature_asesor');

                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $nama_file = $now . '-asesor-' . 'ak-07' . '-' . $id . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));
                
                $ddAsesmen = [];
                foreach ($request->get('asesmen') as $item) { $ddAsesmen[] = json_decode($item, true);}
                $ujikompak07 = UjiKompAk07::create([
                    'id_uji_komp'=> $request->get('id_uji_komp'),
                    'acuan_pembanding'=>$ddAsesmen[0]['answer'],
                    'metode_asesmen'=> $ddAsesmen[1]['answer'],
                    'instrumen_asesmen'=> $ddAsesmen[2]['answer'],
                    'ttd_asesor' => $nama_file,
                ]);
                foreach ($request->get('potensi_asesi') as $potensi) {
                    $data_pa = json_decode($potensi);
                    $trkak07potensiasesi = TrxAk07PotensiAsesi::create([
                        'id_mst_perangkat_ak_07_potensi_asesi'=> $data_pa->id,
                        'id_trx_uji_komp_ak_07'=> $ujikompak07->id,
                        'potensi'=> $data_pa->potensi,
                    ]);
                }
                foreach ($request->get('persyaratan') as $persyaratan) {
                    $data_psy = json_decode($persyaratan);
                    $trkak07persyaratan = TrxAk07Persyaratan::create([
                        'id_mst_perangkat_ak_07_persyaratan_detail'=> $data_psy->id_mst_detail,
                        'id_trx_uji_komp_ak_07'=> $ujikompak07->id,
                        'keterangan'=> $data_psy->keterangan,
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 07"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
            
        }
    }
    public function updateAk07(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesAk02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $id = $request->get('id_uji_komp');
                $foundUjiKomp = UjiKomp::where('id', $id)->first();
                $foundAk07 = UjiKompAk07::where('id_uji_komp', $id)->first();
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $file = $request->get('signature_asesi');

                $image = str_replace('data:image/png;base64,', '', $file);
                $image = str_replace(' ', '+', $image);
                $nama_file = $now . '-asesi-' . 'ak-07' . '-' . $id . '.png';
                \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_ak_07 = $foundAk07->id;
                $foundUjiKomp->persentase = $progress + 5;
                $foundUjiKomp->save();
                $foundAk07->ttd_asesi = $nama_file;
                $foundAk07->save();

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR AK 07"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }
    public function storeMapa02(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationMapa02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->listMuk[0]['id_uji_komp'];
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $element = $params['listMuk'];
                for ($i = 0; $i < count($element); $i++){
                    $mapa02 = UjiKompMapa02::create([
                        'id_uji_komp' => $element[$i]['id_uji_komp'],
                        'id_mst_mapa_02' => $element[$i]['id'],
                        'potensi_asesi_1'=> $element[$i]['potensi_asesi_1'],
                        'potensi_asesi_2' =>$element[$i]['potensi_asesi_2'],
                        'potensi_asesi_3'=>$element[$i]['potensi_asesi_3'],
                        'potensi_asesi_4'=>$element[$i]['potensi_asesi_4'],
                        'potensi_asesi_5'=>$element[$i]['potensi_asesi_5'],
                        'submit_by'=>$element[$i]['submit_by'],
                        'updated_by'=>$element[$i]['updated_by']
                    ]);
                }

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_mapa_02 = $mapa02->id;
                $foundUjiKomp->persentase = $progress + 5;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();


                DB::commit();
                return response()->json(['message' => "Sukses membuat FR MAPA 02"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeVa(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesVa(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            $id_uji_komp = $request->get('id_uji_komp');
            $foundUjiKomp = UjiKomp::where('id', $id_uji_komp)->first();
            try {
                $params = $request->all();
                $va = UjiKompVa::create([
                    'tim_validasi_1' => $params['tim_validasi_1'],
                    'tim_validasi_2' => $params['tim_validasi_2'],
                    'periode' => $params['periode'],
                    'tujuan_dan_fokus_validasi' => $params['tujuan_dan_fokus_validasi'],
                    'konteks_validasi' => $params['konteks_validasi'],
                    'pendekatan_validasi' => $params['pendekatan_validasi'],
                    'asesor_1' => $params['asesor_1'],
                    'asesor_2' => $params['asesor_2'],
                    'asesor_3' => $params['asesor_3'],
                    'hasil_konfirmasi_asesor_1' => $params['hasil_konfirmasi_asesor_1'],
                    'hasil_konfirmasi_asesor_2' => $params['hasil_konfirmasi_asesor_2'],
                    'hasil_konfirmasi_asesor_3' => $params['hasil_konfirmasi_asesor_3'],
                    'lead_asesor' => $params['lead_asesor'],
                    'hasil_konfirmasi_lead_asesor' => $params['hasil_konfirmasi_lead_asesor'],
                    'manager' => $params['manager'],
                    'hasil_konfirmasi_manager' => $params['hasil_konfirmasi_manager'],
                    'tenaga_ahli' => $params['tenaga_ahli'],
                    'hasil_konfirmasi_tenaga_ahli' => $params['hasil_konfirmasi_tenaga_ahli'],
                    'koordinator_pelatihan' => $params['koordinator_pelatihan'],
                    'hasil_konfirmasi_koordinator_pelatihan' => $params['hasil_konfirmasi_koordinator_pelatihan'],
                    'anggota_asosiasi' => $params['anggota_asosiasi'],
                    'hasil_konfirmasi_anggota_asosiasi' => $params['hasil_konfirmasi_anggota_asosiasi'],
                    'acuan_pembanding' => $params['acuan_pembanding'],
                    'dokumen_terkait' => $params['dokumen_terkait'],
                    'keterampilan_komunikasi' => $params['keterampilan_komunikasi'],
                ]);

                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->id_va = $va->id;
                $persentaseVa = 5;
                $dataSoal = $this->getSoalIa05AndIa07($foundUjiKomp->id_skema);
                $soalIa05 = $dataSoal['soalIa05'] ?? null;
                $soalIa07 = $dataSoal['soalIa07'] ?? null;
                if ($soalIa05 === null && $soalIa07 === null){
                    $persentaseVa = 20;
                }
                if ($soalIa05 && $soalIa07 === null) {
                    $persentaseVa = 15;
                }

                if ($soalIa05 === null && $soalIa07) {
                    $persentaseVa = 15;
                }

                $foundUjiKomp->persentase = $progress + $persentaseVa;
                // if($foundUjiKomp->persentase === 100) {
                //     $foundUjiKomp->status = 1;
                // }

                $foundUjiKomp->save();

                $aspek = $params['aspek'];
                for ($i = 0; $i < count($aspek); $i++) {
                    $vaAspek = UjiKompVaAspek::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_trx_va' => $va->id,
                        'item' => $aspek[$i]['item'],
                        'aturan_v' => $aspek[$i]['aturanV'],
                        'aturan_a' => $aspek[$i]['aturanA'],
                        'aturan_t' => $aspek[$i]['aturanT'],
                        'aturan_m' => $aspek[$i]['aturanM'],
                        'prinsip_v' => $aspek[$i]['prinsipV'],
                        'prinsip_r' => $aspek[$i]['prinsipR'],
                        'prinsip_f' => $aspek[$i]['prinsipF'],
                        'prinsip_f_2' => $aspek[$i]['prinsipF2'],
                    ]);
                }

                $temuan = $params['temuan'];
                for ($x = 0; $x < count($temuan); $x++) {
                    $vaTemuan = UjiKompVaTemuan::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_trx_va' => $va->id,
                        'temuan' => $temuan[$x]['temuan'],
                        'rekomendasi' => $temuan[$x]['rekomendasi'],
                    ]);
                }

                $rencana = $params['rencana'];
                for ($y = 0; $y < count($rencana); $y++) {
                    $vaRencana = UjiKompVaRencana::create([
                        'id_uji_komp' => $foundUjiKomp->id,
                        'id_trx_va' => $va->id,
                        'kegiatan' => $rencana[$y]['kegiatan'],
                        'waktu' => $rencana[$y]['waktu'],
                        'penanggung_jawab' => $rencana[$y]['penanggungJawab'],
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Sukses membuat FR VA"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    private function getValidationRulesVa($isNew = true)
    {
        return [
            'id_uji_komp' => 'required',
        ];
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
            'id_uji_komp' => 'required',
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
    private function getValidationRulesAk06()
    {
        return [
            'aspekPemenuhan'=> 'required',
        ];
    }
    private function getValidationMapa02()
    {
        return [
        'listMuk'=> 'required',
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
