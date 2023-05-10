<?php
/**
 * File UjiKompMapa2.php
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

/**
 * Class Skema
 *
 * @package App\Laravue\Models
 */
class UjiKompMapa02 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_mapa_02";
    protected $fillable = ['id_uji_komp','id_mst_mapa_02','potensi_asesi_1','potensi_asesi_2','potensi_asesi_3','potensi_asesi_4','potensi_asesi_5','submit_by','updated_by'];
}
