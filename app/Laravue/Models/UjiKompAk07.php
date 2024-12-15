<?php
/**
 * File UjiKompAk07.php
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
class UjiKompAk07 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ak_07";
    protected $fillable = [
      'id',
      'id_uji_komp',
      'id_trx_ak_07_persyaratan',
      'id_trx_ak_07_potensi_asesi',
      'id_asesor',
      'acuan_pembanding',
      'metode_asesmen',
      'instrument_asesmen',
      'created_at',
      'updated_at'
    ];
}
