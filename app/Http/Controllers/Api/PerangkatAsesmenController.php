<?php
/**
 * File TukController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\PerangkatAsesmen;
use App\Laravue\Models\DetailPerangkatAsesmen;
use App\Laravue\Models\JenisPerangkat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;

/**
 * Class TukController
 *
 * @package App\Http\Controllers\Api
 */
class PerangkatAsesmenController extends BaseController
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
        $perangkatQuery = PerangkatAsesmen::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $perangkatQuery->join('mst_skema_sertifikasi', 'mst_skema_sertifikasi.id', '=', 'mst_perangkat_asesmen.skema_id')
        ->select('mst_perangkat_asesmen.*', 'mst_skema_sertifikasi.skema_sertifikasi');

        if (!empty($keyword)) {
            $perangkatQuery->where('nama_perangkat', 'LIKE', '%' . $keyword . '%');
            $perangkatQuery->orWhere('kode_perangkat', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($perangkatQuery->paginate($limit));
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
            $params = $request->all();
            $perangkat = PerangkatAsesmen::create([
                'nama_perangkat' => $params['nama_perangkat'],
                'kode_perangkat' => $params['kode_perangkat'],
                'skema_id' => $params['id_skema'],
                'versi' => $params['versi'],
                'description' => $params['description'],
                'author' => $params['author'],
            ]);
            //$role = Role::findByName($params['role']);

            return response()->json(['message' => "Success Create Perangkat"], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Tuk $tuk
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $tukQuery = Tuk::where('id',$id)->first();
       
        return $tukQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tuk    $tuk
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Tuk $tuk)
    {
        if ($tuk === null) {
            return response()->json(['error' => 'TUK not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $kode_tuk = $request->get('kode_tuk');
            $found = Tuk::where('kode_tuk', $kode_tuk)->first();
            if ($found && $found->id !== $tuk->id) {
                return response()->json(['error' => 'Kode TUK has been taken'], 403);
            }

            $tuk->kode_tuk = $kode_tuk;
            $tuk->nama = $request->get('nama');
            $tuk->alamat = $request->get('alamat');
            $tuk->no_telp = $request->get('no_telp');
            $tuk->email = $request->get('email');
            $tuk->save();
            return new MasterResource($tuk);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Tuk::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete TUK"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function indexDetail(Request $request)
    {
        $searchParams = $request->all();
        $detailPerangkatQuery = DetailPerangkatAsesmen::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $detailPerangkatQuery->join('mst_perangkat_asesmen', 'mst_perangkat_asesmen.id', '=', 'mst_perangkat_asesmen_detail.id_perangkat')
        ->join('mst_perangkat_asesmen_kategori', 'mst_perangkat_asesmen_kategori.id', '=', 'mst_perangkat_asesmen_detail.id_jenis_perangkat')
        ->select('mst_perangkat_asesmen_detail.*', 'mst_perangkat_asesmen.nama_perangkat', 'mst_perangkat_asesmen.kode_perangkat', 
        'mst_perangkat_asesmen_kategori.nama as jenis');

        if (!empty($keyword)) {
            $detailPerangkatQuery->where('nama', 'LIKE', '%' . $keyword . '%');
            $detailPerangkatQuery->orWhere('kode', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($detailPerangkatQuery->paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesDetail(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $perangkat = DetailPerangkatAsesmen::create([
                'id_perangkat' => $params['id_perangkat'],
                'nama' => $params['nama'],
                'kode' => $params['kode'],
                'id_jenis_perangkat' => $params['id_jenis_perangkat'],
                'versi' => $params['versi'],
                'jumlah_soal' => $params['jumlah_soal'],
                'waktu_pengerjaan' => $params['waktu_pengerjaan'],
                'description' => $params['description'],
                // 'browse' => $params['browse'],
                'author' => $params['author'],
            ]);
            //$role = Role::findByName($params['role']);

            return response()->json(['message' => "Success Create Detail Perangkat"], 200);
        }
    }

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    public function indexJenis(Request $request)
    {
        $searchParams = $request->all();
        $jenisPerangkatQuery = JenisPerangkat::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $jenisPerangkatQuery->where('nama', 'LIKE', '%' . $keyword . '%');
            $jenisPerangkatQuery->orWhere('kode', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($jenisPerangkatQuery->paginate($limit));
    }


    private function getValidationRules($isNew = true)
    {
        return [
            'id_skema' => 'required',
            'nama_perangkat' => 'required',
            'kode_perangkat' => 'required',
        ];
    }

    private function getValidationRulesDetail($isNew = true)
    {
        return [
            'id_perangkat' => 'required',
            'nama' => 'required',
            'kode' => 'required',
        ];
    }
}
