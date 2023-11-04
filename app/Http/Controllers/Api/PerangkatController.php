<?php
/**
 * File PerangkatController.phpp
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;
use App\Http\Resources\MasterResource;
use App\Http\Resources\MstIa02Resource;
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
use App\Laravue\Models\MstFrIa02Detail;
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

    public function indexIa02Old(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa02::query();
        $query->where('mst_perangkat_ia_02.id_skema', $id_skema)
        ->select('mst_perangkat_ia_02.*');

        return MasterResource::collection($query->paginate(100));
    }
    public function indexIa02(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrIa02::query();
        $query->where('mst_perangkat_ia_02.id_skema', $id_skema)
        ->join('mst_perangkat_ia_02_detail as a', 'a.id_mst_ia_02', '=', 'mst_perangkat_ia_02.id')
        ->select('mst_perangkat_ia_02.*', 'a.versi', 'a.filename', 'a.soal', 'a.jawaban', 'a.updated_by', 'a.id as id_mst_ia_02_detail');
        return MasterResource::collection($query->paginate(100));
    }

    public function indexIa02Detail(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        $id_mst_ia_02 = Arr::get($searchParams, 'id_mst_ia_02', '');

        $query = MstFrIa02Detail::query();
        $query->where('mst_perangkat_ia_02_detail.id_mst_ia_02', $id_mst_ia_02)
        ->select('mst_perangkat_ia_02_detail.*')
        ->groupBy('mst_perangkat_ia_02_detail.id');
        return MasterResource::collection($query->paginate(100));
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

        return MasterResource::collection($query->paginate(100));
        // return $searchParams;
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
        // ->leftJoin('mst_perangkat_ia_05_a as b', 'b.id', '=', 'mst_perangkat_ia_05.kunci_jawaban')
        ->leftJoin('mst_perangkat_ia_05_a as b', 'b.id_mst_ia_05', '=', 'mst_perangkat_ia_05.id')
        ->select('mst_perangkat_ia_05.*', 'a.kode_unit', 'a.unit_kompetensi', 'b.no_jawaban as no_kunci_jawaban', 'b.jawaban as isi_kunci_jawaban')
        ->groupBy('mst_perangkat_ia_05.pertanyaan');

        return MstIa05Resource::collection($query->paginate(100));
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

        return MasterResource::collection($query->paginate(100));
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
        ->select('mst_perangkat_ia_07.*', 'a.kode_unit', 'a.unit_kompetensi');

        return MasterResource::collection($query->paginate(100));
    }

    public function indexIa11(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
     
        $query = MstFrIa11::query()
        ->select('mst_perangkat_ia_11.*');

        return MasterResource::collection($query->paginate(100));
    }

    public function indexAk03(Request $request)
    {
        $searchParams = $request->all();
        $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        $query = MstFrAk03::query()
        ->select('mst_perangkat_ak_03.*');

        return MasterResource::collection($query->paginate(100));
    }

    public function storeIa02Detail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationRulesIa02Detail(),
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $idskema = $params['id_skema'];

                // upload soal 
                $soal = $request->file('soal');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . '-' . $soal->getClientOriginalName();
                $soal->move('uploads/perangkat/file/', $nama_file);
                $soal = 'uploads/perangkat/file/'.$nama_file;

                // upload jawaban
                $jawaban = $request->file('jawaban');
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . '-' . $jawaban->getClientOriginalName();
                $jawaban->move('uploads/perangkat/file/', $nama_file);
                $jawaban = 'uploads/perangkat/file/'.$nama_file;

                // cek ada ga id_skema di mst_perangkat_ia_02
                $mstPerangkatIa02 = MstFrIa02::where('id_skema', $idskema)->first();

                if ($mstPerangkatIa02) {
                    // create mst soal ia 02 yang baru
                    $ia02Soal = MstFrIa02Detail::create([
                        'id_mst_ia_02' => $mstPerangkatIa02->id,
                        'filename' => $params['filename'],
                        'versi' => $params['versi'],
                        'soal' => $soal,
                        'jawaban' => $jawaban,
                        'updated_by' => $params['user_id'],
                    ]);
                    // nilai di kolom jumlah nya bertambah 1
                    $jumlahSoal = $mstPerangkatIa02->jumlah;
                    $mstPerangkatIa02->jumlah = $jumlahSoal + 1;
                    $mstPerangkatIa02->save();

                } else {
                    // create mst perangkat ia 02
                    $ia02 = MstFrIa02::create([
                        'id_skema' => $params['id_skema'],
                        'jumlah' => 1,
                        'upload_by' => $params['user_id'],
                    ]);

                    // create mst perangkat ia 02 soal yang baru
                    $ia02Soal = MstFrIa02Detail::create([
                        'id_mst_ia_02' => $ia02->id,
                        'filename' => $params['filename'],
                        'versi' => $params['versi'],
                        'soal' => $soal,
                        'jawaban' => $jawaban,
                        'updated_by' => $params['user_id'],
                    ]);
                }

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

    public function editIa02(Request $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->all();

            // ambil data ia 02 detail
            $ia02Detail = MstFrIa02Detail::where('id', $params['id'])->first();

            // ambil dan periksa, kalo update soal maka soalnya diupdate 
            $soal = $request->file('soal');
            if ($soal) {
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . '-' . $soal->getClientOriginalName();
                $soal->move('uploads/perangkat/file/', $nama_file);
                $soal = 'uploads/perangkat/file/'.$nama_file;
                $ia02Detail->soal = $soal;
            }

            // ambil dan periksa, kalo update jawaban maka jawabannya diupdate 
            $jawaban = $request->file('jawaban');
            if ($jawaban) {
                $mytime = Carbon::now();
                $now = $mytime->toDateString();
                $nama_file = $now . '-' . $jawaban->getClientOriginalName();
                $jawaban->move('uploads/perangkat/file/', $nama_file);
                $jawaban = 'uploads/perangkat/file/'.$nama_file;
                $ia02Detail->jawaban = $jawaban;
            }

            // kalo udah save, jangan lupa di isi updated_by nya
            $ia02Detail->updated_by = $params['updated_by'];
            $ia02Detail->save();

            DB::commit();
            return response()->json(['message' => "Sukses Update Perangkat FR IA 02"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
            //return $e->getMessage();
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

    public function deleteIa02Detail(Request $request)
    {
        $params = $request->all();
        $soal = $params['soal'];
        $jawaban = $params['jawaban'];
        File::delete($soal);
        File::delete($jawaban);

        $mstFrIa02Detail = MstFrIa02Detail::where('id', $params['id_mst_ia_02_detail'])->first();

        $mstFrIa02 = MstFrIa02::where('id', $mstFrIa02Detail->id_mst_ia_02)->first();

        $rowsDelete = MstFrIa02Detail::where('id', $params['id_mst_ia_02_detail'])->delete();
        if($rowsDelete > 0){
            $jumlah = $mstFrIa02->jumlah;
            if ($jumlah > 0){
                $mstFrIa02->jumlah = $jumlah - 1;
                $jumlah = $mstFrIa02->jumlah;
                if ($jumlah === 0){
                    MstFrIa02::where('id', $mstFrIa02->id)->delete();
                }
                $mstFrIa02->save();
            }
            return response()->json(['message' => "Success Delete Soal IA 02"], 201);
        } else {
            return response()->json(['error' => 'No records were deleted'], 403);
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

    private function getValidationRulesIa02Detail($isNew = true)
    {
        return [
            'filename' => 'required',
            'id_skema' => 'required',
            'soal' => 'required',
            'jawaban' => 'required',
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
