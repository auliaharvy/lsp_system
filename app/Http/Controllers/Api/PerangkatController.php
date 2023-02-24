<?php
/**
 * File PerangkatController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;
use App\Http\Resources\MasterResource;
use App\Http\Resources\MstIa05Resource;
use App\Http\Resources\UjiKompResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\UjiKomp;
use App\Laravue\Models\UjiKompApl1;
use App\Laravue\Models\UjiKompApl2;
use App\Laravue\Models\UjiKompApl2Detail;
use App\Laravue\Models\UjiKompAk01;
use App\Laravue\Models\UjiKompAk03;
use App\Laravue\Models\UjiKompAk05;
use App\Laravue\Models\UjiKompAk03Detail;
use App\Laravue\Models\UjiKompIa01;
use App\Laravue\Models\UjiKompIa01Detail;
use App\Laravue\Models\UjiKompIa02;
use App\Laravue\Models\UjiKompIa03;
use App\Laravue\Models\UjiKompIa03Detail;
use App\Laravue\Models\UjiKompIa11;
use App\Laravue\Models\UjiKompIa11Detail;
use App\Laravue\Models\Tuk;
use App\Laravue\Models\JadwalAsesor;
use App\Laravue\Models\Skema;
use App\Laravue\Models\User;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use App\Laravue\Models\MstFrIa02;
use App\Laravue\Models\MstFrIa03;
use App\Laravue\Models\MstFrIa05;
use App\Laravue\Models\MstFrIa05Detail;
use App\Laravue\Models\MstFrIa06;
use App\Laravue\Models\MstFrIa07;
use App\Laravue\Models\MstFrAk03;
use App\Laravue\Models\MstFrIa11;
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
 * Class PerangkatController
 *
 * @package App\Http\Controllers\Api
 */
class PerangkatController extends BaseController
{
    const ITEM_PER_PAGE = 15;

