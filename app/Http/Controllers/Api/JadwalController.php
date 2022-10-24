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
use App\Http\Resources\JadwalResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Jadwal;
use App\Laravue\Models\JadwalAsesor;
use App\Laravue\Models\Tuk;
use App\Laravue\Models\Skema;
use App\Laravue\Models\Asesor;
use App\Laravue\Models\Perangkat;
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
class JadwalController extends BaseController
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

        $query = Jadwal::query();
        $query->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_jadwal_asesmen.id_skema');
        $query->join('mst_tuk as c', 'c.id', '=', 'trx_jadwal_asesmen.id_tuk');
        $query->join('mst_perangkat_asesmen as d', 'd.id', '=', 'trx_jadwal_asesmen.id_perangkat');
        $query->join('rel_jadwal_has_asesor as e', 'e.id_jadwal', '=', 'trx_jadwal_asesmen.id');
        $query->join('mst_asesor as f', 'f.id', '=', 'e.id_asesor')
        ->groupBy('trx_jadwal_asesmen.id')
        ->select('trx_jadwal_asesmen.*', 'b.skema_sertifikasi as nama_skema', 'c.nama as nama_tuk', 'd.nama_perangkat', 'f.nama as nama_asesor');

        if (!empty($keyword)) {
            $query->where('b.skema_sertifikasi', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('c.nama', 'LIKE', '%' . $keyword . '%');
        }

        return JadwalResource::collection($query->paginate($limit));
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
                $jadwal = Jadwal::create([
                    'id_skema' => $params['id_skema'],
                    'id_tuk' => $params['id_tuk'],
                    'id_perangkat' => $params['id_perangkat'],
                    'persyaratan' => $params['persyaratan'],
                    'jadwal' => $params['jadwal'],
                    'start_date' => $params['start_date'],
                    'end_date' => $params['end_date'],
                ]);

                // create relation asesor
                $asesor = $params['asesor'];
                $asesorCount = count($asesor);
                for($i=0; $i < $asesorCount ; $i++) {
                    $jadwalAsesor = JadwalAsesor::create([
                        'id_asesor' => $asesor[$i],
                        'id_jadwal' => $jadwal->id,
                    ]);
                }

                DB::commit();
                return response()->json(['message' => "Success Create Jadwal"], 200);
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
            'id_skema' => 'required',
        ];
    }
}
