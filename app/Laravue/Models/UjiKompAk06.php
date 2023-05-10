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
    protected $fillable = ['rencana_asesmen','persiapan_asesmen','implementasi_asesmen','keputusan_asesmen','umpan_balik_asesmen','rekomendasi_prosedur','task_skill','task_management_skill','contingency_management_skill','job_role','transfer_skill','rekomendasi_konsistensi','ttd_asesor','submit_by','komentar'];
}