    public function indexIa02(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa02::query();
        $query->where('mst_perangkat_ia_02.id_skema', $id_skema)
        ->select('mst_perangkat_ia_02.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexIa03(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa03::query();
        $query->where('mst_perangkat_ia_03.id_skema', $id_skema)
        ->select('mst_perangkat_ia_03.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexIa05(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa05::query();
        $query->where('mst_perangkat_ia_05.id_skema', $id_skema)
        ->join('mst_skema_sertifikasi_unit_kompetensi as a', 'a.id', '=', 'mst_perangkat_ia_05.id_unit_komp')
        ->leftJoin('mst_perangkat_ia_05_a as b', 'b.id', '=', 'mst_perangkat_ia_05.kunci_jawaban')
        ->select('mst_perangkat_ia_05.*', 'a.kode_unit', 'a.unit_kompetensi', 'b.no_jawaban as no_kunci_jawaban', 'b.jawaban as isi_kunci_jawaban');

        return MstIa05Resource::collection($query->paginate($limit));
    }

    public function indexIa06(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa06::query();
        $query->where('mst_perangkat_ia_06.id_skema', $id_skema)
        ->join('mst_skema_sertifikasi_unit_kompetensi as a', 'a.id', '=', 'mst_perangkat_ia_06.id_unit_komp')
        ->select('mst_perangkat_ia_06.*', 'a.kode_unit', 'a.unit_kompetensi');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexIa07(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa07::query();
        $query->where('mst_perangkat_ia_07.id_skema', $id_skema)
        ->join('mst_skema_sertifikasi_unit_kompetensi as a', 'a.id', '=', 'mst_perangkat_ia_07.id_unit_komp')
        ->select('mst_perangkat_ia_07.*', 'a.kode_unit');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexIa11(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
     
        $query = MstFrIa11::query()
        ->select('mst_perangkat_ia_11.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function indexAk03(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $query = MstFrAk03::query()
        ->select('mst_perangkat_ak_03.*');

        return MasterResource::collection($query->paginate($limit));
    }

    public function storeIa02(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa02(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                // upload file
                $file = $request->file('file');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . '-' . $file->getClientOriginalName();
                $file->move('uploads/perangkat/file/', $nama_file);
                $file = 'uploads/perangkat/file/'.$nama_file;

                $params = $request->all();
                $ia02 = MstFrIa02::create([
                    'id_skema' => $params['id_skema'],
                    'versi' => $params['versi'],
                    'filename' => $params['filename'],
                    'file' => $file,
                    'updated_by' => $params['user_id'],
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Upload Perangkat FR IA 02"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeIa03(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa03(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $ia02 = MstFrIa03::create([
                    'id_skema' => $params['id_skema'],
                    'pertanyaan' => $params['pertanyaan'],
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Buat Perangkat FR IA 03"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeIa05(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa03(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $ia05 = MstFrIa05::create([
                    'id_skema' => $params['id_skema'],
                    'id_unit_komp' => $params['id_unit_komp'],
                    'pertanyaan' => $params['pertanyaan'],
                    // 'kunci_jawaban' => $params['kunci_jawaban'],
                    'updated_by' => $params['updated_by'],
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Buat Soal Perangkat FR IA 05"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeIa05Detail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa05(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $ia05 = MstFrIa05Detail::create([
                    'id_mst_ia_05' => $params['id_mst_ia_05'],
                    'no_jawaban' => $params['no_jawaban'],
                    'jawaban' => $params['jawaban'],
                    'updated_by' => $params['updated_by'],
                ]);

                if ($params['kunci_jawaban'] === 1) {
                    $foundMst05 = MstFrIa05::where('id', $params['id_mst_ia_05'])->first();
                    $foundMst05->kunci_jawaban = $ia05->id;
                    $foundMst05->save();
                }

                DB::commit();
                return response()->json(['message' => "Sukses Buat Pilihan Jawaban Perangkat FR IA 05"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeIa06(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa03(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $ia02 = MstFrIa06::create([
                    'id_skema' => $params['id_skema'],
                    'id_unit_komp' => $params['id_unit_komp'],
                    'pertanyaan' => $params['pertanyaan'],
                    'kunci_jawaban' => $params['kunci_jawaban'],
                    'updated_by' => $params['updated_by'],
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Buat Perangkat FR IA 06"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function storeIa07(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa03(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $ia07 = MstFrIa07::create([
                    'id_skema' => $params['id_skema'],
                    'id_unit_komp' => $params['id_unit_komp'],
                    'pertanyaan' => $params['pertanyaan'],
                    'kunci_jawaban' => $params['kunci_jawaban'],
                    'updated_by' => $params['updated_by'],
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Buat Perangkat FR IA 07"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function deleteIa02(Request $request)
    {
        try {
            $params = $request->all();
            $file = $params['file'];
            File::delete($file);
            MstFrIa02::where('id', $params['id'])->delete();
            return response()->json(['message' => "Success Delete IA 02"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    public function deleteIa03(Request $request)
    {
        try {
            $params = $request->all();
            MstFrIa03::where('id', $params['id'])->delete();
            return response()->json(['message' => "Success Delete IA 03"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    public function deleteIa05(Request $request)
    {
        try {
            $params = $request->all();
            MstFrIa05::where('id', $params['id_perangkat'])->delete();
            MstFrIa05Detail::where('id_mst_ia_05', $params['id_perangkat'])->delete();
            return response()->json(['message' => "Success Delete IA 05"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    public function deleteIa06(Request $request)
    {
        try {
            $params = $request->all();
            MstFrIa06::where('id', $params['id'])->delete();
            return response()->json(['message' => "Success Delete IA 06"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    public function deleteIa07(Request $request)
    {
        try {
            $params = $request->all();
            MstFrIa07::where('id', $params['id'])->delete();
            return response()->json(['message' => "Success Delete IA 07"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }
    }

    private function getValidationRulesIa02($isNew = true)
    {
        return [
            'filename' => 'required',
            'id_skema' => 'required',
            'file' => 'required',
        ];
    }

    private function getValidationRulesIa03($isNew = true)
    {
        return [
            'pertanyaan' => 'required',
            'id_skema' => 'required',
        ];
    }

    private function getValidationRulesIa05($isNew = true)
    {
        return [
            'id_mst_ia_05' => 'required',
            'jawaban' => 'required',
        ];
    }

}
