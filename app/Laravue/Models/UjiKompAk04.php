<?php
/**
 * File UjiKompAk04.php
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
class UjiKompAk04 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ak_04";
    protected $fillable = ['nama_asesi', 'nama_asesor', 'tanggal_asesmen', 'penjelasan','diskusi', 'melibatkan', 'skema', 'no_skema', 'alasan_banding', 'ttd_asesi'];
}
