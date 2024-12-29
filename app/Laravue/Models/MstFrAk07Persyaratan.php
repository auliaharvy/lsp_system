<?php
/**
 * File MstFrAk07Persyaratan.php
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
class MstFrAk07Persyaratan extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "mst_perangkat_ak_07_persyaratan";
    protected $fillable = ['id', 'komponen', 'created_at', 'updated_at'];
}
