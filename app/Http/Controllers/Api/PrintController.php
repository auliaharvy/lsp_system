<?php
/**
 * File UjiKompController.php
 *
 * @author Aulia Harvy (auliaharvy@gmail.com)
 * @package LSP_System
 * @version 1.0
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\MasterResource;
use App\Http\Resources\JadwalResource;
use App\Laravue\JsonResponse;
use App\Laravue\Models\Jadwal;
use App\Laravue\Models\UjiKomp;
use App\Laravue\Models\UjiKompApl1;
use App\Laravue\Models\UjiKompApl2;
use App\Laravue\Models\UjiKompApl2Detail;
use App\Laravue\Models\UjiKompAk01;
use App\Laravue\Models\UjiKompAk03;
use App\Laravue\Models\UjiKompAk03Detail;
use App\Laravue\Models\UjiKompAk02;
use App\Laravue\Models\UjiKompAk02Detail;
use App\Laravue\Models\UjiKompAk04;
use App\Laravue\Models\UjiKompAk05;
use App\Laravue\Models\UjiKompIa01;
use App\Laravue\Models\UjiKompIa01Detail;
use App\Laravue\Models\UjiKompIa02;
use App\Laravue\Models\UjiKompIa03;
use App\Laravue\Models\UjiKompIa03Detail;
use App\Laravue\Models\UjiKompIa05;
use App\Laravue\Models\UjiKompIa05Detail;
use App\Laravue\Models\UjiKompIa06;
use App\Laravue\Models\UjiKompIa06Detail;
use App\Laravue\Models\UjiKompIa11;
use App\Laravue\Models\UjiKompIa11Detail;
use App\Laravue\Models\JadwalAsesor;
use App\Laravue\Models\Tuk;
use App\Laravue\Models\Skema;
use App\Laravue\Models\Asesor;
use App\Laravue\Models\Perangkat;
use App\Laravue\Models\User;
use App\Laravue\Models\Permission;
use App\Laravue\Models\Role;
use App\Http\Controllers\Api\UjiKompController;
use App\Http\Controllers\Api\SkemaController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Validator;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class UjiKompController
 *
 * @package App\Http\Controllers\Api
 */
class PrintController extends BaseController
{
    const ITEM_PER_PAGE = 15;

    /**
     * Display a listing of the user resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|ResourceCollection
     */
    // public function index(Request $request)
    // {
    //     $searchParams = $request->all();
    //     // $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
    //     // $keyword = Arr::get($searchParams, 'keyword', '');
    //     // $visibility = Arr::get($searchParams, 'visibility', 0);
    //     // $user_id = Arr::get($searchParams, 'user_id', '');
    //     // $role = Arr::get($searchParams, 'role', '');
    //     // $foundUser = User::where('id',$user_id)->first();
    //     $idJadwal = Arr::get($searchParams, 'idJadwal', '');
        
    //     $query = Jadwal::where('trx_jadwal_asesmen.id',$idJadwal)
    //     ->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_jadwal_asesmen.id_skema')
    //     ->join('mst_tuk as c', 'c.id', '=', 'trx_jadwal_asesmen.id_tuk')
    //     ->join('mst_asesor as f', 'f.id', '=', 'trx_jadwal_asesmen.id_asesor')
    //     ->select('trx_jadwal_asesmen.*', 'b.skema_sertifikasi as nama_skema', 'c.nama as nama_tuk', 'f.nama as nama_asesor', 'f.no_reg')->first();

    //     $queryApl01 = UjiKompApl1::where('id_jadwal',$idJadwal)->get();
        
    //     // $query->first();
    //     // return response()->json(['jadwal' => $query, 'uji' => $queryApl01]);

    //     $pdf = PDF::loadview('print/surat-tugas',['jadwal' => $query, 'uji' => $queryApl01]);
    //     $pdf->setPaper('A4' , 'portrait');
	//     return $pdf->download('example.pdf');
    // }

