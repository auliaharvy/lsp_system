<?php
/**
 * File AssesorController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Assesor;
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
use File;
use App\Image;
use Carbon\Carbon;

/**
 * Class AssesorController
 *
 * @package App\Http\Controllers\Api
 */
class AssesorController extends BaseController
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
        $asessorQuery = Assesor::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $orderBy = Arr::get($searchParams, 'order_by', 'created_at');
        $orderType = Arr::get($searchParams, 'order_type', 'desc');


        if (!empty($keyword)) {
            $asessorQuery->where('nama', 'LIKE', '%' . $keyword . '%');
            $asessorQuery->orWhere('email', 'LIKE', '%' . $keyword . '%');
            $asessorQuery->orWhere('no_reg', 'LIKE', '%' . $keyword . '%');
            $asessorQuery->orWhere('status_asesor', 'LIKE', '%' . $keyword . '%');
        }

        $asessorQuery->orderBy($orderBy, $orderType);

        return MasterResource::collection($asessorQuery->paginate($limit));
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
            return response()->json(['message' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                //upload sign
                // $file = $request['signature'];
                // $image = str_replace('data:image/png;base64,', '', $file);
                // $image = str_replace(' ', '+', $image);
                // $mytime = Carbon::now();
                // $now = $mytime->toDateString();
                // membuat nama file unik
                // $nama_file = $now . '-' . $params['nama'] . '-' . '.png';
                // \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

                $user = User::create([
                    'name' => $params['nama'],
                    'email' => $params['email'],
                    'password' => Hash::make('lspsmk'),
                    // 'signature' => $nama_file,
                ]);
                $role = Role::findByName('assesor');
                $user->syncRoles($role);
                $assesor = Assesor::create([
                    'no_reg' => $params['no_reg'],
                    'id_user' => $user->id,
                    'nama' => $params['nama'],
                    'email' => $params['email'],
                    'hp' => $params['hp'],
                    'status_asesor' => $params['status_asesor'],
                ]);
                //$role = Role::findByName($params['role']);

                DB::commit();
                return response()->json(['message' => "Success Create Assesor"], 200);
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
     * @param  Assesor $assesor
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $asessorQuery = Assesor::where('id',$id)->first();
       
        return $asessorQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Assesor $assesor
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Assesor $assesor)
    {
        if ($assesor === null) {
            return response()->json(['error' => 'Assesor not found'], 404);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $email = $request->get('email');
                $foundAsesor = Assesor::where('email', $email)->first();
                $foundUser = User::where('email', $email)->first();
                if ($foundAsesor && $foundAsesor->id !== $assesor->id) {
                    return response()->json(['message' => 'Email has been taken'], 403);
                } 

                $assesor->no_reg = $request->get('no_reg');
                $assesor->nama = $request->get('nama');
                $assesor->email = $email;
                $assesor->hp = $request->get('hp');
                $assesor->status_asesor = $request->get('status_asesor');
                $assesor->save();

                $foundUser->name = $request->get('nama');
                $foundUser->email = $email;
                $foundUser->save();

                DB::commit();
                return new MasterResource($assesor);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Assesor $assesor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Assesor::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete Assesor"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules($isNew = true)
    {
        return [
            'no_reg' => 'required',
            'email' => $isNew ? 'required|email|unique:users' : 'required|email',
            'nama' => 'required',
        ];
    }
}
