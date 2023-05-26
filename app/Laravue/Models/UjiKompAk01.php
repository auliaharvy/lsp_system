<?php
/**
 * File UjiKompAk01.php
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
class UjiKompAk01 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ak_01";
    protected $fillable = ['nama_asesi', 'nama_asesor', 'verifikasi_portofolio', 'observasi_langsung', 'hasil_tes_tulis', 'hasil_tes_lisan', 
    'hasil_tes_wawancara', 'hari', 'tanggal', 'bulan', 'tahun', 'jam', 'tuk', 'pernyataan_asesor', 'tanda_tangan_asesor', 
    'pernyataan_asesi', 'tanda_tangan_asesi'];
}
