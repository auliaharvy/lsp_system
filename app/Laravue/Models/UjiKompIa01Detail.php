<?php
/**
 * File UjiKompIa01Detail.php
 *
 * @author Aulia Harvy <auliaharvy@gmail.com>
 * @package LSP_System
 * @version 1.0
 */

namespace App\Laravue\Models;
use App\Laravue\Acl;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Laravue\Models\SkemaElemenUnit;

/**
 * Class Skema
 *
 * @package App\Laravue\Models
 */
class UjiKompIa01Detail extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ia_01_detail";
    protected $fillable = ['id_uji_komp','id_ia_01', 'id_kuk_elemen', 'is_kompeten', 'penilaian_lanjut','updated_by'];

    public static function getIsKompeten($id_kuk_elemen, $id_ia_01)
    {
        $isKompeten = UjiKompIa01Detail::where('id_kuk_elemen', $id_kuk_elemen)
        ->where('id_ia_01',$id_ia_01)
        ->select('trx_uji_komp_ia_01_detail.is_kompeten')
        ->join('mst_skema_sertifikasi_kuk_elemen as a', 'trx_uji_komp_ia_01_detail.id_kuk_elemen', '=', 'a.id')
        ->first();
		return $isKompeten;
    }

    public static function getPenilaianLanjut($id_kuk_elemen, $id_ia_01)
    {
        $penilaian_lanjut = UjiKompIa01Detail::where('id_kuk_elemen', $id_kuk_elemen)
        ->where('id_ia_01',$id_ia_01)
        ->select('trx_uji_komp_ia_01_detail.penilaian_lanjut')
        ->join('mst_skema_sertifikasi_kuk_elemen as a', 'trx_uji_komp_ia_01_detail.id_kuk_elemen', '=', 'a.id')
        ->first();
		return $penilaian_lanjut;
    }

}
