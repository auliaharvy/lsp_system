<?php
/**
 * File UjiKomp.php
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
class UjiKomp extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp";
    protected $fillable = ['nama_peserta','id_asesi', 'id_apl_01', 'id_apl_02', 'id_mapa_01', 'id_skema', 'id_mapa_02', 'id_ak_01',
                            'id_ak_04', 'id_ia_01', 'id_ia_02', 'id_ia_03', 'id_ia_05', 'id_ia_06', 'id_ia_07', 'id_ia_11', 'id_ak_02', 
                            'id_ak_03', 'id_ak_05', 'id_ak_06', 'id_va', 'status', 'persentase'];
}
