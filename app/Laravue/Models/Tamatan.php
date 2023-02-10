<?php
/**
 * File Tamatan.php
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
 * Class Tuk
 *
 * @package App\Laravue\Models
 */
class Tamatan extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_tamatan";
    protected $fillable = ['id_user','keahlian', 'bulan', 'tahun', 'status', 'tempat', 'sebagai'];
}
