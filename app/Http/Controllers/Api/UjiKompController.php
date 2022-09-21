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
use App\Laravue\JsonResponse;
use App\Laravue\Models\UjiKomp;
use App\Laravue\Models\Tuk;
use App\Laravue\Models\Skema;
use App\Laravue\Models\User;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;

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

        $query = UjiKomp::query();
        $query->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_uji_komp_apl_02.id_skema');
        $query->join('mst_tuk as c', 'c.id', '=', 'trx_uji_komp_apl_02.id_tuk')
        ->select('trx_uji_komp_apl_02.*', 'b.skema_sertifikasi as nama_skema', 'c.nama as nama_tuk');

        if (!empty($keyword)) {
            $query->where('nama_lengkap', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('nama_sekolah', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($query->paginate($limit));
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
                $skema = UjiKomp::create([
                    'id_skema' => $params['id_skema'],
                    'id_tuk' => $params['id_tuk'],
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
                    'foto' => $params['foto'],
                    'identitas' => $params['identitas'],
                    'raport' => $params['raport'],
                    'sertifikat' => $params['sertifikat'],
                    'status' => 0,
                ]);
                DB::commit();
                return response()->json(['message' => "Success Create Skema"], 200);
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


    private function getValidationRules($isNew = true)
    {
        return [
            'nik' => 'required',
        ];
    }
}
