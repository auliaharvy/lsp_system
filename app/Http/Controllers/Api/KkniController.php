<?php
/**
 * File KkniController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Kkni;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class KkniController
 *
 * @package App\Http\Controllers\Api
 */
class KkniController extends BaseController
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
        $kkniQuery = Kkni::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $kkniQuery->where('nama', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($kkniQuery->paginate($limit));
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
                // upload file
                $file = $request->file('file');

                $maxFileSizeKB = 10240; // For example, 10MB
            
                // Validate file size
                $validator = Validator::make(
                    ['file' => $file],
                    ['file' => "required|file|max:$maxFileSizeKB"]
                );

                $uniq = Str::random(5);
                $nama_file = $uniq . '-' . $file->getClientOriginalName();
                $file->move('uploads/kkni/', $nama_file);

                $params = $request->all();
                $ia02 = Kkni::create([
                    'nama' => $params['nama'],
                    'jurusan' => $params['jurusan'],
                    'tahun' => $params['tahun'],
                    'upload_path' => $nama_file,
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Upload KKNI"], 200);
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
     * @param  Kkni $kkni
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $kkniQuery = Kkni::where('id',$id)->first();
       
        return $kkniQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Kkni    $kkni
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), $this->getValidationRules(false));
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            $file = $request->file('file');

            $maxFileSizeKB = 10240; // For example, 10MB
        
            // Validate file size
            $validator = Validator::make(
                ['file' => $file],
                ['file' => "required|file|max:$maxFileSizeKB"]
            );

            $kkni = Kkni::find($request->get('id'));
            $kkni->nama = $request->get('nama');
            $kkni->jurusan = $request->get('jurusan');
            $kkni->tahun = $request->get('tahun');

            //find data by id
            if ($file){
                $filename  = public_path('uploads/kkni/').$kkni->upload_path;
                if(File::exists($filename)) {

                    $uniq = Str::random(5);
                    $nama_file = $uniq . '-' . $file->getClientOriginalName();
                    $file->move('uploads/kkni/', $nama_file);

                    //update filename to database
                    $kkni->upload_path = $nama_file;
                    //Found existing file then delete
                    File::delete($filename);  // or unlink($filename);
                }
            }
           $kkni->save();
            return new MasterResource($kkni);
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

            $kkni = Kkni::find($id);
            $filename  = public_path('uploads/kkni/').$kkni->upload_path;
            if(File::exists($filename)) {
                File::delete($filename);  // or unlink($filename);
            }

            Kkni::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete KKNI"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules($isNew = true)
    {
        return [
            'nama' => 'required',
            'jurusan' => 'required',
            'tahun' => 'required',
            'file' => 'required',
        ];
    }
}
