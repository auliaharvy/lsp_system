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
        $idak02 = Arr::get($searchParams, 'idak02', '');
        $idak03 = Arr::get($searchParams, 'idak03', '');
        $idak04 = Arr::get($searchParams, 'idak04', '');
        $idak05 = Arr::get($searchParams, 'idak05', '');
        $idak06 = Arr::get($searchParams, 'idak06', '');
        $idia01 = Arr::get($searchParams, 'idia01', '');
        $idia02 = Arr::get($searchParams, 'idak02', '');
        $idia03 = Arr::get($searchParams, 'idia03', '');
        $idia05 = Arr::get($searchParams, 'idia05', '');
        $idia06 = Arr::get($searchParams, 'idia06', '');
        $idia07 = Arr::get($searchParams, 'idia07', '');
        $idia11 = Arr::get($searchParams, 'idia11', '');
        
        $valueapl01 = Arr::get($searchParams, 'valueapl01', '');
        $valueapl02 = Arr::get($searchParams, 'valueapl02', '');
        $valuemapa02 = Arr::get($searchParams, 'valuemapa02', '');
        $valueak01 = Arr::get($searchParams, 'valueak01', '');
        $valueak02 = Arr::get($searchParams, 'valueak02', '');
        $valueak03 = Arr::get($searchParams, 'valueak03', '');
        $valueak04 = Arr::get($searchParams, 'valueak04', '');
        $valueak05 = Arr::get($searchParams, 'valueak05', '');
        $valueak06 = Arr::get($searchParams, 'valueak06', '');
        $valueia01 = Arr::get($searchParams, 'valueia01', '');
        $valueia02 = Arr::get($searchParams, 'valueia02', '');
        $valueia03 = Arr::get($searchParams, 'valueia03', '');
        $valueia05 = Arr::get($searchParams, 'valueia05', '');
        $valueia06 = Arr::get($searchParams, 'valueia06', '');
        $valueia07 = Arr::get($searchParams, 'valueia07', '');
        $valueia11 = Arr::get($searchParams, 'valueia11', '');

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

        // if($valueapl01){
        //     $dataapl01 = $ujiKompController->showApl01($idapl01);
        //     $datamodule->push(['nama' => 'apl01', 'data' => $dataapl01]);
        // }

        // if ($valueapl02){
        //     $dataapl02 = $ujiKompController->showApl02($idapl02);
        //     $datamodule->push(['nama' => 'apl02', 'data' => $dataapl02]);
        // }

        // if ($valuemapa02){
        //     $datamapa02 = $ujiKompController->showMapa02($iduji);
        //     $datamodule->push(['nama' => 'mapa02', 'data' => $datamapa02]);
        // }

        // if ($valueak01){
        //     $dataak01 = $ujiKompController->showAk01($idak01);
        //     $datamodule->push(['nama' => 'ak01', 'data' => $dataak01]);
        // }

        if ($valueak02){
            $dataak02 = $ujiKompController->showAk02($idak02);
            $datamodule->push(['nama' => 'ak02', 'data' => $dataak02]);
        }

        if ($valueak03){
            $dataak03 = $ujiKompController->showAk03($idak03);
            $datamodule->push(['nama' => 'ak03', 'data' => $dataak03]);
        }
        
        // if ($valueapl02){
        //     // $dataapl02 = $ujiKompController->showApl02($idapl02);
        //     $dataapl02 = $ujiKompController->indexApl02(new Request(['idapl02' => $idapl02]));
        //     $collection = collect();
        //     $tempKodeUnit;
        //     $tempNamaElemen;
        //     $tempKuk;
        //     $tempPertanyaanKuk;

        //     for($a = 1; $a < 7; $a++){
        //         foreach($dataapl02 as $kodeUnit){
        //             if($collection->isEmpty() || $kodeUnit->kode_unit !== $collection->last()['kode_unit']){
        //                 $tempKodeUnit = $kodeUnit->kode_unit;
        //                 $collection->push(['kode_unit' => $tempKodeUnit]);
        //             }
        //         }
        //         foreach($dataapl02 as $namaElemen){
        //             if($collection->isEmpty() || $namaElemen->nama_elemen !== $collection->last()['nama_elemen']){
        //                 $tempNamaElemen = $namaElemen->nama_elemen;
        //                 $collection->push(['nama_elemen' => $tempNamaElemen]);
        //             }
        //         }
        //         foreach($dataapl02 as $kuk){
        //             if($collection->isEmpty() || $kuk->kuk!== $collection->last()['kuk']){
        //                 $tempKuk = $kuk->kuk;
        //                 $collection->push(['kuk' => $tempKuk]);
        //             }
        //         }
        //         foreach($dataapl02 as $pertanyaanKuk){
        //             if($collection->isEmpty() || $pertanyaanKuk->pertanyaan_kuk !== $collection->last()['pertanyaan_kuk']){
        //                 $collection->push(['pertanyaan_kuk' => $tempPertanyaanKuk]);
        //             }
        //         }

        //         // $collection->push(['kode_unit' => $tempKodeUnit, 'nama_elemen' => $tempNamaElemen, 'kuk' => $tempKuk, 'pertanyaan_kuk' => $tempPertanyaanKuk]);
        //     }
        //     $collection->push(['kode_unit' => $tempKodeUnit, 'nama_elemen' => $tempNamaElemen]);
        //     $datamodule->push(['nama' => 'apl02', 'data' => $collection]);
        // }

        // if ($valueak04) {
        //     $dataak04 = $ujiKompController->showAk04($idak04);
        //     $datamodule->push(['nama' => 'ak04', 'data' => $dataak04]);
        // }

        if ($valueak05) {
            $dataak05 = $ujiKompController->showAk05($idak05);
            $datamodule->push(['nama' => 'ak05', 'data' => $dataak05]);
        }

        if ($valueak06) {
            $dataak06 = $ujiKompController->indexAk06($idak06);
            $datamodule->push(['nama' => 'ak06', 'data' => $dataak06]);
        }

        // if ($valueia01){
        //     $dataia01 = $ujiKompController->showIa01($idia01);
        //     $datamodule->push(['nama' => 'ia01', 'data' => $dataia01]);
        // }

        // if ($valueia02){
        //     $dataia02 = $ujiKompController->showIa02($idia02);
        //     $datamodule->push(['nama' => 'ia02', 'data' => $dataia02]);
        // }

        if ($valueia03){
            $dataia03 = $ujiKompController->showIa03($idia03);
            $datamodule->push(['nama' => 'ia03', 'data' => $dataia03]);
        }

        if ($valueia05){
            $dataia05 = $ujiKompController->showIa03($idia05);
            $datamodule->push(['nama' => 'ia05', 'data' => $dataia05]);
        }

        if ($valueia06){
            $dataia06 = $ujiKompController->showIa06($idia06);
            $datamodule->push(['nama' => 'ia06', 'data' => $dataia06]);
        }

        if ($valueia07){
            $dataia07 = $ujiKompController->showIa06($idia07);
            $datamodule->push(['nama' => 'ia07', 'data' => $dataia07]);
        }

        if ($valueia11){
            $dataia11 = $ujiKompController->showIa11($idia11);
            $datamodule->push(['nama' => 'ia11', 'data' => $dataia11]);
        }

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
    

}