    public function printMaster(Request $request){

        $searchParams = $request->all();

        $ujiKompController = App::make(UjiKompController::class);
        $skemaController = App::make(SkemaController::class);

        $iduji = Arr::get($searchParams, 'iduji', '');
        $asesor = Arr::get($searchParams, 'asesor', '');

        $dataUjiKomp = $ujiKompController->showPreview($iduji);
        $dataSkemaSertifikasi = $ujiKompController->index(new Request(['idujikomp' => $dataUjiKomp->id]));
        $dataSkemaUnit = $skemaController->indexUnit(new Request(['id_skema' => $dataUjiKomp->id_skema]));

        $idapl01 = Arr::get($searchParams, 'idapl01', '');
        $idapl02 = Arr::get($searchParams, 'idapl02', '');
        $idmapa02 = Arr::get($searchParams, 'idmapa02', '');
        $idak01 = Arr::get($searchParams, 'idak01', '');
        $idak04 = Arr::get($searchParams, 'idak04', '');
        // $idia01 = Arr::get($searchParams, 'idak01', '');
        // $idia02 = Arr::get($searchParams, 'idak02', '');
        $idia03 = Arr::get($searchParams, 'idia03', '');
        $idia05 = Arr::get($searchParams, 'idia05', '');
        $idia06 = Arr::get($searchParams, 'idia06', '');
        $idia01 = Arr::get($searchParams, 'idak01', '');
        $idia02 = Arr::get($searchParams, 'idia02', '');

        $valueapl01 = Arr::get($searchParams, 'valueapl01', '');
        $valueapl02 = Arr::get($searchParams, 'valueapl02', '');
        $valuemapa02 = Arr::get($searchParams, 'valuemapa02', '');
        $valueak01 = Arr::get($searchParams, 'valueak01', '');
        $valueak04 = Arr::get($searchParams, 'valueak04', '');
        // $valueia01 = Arr::get($searchParams, 'valueia01', '');
        // $valueia02 = Arr::get($searchParams, 'valueia02', '');
        $valueia03 = Arr::get($searchParams, 'valueia03', '');
        $valueia05 = Arr::get($searchParams, 'valueia05', '');
        $valueia06 = Arr::get($searchParams, 'valueia06', '');

        $dataapl01 = '';
        // $dataapl02 = null;
        // $datamapa02 = null;
        // $dataak01 = null;
        $dataak04 = '';
        // $dataia01 = null;
        // $dataia02 = null;

        $datamodule = collect([]);

        if ($valueapl01) {
        $valueia01 = Arr::get($searchParams, 'valueia01', '');
        $valueia02 = Arr::get($searchParams, 'valueia02', '');

        $datamodule = collect([]);

        if($valueapl01){
            $dataapl01 = $ujiKompController->showApl01($idapl01);
            $datamodule->push(['nama' => 'apl01', 'data' => $dataapl01]);
        }

        if ($valueapl02){
            $dataapl02 = $ujiKompController->showApl02($idapl02);
            $datamodule->push(['nama' => 'apl02', 'data' => $dataapl02]);
        }

        if ($valuemapa02){
            $datamapa02 = $ujiKompController->showMapa02($iduji);
            $datamodule->push(['nama' => 'mapa02', 'data' => $datamapa02]);
        }

        if ($valueak01){
            $dataak01 = $ujiKompController->showAk01($idak01);
            $datamodule->push(['nama' => 'ak01', 'data' => $dataak01]);
        }

        // if ($valueak04) {
        //     $dataak04 = $ujiKompController->showAk04($idak04);
        //     $datamodule->push(['nama' => 'ak04', 'data' => $dataak04]);
        // }

        if ($valueia01){
            $dataia01 = $ujiKompController->showIa01($idia01);
            $datamodule->push(['nama' => 'ia01', 'data' => $dataia01]);
        }

        if ($valueia02){
            $dataia02 = $ujiKompController->showIa02($idia02);
            $datamodule->push(['nama' => 'ia02', 'data' => $dataia02]);
        }

        // if ($valueia03){
        //     $dataia03 = $ujiKompController->showIa03($idia03);
        //     $datamodule->push(['nama' => 'ia03', 'data' => $dataia03]);
        // }
        // if ($valueia05){
        //     $dataia03 = $ujiKompController->showIa03($idia03);
        //     $datamodule->push(['nama' => 'ia03', 'data' => $dataia03]);
        // }

        if ($valueia06){
            $dataia06 = $ujiKompController->showIa06($idia06);
            $datamodule->push(['nama' => 'ia06', 'data' => $dataia06]);
        }

        // $queryia03 = UjiKompIa03::where('trx_uji_komp_ia_03.id',$searchParams['id_ia_03'])
        // ->join('trx_jadwal_asesmen as b', 'b.id', '=', 'trx_uji_komp_ia_03.id_jadwal')
        // ->join('mst_skema_sertifikasi as c', 'c.id', '=', 'b.id_skema');

        // return ['datamodule' => $datamodule, 'iduji' => $iduji];
        // return view('print.masterprint', ['valueak04' => $valueak04, 'valueapl01' => $valueapl01]);

        $pdf = PDF::loadview('print.masterprint', [
            'datamodule' => $datamodule, 
            'skemaunit' => $dataSkemaUnit, 
            'skemasertifikasi' => $dataSkemaSertifikasi[0], 
            'asesor' => $asesor,
        ]);
        $pdf->setPaper('A4','portrait');
        return $pdf->download('module.pdf');
        // return $pdf->stream();   
    }
}
    
    public function print($array){

        // $searchParams = $request->all();
        // $queryia03 = UjiKompIa03::where('trx_uji_komp_ia_03.id',$searchParams['id_ia_03'])
        // ->join('trx_jadwal_asesmen as b', 'b.id', '=', 'trx_uji_komp_ia_03.id_jadwal')
        // ->join('mst_skema_sertifikasi as c', 'c.id', '=', 'b.id_skema');

        $apl01 = App::make(UjiKompController::class);
        $dataApl01 = $apl01->showApl01($array[0].idujikom);

        $pdf = PDF::loadview('print.masterprint', [ 'dataApl01' => $array[0].idujikom ]);
        $pdf->setPaper('A4','portrait');
        return $pdf->download('module.pdf');


        $pdf = PDF::loadview('print.masterprint');
        $pdf->setPaper('A4','portrait');
        return $pdf->download('module.pdf');
        // return $pdf->stream();   
    }


}
