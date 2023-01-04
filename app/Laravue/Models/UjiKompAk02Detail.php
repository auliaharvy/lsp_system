<?php
/**
 * File UjiKompAk02Detail.php
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
class UjiKompAk02Detail extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ak_02_detail";
    protected $fillable = ['id_uji_komp', 'id_ak_02', 'observasi_demonstrasi', 'portofolio', 'pernyataan_pihak_3', 'pernyataan_lisan', 'pernyataan_tertulis', 'proyek_kerja', 'lainnya', 'id_unit'];
}
