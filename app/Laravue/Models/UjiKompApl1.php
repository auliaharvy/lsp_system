<?php
/**
 * File UjiKompApl1.php
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
class UjiKompApl1 extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp_apl_01";
    protected $fillable = ['id_skema','id_tuk', 'nik', 'nama_lengkap', 'nama_sekolah', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
                            'alamat', 'kode_pos', 'no_hp', 'email', 'tingkatan', 'foto', 'identitas', 'raport', 'sertifikat', 'status'];
}
