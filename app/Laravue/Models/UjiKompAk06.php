<?php
/**
 * File UjiKompAk06.php
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
class UjiKompAk06 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_ak_06";
    protected $fillable = [
    'rencana_asesmen_validitas',
    'persiapan_asesmen_validitas',
    'implementasi_asesmen_validitas',
    'keputusan_asesmen_validitas',
    'umpan_balik_asesmen_validitas',
    'rencana_asesmen_reliabel',
    'persiapan_asesmen_reliabel',
    'implementasi_asesmen_reliabel',
    'keputusan_asesmen_reliabel',
    'umpan_balik_asesmen_reliabel',
    'rencana_asesmen_fleksibel',
    'persiapan_asesmen_fleksibel',
    'implementasi_asesmen_fleksibel',
    'keputusan_asesmen_fleksibel',
    'umpan_balik_asesmen_fleksibel',
    'rencana_asesmen_adil',
    'persiapan_asesmen_adil',
    'implementasi_asesmen_adil',
    'keputusan_asesmen_adil',
    'umpan_balik_asesmen_adil',
    'rekomendasi_prosedur',
    'task_skill',
    'task_management_skill',
    'contigency_management_skill',
    'job_role',
    'transfer_skill',
    'rekomendasi_konsistensi',
    'ttd_asesor',
    'submit_by',
    'komentar'
];
}
