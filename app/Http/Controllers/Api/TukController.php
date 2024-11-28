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
use App\Laravue\Models\Tuk;
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
class TukController extends BaseController
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
        $searchParams = $request->all();
        $tukQuery = Tuk::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $orderBy = Arr::get($searchParams, 'order_by', 'nama');
        $orderType = Arr::get($searchParams, 'order_type', 'ASC');
        
        if (!empty($keyword)) {
            $tukQuery->where('nama', 'LIKE', '%' . $keyword . '%');
            $tukQuery->orWhere('kode_tuk', 'LIKE', '%' . $keyword . '%');
        }

        $tukQuery->orderBy($orderBy, $orderType);

        return MasterResource::collection($tukQuery->paginate($limit));
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
            $tuk = Tuk::create([
                'kode_tuk' => $params['kode_tuk'],
                'nama' => $params['nama'],
                'alamat' => $params['alamat'],
                'no_telp' => $params['no_telp'],
                'email' => $params['email'],
            ]);
            //$role = Role::findByName($params['role']);

            return response()->json(['message' => "Success Create TUK"], 200);
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

    private function getValidationRules($isNew = true)
    {
        return [
            'kode_tuk' => 'required',
            'nama' => 'required',
        ];
    }
}
