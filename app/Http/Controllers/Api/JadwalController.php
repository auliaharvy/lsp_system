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
use App\Laravue\Models\UjiKompIa05;
use App\Laravue\Models\UjiKompIa05Detail;
use App\Laravue\Models\UjiKompIa06;
use App\Laravue\Models\UjiKompIa06Detail;
use App\Laravue\Models\UjiKompIa11;
use App\Laravue\Models\UjiKompIa11Detail;
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
use Carbon\Carbon;
use Validator;

/**
 * Class UjiKompController
 *
 * @package App\Http\Controllers\Api
 */
class JadwalController extends BaseController
{
    const ITEM_PER_PAGE = 100;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function index(Request $request)
    {
        $currentDate = Carbon::now()->toDateString();

        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $visibility = Arr::get($searchParams, 'visibility', 0);
        $user_id = Arr::get($searchParams, 'user_id', '');
        $role = Arr::get($searchParams, 'role', '');
        $foundUser = User::where('id',$user_id)->first();

        $query = Jadwal::query();
        $query->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_jadwal_asesmen.id_skema');
        $query->join('mst_tuk as c', 'c.id', '=', 'trx_jadwal_asesmen.id_tuk');
        $query->join('mst_asesor as f', 'f.id', '=', 'trx_jadwal_asesmen.id_asesor')
        // ->whereDate('trx_jadwal_asesmen.start_date', '>=', $currentDate) // Jadwal asesmen dari hari ini ke depan
        // ->orderBy('trx_jadwal_asesmen.start_date') // Urutkan berdasarkan tanggal asesmen
        // ->orderBy('trx_jadwal_asesmen.created_at', 'desc')
        ->select('trx_jadwal_asesmen.*', 'b.skema_sertifikasi as nama_skema', 'c.nama as nama_tuk', 'f.nama as nama_asesor');

        if ($visibility === 0) {
            $query->where('trx_jadwal_asesmen.visibility', 0);
        }

        if ($role === 'user') {
            $query->where('f.email', $foundUser->email);
        }
        if ($role === 'assesor') {
            // $query->join('mst_tuk as e', 'e.id', '=', 'b.id_tuk')
            $query->where('f.email', $foundUser->email);
        }

        if (!empty($keyword)) {
            $query->where('b.skema_sertifikasi', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('c.nama', 'LIKE', '%' . $keyword . '%');
        }

        return JadwalResource::collection($query->paginate($limit));
    }

    public function list(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $orderBy = Arr::get($searchParams, 'order_by', 'created_at');
        $orderType = Arr::get($searchParams, 'order_type', 'ASC');

        $query = Jadwal::query();
        $query->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_jadwal_asesmen.id_skema');
        $query->join('mst_tuk as c', 'c.id', '=', 'trx_jadwal_asesmen.id_tuk');
        $query->join('mst_asesor as f', 'f.id', '=', 'trx_jadwal_asesmen.id_asesor')
        ->select('trx_jadwal_asesmen.*', 'b.skema_sertifikasi as nama_skema', 'c.nama as nama_tuk', 'f.nama as nama_asesor');

        if (!empty($keyword)) {
            $query->where('c.nama', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('b.skema_sertifikasi', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('trx_jadwal_asesmen.jadwal', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('f.nama', 'LIKE', '%' . $keyword . '%');
        }

        $query->orderBy($orderBy, $orderType);

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
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $password = substr(str_shuffle(str_repeat($pool, 5)), 0, 6);

                $params = $request->all();
                $jadwal = Jadwal::create([
                    'id_skema' => $params['id_skema'],
                    'id_tuk' => $params['id_tuk'],
                    'id_asesor' => $params['id_asesor'],
                    'persyaratan' => $params['persyaratan'],
                    'jadwal' => $params['jadwal'],
                    'start_date' => $params['start_date'],
                    'end_date' => $params['end_date'],
                    'password_asesi' => $password,
                ]);

                // // create relation asesor
                // $asesor = $params['asesor'];
                // $asesorCount = count($asesor);
                // for($i=0; $i < $asesorCount ; $i++) {
                //     $jadwalAsesor = JadwalAsesor::create([
                //         'id_asesor' => $asesor[$i],
                //         'id_jadwal' => $jadwal->id,
                //     ]);
                // }

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
     * @param  Jadwal $UjiKomp
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $query = Jadwal::where('id',$id)->first();
       
        return $query;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Jadwal $ujikom
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        if ($jadwal === null) {
            return response()->json(['error' => 'Jadwal not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {

                $jadwal->id_skema = $request->get('id_skema');
                $jadwal->id_tuk = $request->get('id_tuk');
                $jadwal->id_asesor = $request->get('id_asesor');
                $jadwal->persyaratan = $request->get('persyaratan');
                $jadwal->jadwal = $request->get('jadwal');
                $jadwal->start_date = $request->get('start_date');
                $jadwal->end_date = $request->get('end_date');
                $jadwal->save();

                DB::commit();
                return new MasterResource($jadwal);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }

    public function hideShow(Request $request, Jadwal $jadwal)
    {
        if ($jadwal === null) {
            return response()->json(['error' => 'Jadwal not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {

                $jadwal->visibility = $request->get('visibility');
                $jadwal->save();

                DB::commit();
                return new MasterResource($jadwal);
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
            Jadwal::where('id',$id)->delete();
            $apl01 = UjiKompApl1::where('id_jadwal', $id)->get();
            for ($i = 0; $i < count($apl01); $i++) {
                $foundUji = UjiKomp::where('id_apl_01',$apl01[$i]['id'])->first();
                UjiKomp::where('id_apl_01', $apl01[$i]['id'])->delete();
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
            }
            return response()->json(['message' => "Success Delete Jadwal"], 201);
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
