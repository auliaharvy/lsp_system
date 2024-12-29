<?php
/**
 * File TrxAk07Persyaratan.php
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
class TrxAk07Persyaratan extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_ak_07_persyaratan";
    protected $fillable = ['id', 'id_mst_perangkat_ak_07_persyaratan_detail', 'id_trx_uji_komp_ak_07', 'keterangan', 'created_at', 'updated_at'];
}
