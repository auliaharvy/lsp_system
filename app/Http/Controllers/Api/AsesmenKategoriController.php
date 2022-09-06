<?php
/**
 * File AsesmenKategori.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\AsesmenKategori;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;

/**
 * Class AsesmenKategoriController
 *
 * @package App\Http\Controllers\Api
 */
class AsesmenKategoriController extends BaseController
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
        $kategoriQuery = AsesmenKategori::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $kategoriQuery->where('nama', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($kategoriQuery->paginate($limit));
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
            $kategori = AsesmenKategori::create([
                'nama' => $params['nama'],
            ]);
            //$role = Role::findByName($params['role']);

            return response()->json(['message' => "Success Create Kategori Skema"], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  AsesmenKategori $kategoriQuery
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $kategoriQuery = AsesmenKategori::where('id',$id)->first();
       
        return $kategoriQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AsesmenKategori    $AsesmenKategori
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, AsesmenKategori $kategori)
    {
        if ($kategori === null) {
            return response()->json(['error' => 'Kategori not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $kategori->nama = $request->get('nama');
            $kategori->save();
            return new MasterResource($kategori);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AsesmenKategori $AsesmenKategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            AsesmenKategori::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete Kategori"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules($isNew = true)
    {
        return [
            'nama' => 'required',
        ];
    }
}
