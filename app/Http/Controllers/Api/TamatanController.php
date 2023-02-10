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
use App\Http\Resources\TamatanResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Tamatan;
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
class TamatanController extends BaseController
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
        $query = Tamatan::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $query->join('users', 'users.id', '=', 'trx_tamatan.id_user')
        ->select('trx_tamatan.*', 'users.name', 'users.email', 'users.nama_lengkap', 'users.jenis_kelamin', 'users.nik');

        if (!empty($keyword)) {
            $query->where('users.nik', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('users.nama_lengkap', 'LIKE', '%' . $keyword . '%');
        }

        return TamatanResource::collection($query->paginate($limit));
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
            $tuk = Tamatan::create([
                'id_user' => $params['id_user'],
                'keahlian' => $params['keahlian'],
                'bulan' => $params['bulan'],
                'tahun' => $params['tahun'],
                'status' => $params['status'],
                'tempat' => $params['tempat'],
                'sebagai' => $params['sebagai'],
            ]);
            //$role = Role::findByName($params['role']);

            return response()->json(['message' => "Success Create Pencatan Tamatan"], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Tamatan $tuk
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $query = Tamatan::where('id',$id)->first();
       
        return $query;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tamatan    $tuk
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Tamatan $query)
    {
        if ($query === null) {
            return response()->json(['error' => 'Tamatan not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {

            $query->id_user = $request->get('id_user');
            $query->keahlian = $request->get('keahlian');
            $query->bulan = $request->get('bulan');
            $query->tahun = $request->get('tahun');
            $query->status = $request->get('status');
            $query->tempat = $request->get('tempat');
            $query->sebagai = $request->get('sebagai');
            $query->save();
            return new MasterResource($query);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tamatan $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Tamatan::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete Tamatan"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules($isNew = true)
    {
        return [
            'id_user' => 'required',
        ];
    }
}
