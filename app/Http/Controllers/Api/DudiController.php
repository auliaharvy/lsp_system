<?php
/**
 * File DudiController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Dudi;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class DudiController
 *
 * @package App\Http\Controllers\Api
 */
class DudiController extends BaseController
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
        $dudiQuery = Dudi::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');

        if (!empty($keyword)) {
            $dudiQuery->where('nama_perusahaan', 'LIKE', '%' . $keyword . '%');
        }

        return MasterResource::collection($dudiQuery->paginate($limit));
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
                $file->move('uploads/dudi/', $nama_file);

                $params = $request->all();
                $dudi = Dudi::create([
                    'nama_perusahaan' => $params['nama_perusahaan'],
                    'tahun_kerjasama' => $params['tahun_kerjasama'],
                    'image' => $nama_file,
                ]);
                DB::commit();
                return response()->json(['message' => "Sukses Upload DUDI"], 200);
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
     * @param  Dudi $dudi
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $dudiQuery = Dudi::where('id',$id)->first();
       
        return $dudiQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Dudi    $dudi
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

            $dudi = Dudi::find($request->get('id'));
            $dudi->nama_perusahaan = $request->get('nama_perusahaan');
            $dudi->tahun_kerjasama = $request->get('tahun_kerjasama');

            //find data by id
            $filename  = public_path('uploads/dudi/').$dudi->image;
            if ($file) {
                if(File::exists($filename)) {

                    $uniq = Str::random(5);
                    $nama_file = $uniq . '-' . $file->getClientOriginalName();
                    $file->move('uploads/dudi/', $nama_file);

                    //update filename to database
                    $dudi->image = $nama_file;
                    //Found existing file then delete
                    File::delete($filename);  // or unlink($filename);
                }
            }
            $dudi->save();
            return new MasterResource($dudi);

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
            $dudi = Dudi::find($id);
            $filename  = public_path('uploads/dudi/').$dudi->image;
            // hapus file yang sudah tidak digunakan
            if(File::exists($filename)) {
                File::delete($filename);  // or unlink($filename);
            }

            Dudi::where('id',$id)->delete();

            return response()->json(['message' => "Success Delete DUDI"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules($isNew = true)
    {
        return [
            'nama_perusahaan' => 'required',
        ];
    }
}
