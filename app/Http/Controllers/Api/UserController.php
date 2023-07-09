<?php
/**
 * File UserController.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 * @package Laravue
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\UserResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Assesor;
use App\Laravue\Models\Role;
use App\Laravue\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends BaseController
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
        $userQuery = User::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $role = Arr::get($searchParams, 'role', '');
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($role)) {
            $userQuery->whereHas('roles', function($q) use ($role) { $q->where('name', $role); });
        }

        if (!empty($keyword)) {
            $userQuery->where('name', 'LIKE', '%' . $keyword . '%');
            $userQuery->orWhere('email', 'LIKE', '%' . $keyword . '%');
        }

        return UserResource::collection($userQuery->paginate($limit));
    }

    public function findNik(Request $request)
    {
        $searchParams = $request->all();
        $nik = Arr::get($searchParams, 'nik', '');
        $userQuery = User::where('nik', $nik)->first();
        if ($userQuery) {
            return $userQuery;
        } else {
            return response()->json(['error' => 'NIK Tidak Di temukan'], 403);
        }
        
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
            array_merge(
                $this->getValidationRules(),
                [
                    'password' => ['required', 'min:6'],
                    'confirmPassword' => 'same:password',
                ]
            )
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $user = User::create([
                'name' => $params['name'],
                'email' => $params['email'],
                'password' => Hash::make($params['password']),
            ]);
            $role = Role::findByName($params['role']);
            $user->syncRoles($role);

            return new UserResource($user);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setRole(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array_merge(
                $this->getValidationRulesRole(),
                [
                    'userId' => ['required'],
                ]
            )
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            if ($params['submitRole'] !== 'admin') {
                return response()->json(['message' => 'Selain admin tidak boleh merubah role user'], 403);    
            } else {
                $id = $request->get('userId');
                $found = User::where('id', $id)->first();

                $role = Role::findByName($params['role']);
                $found->syncRoles($role);

                return new UserResource($found);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    // public function show(User $user)
    // {
    //     return new UserResource($user);
    // }

    public function show($nameAsesor)
    {
        // function ini dibuat untuk ambil data signature di module ia 11 
        $userQuery = User::where('name',$nameAsesor)->first();
       
        return $userQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request, User $user)
    {
        if ($user === null) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $params = $request->all();
        $newPassword = Hash::make($params['newPassword']);

        $validator = Validator::make($request->all(), $this->getValidationRulesPassword());
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 403);
        } else {
            $id = $request->get('userId');
            $found = User::where('id', $id)->first();

            $user->password = $newPassword;
            $user->save();
            return new UserResource($user);
        }
    }

    public function addSignature(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRulesSignature());

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 403);
        } else {
            $params = $request->all();
            $id = $request->get('user_id');
            $found = User::where('id', $id)->first();
            $file = $request['signature'];
            $image = str_replace('data:image/png;base64,', '', $file);
            $image = str_replace(' ', '+', $image);
            $mytime = Carbon::now();
            $now = $mytime->toDateString();
            // membuat nama file unik
            $nama_file = $now . '-' . $params['user_id'] . '-' . $found->email . '-' . '.png';
            \File::put(public_path(). '/uploads/users/signature/' . $nama_file, base64_decode($image));

            $found->signature = $nama_file;
            $found->save();
            return new UserResource($found);
        }
    }

    public function update(Request $request, User $user)
    {
        if ($user === null) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $currentUser = Auth::user();
        if ($currentUser->id !== $user->id) {
            return response()->json(['error' => 'Permission denied'], 403);
        }

        if ($currentUser->id !== $user->id) {
            return response()->json(['error' => 'Permission denied'], 403);
        }

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $user_id = $request->get('id');
                $roles = $request->get('roles');
                $found = User::where('id', $user_id)->first();
                $email = $found->email;
                $foundAsesor = Assesor::where('email', $email)->first();
                if ($found && $found->id !== $user->id) {
                    return response()->json(['error' => 'Email has been taken'], 403);
                }

                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->save();

                if($roles[0] === 'assesor') {
                    $foundAsesor->nama = $request->get('name');
                    $foundAsesor->email = $request->get('email');
                    $foundAsesor->save();
                }

                DB::commit();
                return new UserResource($user);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage(), 'error' => $e->getMessage()], 400);
            }
            
            
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function updatePermissions(Request $request, User $user)
    {
        if ($user === null) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->isAdmin()) {
            return response()->json(['error' => 'Admin can not be modified'], 403);
        }

        $permissionIds = $request->get('permissions', []);
        $rolePermissionIds = array_map(
            function($permission) {
                return $permission['id'];
            },

            $user->getPermissionsViaRoles()->toArray()
        );

        $newPermissionIds = array_diff($permissionIds, $rolePermissionIds);
        $permissions = Permission::allowed()->whereIn('id', $newPermissionIds)->get();
        $user->syncPermissions($permissions);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return response()->json(['error' => 'Ehhh! Can not delete admin user'], 403);
        }

        try {
            $user->delete();
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

        return response()->json(null, 204);
    }

    /**
     * Get permissions from role
     *
     * @param User $user
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function permissions(User $user)
    {
        try {
            return new JsonResponse([
                'user' => PermissionResource::collection($user->getDirectPermissions()),
                'role' => PermissionResource::collection($user->getPermissionsViaRoles()),
            ]);
        } catch (\Exception $ex) {
            response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    /**
     * @param bool $isNew
     * @return array
     */
    private function getValidationRules($isNew = true)
    {
        return [
            'name' => 'required',
            'email' => $isNew ? 'required|email|unique:users' : 'required|email',
            'roles' => [
                'required',
                'array'
            ],
        ];
    }

    private function getValidationRulesRole()
    {
        return [
            'role' => 'required',
        ];
    }

    private function getValidationRulesPassword()
    {
        return [
            'newPassword' => 'required',
        ];
    }

    private function getValidationRulesSignature()
    {
        return [
            'user_id' => 'required',
        ];
    }
}
