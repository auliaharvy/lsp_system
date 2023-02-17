<?php
/**
 * File UjiKompVaAspek.php
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
class UjiKompVaAspek extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_va_aspek_aspek";
    protected $fillable = ['id_uji_komp', 'id_trx_va', 'item', 'aturan_v', 'aturan_a', 'aturan_t', 'aturan_m', 'prinsip_v', 'prinsip_r', 'prinsip_f', 'prinsip_f_2'];
}
