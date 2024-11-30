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
    public function index(Request $request)
    {
        $versi = $request->query('versi', 1); 
    
        $query = MstFrMapa02::query()->where('versi', '=', $versi);
    
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

    public function destroy(Request $request)
    {   
        $params = $request->all();
        try {
            MstFrMapa02::where('id',$params['id'])->delete();
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
