<?php
/**
 * File UjiKompIa05.php
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
class UjiKompIa05 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ia_05";
    protected $fillable = ['rekomendasi_asesor','umpan_balik', 'submit_by', 'updated_by'];
}
