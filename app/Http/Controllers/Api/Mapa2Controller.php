<?php
/**
 * File Mapa2Controller.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\Mapa2Resource;
use App\Laravue\Models\MstFrMapa02;

use Illuminate\Http\Request;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\DB;
use Validator;


/**
 * Class PerangkatController
 *
 * @package App\Http\Controllers\Api
 */
class Mapa2Controller extends BaseController
{
    const ITEM_PER_PAGE = 15;

    // public function indexIa03(Request $request)
    public function index()
    {
        // $searchParams = $request->all();
        // $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // // $keyword = Arr::get($searchParams, 'keyword', '');
        // // $jadwal = Arr::get($searchParams, 'di_jadwal', '');
        // $id_skema = Arr::get($searchParams, 'id_skema', '');

        $query = MstFrMapa02::query();
        // $query->where('mst_perangkat_ia_03.id_skema', $id_skema)
        // ->select('mst_perangkat_ia_03.*');

        return Mapa2Resource::collection($query->paginate(100));


    }



   

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->getValidationMapa02()
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        } else {
            DB::beginTransaction();
            try {
                $params = $request->all();
                $mapa02 = MstFrMapa02::create([
                    'muk' => $params['muk'],
                ]);

                DB::commit();
                return response()->json(['message' => "Sukses Buat MUK MAPA 02"], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()], 400);
                //return $e->getMessage();
            }
        }
    }

    public function destroy($id)
    {
        try {
            MstFrMapa02::where('id',$id)->delete();
            return response()->json(['message' => "Success Delete MUK MAPA 02"], 201);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 403);
        }
    }

 


    private function getValidationMapa02($isNew = true)
    {
        return [
            'muk' => 'required',
        ];
    }


}
