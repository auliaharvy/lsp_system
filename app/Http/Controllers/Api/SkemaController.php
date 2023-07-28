<?php
/**
 * File SkemaController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Http\Resources\SkemaResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Skema;
use App\Laravue\Models\SkemaUnit;
use App\Laravue\Models\SkemaElemenUnit;
use App\Laravue\Models\SkemaKukElemen;
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
 * Class SkemaController
 *
 * @package App\Http\Controllers\Api
 */
class SkemaController extends BaseController
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
        $id_skema = Arr::get($searchParams, 'id_skema', '');
        $kategori = Arr::get($searchParams, 'kategori', '');

        $skemaQuery = Skema::query();
        $skemaQuery->join('mst_skema_sertifikasi_kategori as a', 'a.id', '=', 'mst_skema_sertifikasi.kategori_id');
        $skemaQuery->leftJoin('mst_skema_sertifikasi_unit_kompetensi as b', 'b.id_skema', '=', 'mst_skema_sertifikasi.id')
        ->groupBy('mst_skema_sertifikasi.id')
        ->select('mst_skema_sertifikasi.*', 'a.nama as nama_kategori', DB::raw('COUNT(b.id) as jumlah_unit_count'));

        if (!empty($keyword)) {
            $skemaQuery->where('kode_skema', 'LIKE', '%' . $keyword . '%');
            $skemaQuery->orWhere('skema_sertifikasi', 'LIKE', '%' . $keyword . '%');
        }

        if (!empty($id_skema)) {
            $skemaQuery->where('mst_skema_sertifikasi.id', 'LIKE', '%' . $id_skema. '%');
        }

        if (!empty($kategori)) {
            $skemaQuery->where('a.nama', 'LIKE', '%' . $kategori. '%');
        }


        // return SkemaResource::collection($skemaQuery->paginate($limit));
        return SkemaResource::collection($skemaQuery->paginate($limit));
    }

    public function indexUnit(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = SkemaUnit::query();
        $query->where('mst_skema_sertifikasi_unit_kompetensi.id_skema', $id_skema)
        ->select('mst_skema_sertifikasi_unit_kompetensi.*');

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
                $skema = Skema::create([
                    'kode_skema' => $params['kode_skema'],
                    'skema_sertifikasi' => $params['skema_sertifikasi'],
                    'kategori_id' => $params['kategori_id'],
                    'jumlah_unit' => $params['jumlah_unit'],
                    'kblui' => $params['kblui'],
                    'kbji' => $params['kbji'],
                    'jenjang' => $params['jenjang'],
                    'kode_sektor' => $params['kode_sektor'],
                    'visibilitas' => $params['visibilitas'],
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
     * @param  Skema $Skema
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $skemaQuery = Skema::where('id',$id)->first();
       
        return $skemaQuery;
    }

    public function countSkema(Request $request){
        $countQuery = Skema::query();
        $countQuery->select(DB::raw('COUNT(mst_skema_sertifikasi.id) as jumlah_sertifikasi'));

        $resultCountQuery = $countQuery->first();

        return $resultCountQuery->jumlah_sertifikasi;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Skema $skema
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Skema $skema)
    {
        if ($skema === null) {
            return response()->json(['error' => 'Skema not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $kode_skema = $request->get('kode_skema');
                $foundSkema = Skema::where('kode_skema', $kode_skema)->first();
                if ($foundSkema && $foundSkema->id !== $skema->id) {
                    return response()->json(['error' => 'Kode Skema has been taken'], 403);
                } 

                $skema->kode_skema = $kode_skema;
                $skema->skema_sertifikasi = $request->get('skema_sertifikasi');
                $skema->kategori_id = $request->get('kategori_id');
                $skema->jumlah_unit = $request->get('jumlah_unit');
                $skema->kblui = $request->get('kblui');
                $skema->kbji = $request->get('kbji');
                $skema->jenjang = $request->get('jenjang');
                $skema->kode_sektor = $request->get('kode_sektor');
                $skema->visibilitas = $request->get('visibilitas');
                $skema->save();

                DB::commit();
                return new MasterResource($skema);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Skema $skema
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Skema::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete Skema"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    //Controller Skema Unit
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUnit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationUnitRules(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $skema = Skema::create([
                    'id_skema' => $params['id_skema'],
                    'kode_unit' => $params['kode_unit'],
                    'unit_kompetensi' => $params['unit_kompetensi'],
                ]);
                DB::commit();
                return response()->json(['message' => "Success Create Unit Skema"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

     /**
     * Upload a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadUnit(Request $request)
    {   
        $validator = Validator::make(
            $request->all(),
            $this->getValidationUnitRules(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                for ($i = 0; $i < count($params['unit']); $i++) {
                    $kode_unit = $params['unit'][$i]['kode_unit'];
                    $fountUnit = SkemaUnit::where('kode_unit', $kode_unit)->first();
                    if ($fountUnit) {
                        return response()->json(['error' => 'Kode Unit ' . $kode_unit . ' sudah pernah di upload'], 403);
                    } 
                    $skemaUnit = SkemaUnit::create([
                        'id_skema' => $params['id_skema'],
                        'kode_unit' => $params['unit'][$i]['kode_unit'],
                        'unit_kompetensi' => $params['unit'][$i]['unit_kompetensi'],
                    ]);
                }
                DB::commit();
                return response()->json(['message' => "Success Create Unit Skema"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
            
        }
    }

    public function uploadElemenUnit(Request $request)
    {   
            DB::beginTransaction();
            try {
                $params = $request->all();
                for ($i = 0; $i < count($params); $i++) {
                    $validator = Validator::make(
                        $params[$i],
                        $this->getValidationElemenUnitRules(),
                    );
            
                    if ($validator->fails()) {
                        return response()->json(['errors' => $validator->errors()], 403);
                    } else {
                        $kode_unit = $params[$i]['kode_unit'];
                        $skemaUnit= SkemaUnit::where('kode_unit', $kode_unit)->first();
                        $unitElemen = SkemaElemenUnit::create([
                            'id_unit' => $skemaUnit->id,
                            'nama_elemen' => $params[$i]['nama_elemen'],
                        ]);
                    }
                }
                DB::commit();
                return response()->json(['message' => "Success Upload Elemen Unit Skema"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
    }

    public function uploadKuk(Request $request)
    {   
        DB::beginTransaction();
        try {
            $params = $request->all();
            for ($i = 0; $i < count($params); $i++) {
                $validator = Validator::make(
                    $params[$i],
                    $this->getValidationKukRules(),
                );
        
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 403);
                } else {
                    $foundElemen = SkemaElemenUnit::where('id', $params[$i]['id_elemen'])->first();
                    if ($foundElemen) {
                        $kuk = SkemaKukElemen::create([
                            'id_elemen' => $params[$i]['id_elemen'],
                            'kuk' => $params[$i]['kuk'],
                            'pertanyaan_kuk' => $params[$i]['kuk'],
                            'jumlah_bukti' => 1,
                            'jenis_bukti_id' => 2,
                            'bukti' => 'Raport',
                        ]);
                    } else {
                        return response()->json(['error' => 'Elemen ' . $params[$i]["nama_elemen"]. ' Belum ada, silakan buat elemen terlebih dahulu'], 403);
                    }
                    
                }
            }
            DB::commit();
            return response()->json(['message' => "Success Upload Elemen Unit Skema"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
            //return $e->getMessage();
        }
    }

    private function getValidationRules($isNew = true)
    {
        return [
            'kode_skema' => 'required',
            'skema_sertifikasi' => 'required',
            'kategori_id' => 'required',
        ];
    }

    private function getValidationUnitRules()
    {
        return [
            'id_skema' => 'required',
        ];
    }

    private function getValidationElemenUnitRules()
    {
        return [
            'kode_unit' => 'required',
            'nama_elemen' => 'required',
        ];
    }

    private function getValidationKukRules()
    {
        return [
            'id_elemen' => 'required',
            'kuk' => 'required',
        ];
    }
}
