<?php
/**
 * File PemegangSertifikatController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\PemegangSertifikat;
use App\Laravue\Models\UjiKomp;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class PemegangSertifikatController
 *
 * @package App\Http\Controllers\Api
 */
class PemegangSertifikatController extends BaseController
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
        $pemegangSertifikatQuery = PemegangSertifikat::query();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $id = Arr::get($searchParams, 'id', '');
        $orderBy = Arr::get($searchParams, 'order_by', 'nama');
        $orderType = Arr::get($searchParams, 'order_type', 'ASC');
    
        if (!empty($keyword)) {
            $pemegangSertifikatQuery->where('nama', 'LIKE', '%' . $keyword . '%')
                ->orWhere('no_registrasi', 'LIKE', '%' . $keyword . '%')
                ->orWhere('skema_sertifikasi', 'LIKE', '%' . $keyword . '%')
                ->orWhere('no_sertifikat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('masa_berlaku', 'LIKE', '%' . $keyword . '%');
        }
    
        if (!empty($id)) {
            $pemegangSertifikatQuery->orWhere('id', $id);
        }
    
        $pemegangSertifikatQuery->orderBy($orderBy, $orderType);
    
        return MasterResource::collection($pemegangSertifikatQuery->paginate($limit));
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
                $pemegangSertifikat = PemegangSertifikat::create([
                    'nama' => $params['nama'],
                    'id_uji_komp' => $params['id_uji_komp'],
                    'no_registrasi' => $params['no_registrasi'],
                    'skema_sertifikasi' => $params['skema_sertifikasi'],
                    'no_sertifikat' => $params['no_sertifikat'],
                    'masa_berlaku' => $params['masa_berlaku'],
                ]);

                $foundUjiKomp = UjiKomp::where('id', $params['id_uji_komp'])->first();
                $progress = $foundUjiKomp->persentase;
                $foundUjiKomp->persentase = $progress + 5;
                if($foundUjiKomp->persentase === 100) {
                    $foundUjiKomp->status = 1;
                }
                $foundUjiKomp->save();

                DB::commit();
                return response()->json(['message' => "Sukses Upload pemegang sertifikat"], 200);
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
     * @param  PemegangSertifikat $pemegangSertifikat
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       
        $pemegangSertifikatQuery = PemegangSertifikat::where('id_uji_komp',$id)->first();
       
        return $pemegangSertifikatQuery;
    }

    /**
     * Display the specified resource.
     *
     * @param  PemegangSertifikat $pemegangSertifikat
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function slug($slug)
    {
       
        $pemegangSertifikatQuery = PemegangSertifikat::where('slug', $slug)->first();
       
        return $pemegangSertifikatQuery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PemegangSertifikat    $pemegangSertifikat
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(), 
            $this->getValidationRules(false)
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();

            try{
                $params = $request->all();

                $pemegangSertifikat = PemegangSertifikat::find($params['id']);
                $pemegangSertifikat->nama = $params['nama'];
                $pemegangSertifikat->id_uji_komp = $params['id_uji_komp'];
                $pemegangSertifikat->no_registrasi = $params['no_registrasi'];
                $pemegangSertifikat->skema_sertifikasi = $params['skema_sertifikasi'];
                $pemegangSertifikat->no_sertifikat = $params['no_sertifikat'];
                $pemegangSertifikat->masa_berlaku = $params['masa_berlaku'];

                $pemegangSertifikat->save();

                DB::commit();
                return response()->json(['message' => "Sukses update data pemegang sertifikat"], 200);
            } catch(\Exception $e){
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
            }
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
            $pemegangSertifikat = PemegangSertifikat::find($id);
            $filename  = public_path('uploads/pemegangSertifikat/').$article->image;
            // hapus file yang sudah tidak digunakan
            if(File::exists($filename)) {
                File::delete($filename);  // or unlink($filename);
            }

            PemegangSertifikat::where('id',$id)->delete();

            return response()->json(['message' => "Success Delete pemegangSertifikat"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }

    }

    private function getValidationRules()
    {
        return [
            'nama' => 'required',
            'id_uji_komp' => 'required',
            'no_registrasi' => 'required',
            'skema_sertifikasi' => 'required',
            'no_sertifikat' => 'required',
            'masa_berlaku' => 'required',
        ];
    }
}
