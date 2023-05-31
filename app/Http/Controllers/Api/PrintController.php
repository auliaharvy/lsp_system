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
    public function index(Request $request)
    {
        $searchParams = $request->all();
        // $limit = Arr::get($searchParams, 'limit', static::ITEM_PER_PAGE);
        // $keyword = Arr::get($searchParams, 'keyword', '');
        // $visibility = Arr::get($searchParams, 'visibility', 0);
        // $user_id = Arr::get($searchParams, 'user_id', '');
        // $role = Arr::get($searchParams, 'role', '');
        // $foundUser = User::where('id',$user_id)->first();
        $idJadwal = Arr::get($searchParams, 'idJadwal', '');
        
        $query = Jadwal::where('trx_jadwal_asesmen.id',$idJadwal)
        ->join('mst_skema_sertifikasi as b', 'b.id', '=', 'trx_jadwal_asesmen.id_skema')
        ->join('mst_tuk as c', 'c.id', '=', 'trx_jadwal_asesmen.id_tuk')
        ->join('mst_asesor as f', 'f.id', '=', 'trx_jadwal_asesmen.id_asesor')
        ->select('trx_jadwal_asesmen.*', 'b.skema_sertifikasi as nama_skema', 'c.nama as nama_tuk', 'f.nama as nama_asesor', 'f.no_reg')->first();

        $queryApl01 = UjiKompApl1::where('id_jadwal',$idJadwal)->get();
        
        // $query->first();
        // return response()->json(['jadwal' => $query, 'uji' => $queryApl01]);

        $pdf = PDF::loadview('print/surat-tugas',['jadwal' => $query, 'uji' => $queryApl01]);
        $pdf->setPaper('A4' , 'portrait');
	    return $pdf->download('example.pdf');
    }

    public function printMaster(Request $request){

        // $searchParams = $request->all();
        // $queryia03 = UjiKompIa03::where('trx_uji_komp_ia_03.id',$searchParams['id_ia_03'])
        // ->join('trx_jadwal_asesmen as b', 'b.id', '=', 'trx_uji_komp_ia_03.id_jadwal')
        // ->join('mst_skema_sertifikasi as c', 'c.id', '=', 'b.id_skema');

        $pdf = PDF::loadView('print.masterprint');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream();   
    }

}
