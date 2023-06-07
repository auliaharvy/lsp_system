<?php
/**
 * File UjiKompApl2Detail.php
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
class UjiKompApl2Detail extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_apl_02_detail";
    protected $fillable = ['id_uji_komp' ,'id_apl_02', 'id_kuk_elemen', 'is_kompeten', 'bukti_pendukung_id'];

    public static function getIsKompeten($id_kuk_elemen, $id_apl_02)
    {
        $isKompeten = UjiKompApl2Detail::where('id_kuk_elemen', $id_kuk_elemen)
        ->where('id_apl_02',$id_apl_02)
        ->select('trx_uji_komp_apl_02_detail.is_kompeten')
        ->join('mst_skema_sertifikasi_kuk_elemen as a', 'trx_uji_komp_apl_02_detail.id_kuk_elemen', '=', 'a.id')
        ->first();
		return $isKompeten;
    }

}
