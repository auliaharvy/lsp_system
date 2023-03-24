<?php
/**
 * File UjiKompvA.php
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
class UjiKompvA extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_va";
    protected $fillable = ['tim_validasi_1', 'tim_validasi_2', 'tujuan_dan_fokus_validasi', 'konteks_validasi', 'pendekatan_validasi', 'asesor_1', 
    'asesor_2', 'asesor_3', 'hasil_konfirmasi_asesor_1', 'hasil_konfirmasi_asesor_2', 'hasil_konfirmasi_asesor_3', 'lead_asesor', 'hasil_konfirmasi_lead_asesor',
    'manager', 'hasil_konfirmasi_manager', 'tenaga_ahli', 'hasil_konfirmasi_tenaga_ahli', 'koordinator_pelatihan', 'hasil_konfirmasi_koordinator_pelatihan',
    'anggota_asosiasi', 'hasil_konfirmasi_anggota_asosiasi', 'acuan_pembanding', 'dokumen_terkait', 'keterampilan_komunikasi', 'periode'];
}
