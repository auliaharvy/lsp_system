<?php
/**
 * File Tuk.php
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
class PemegangSertifikat extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "mst_pemegang_sertifikat";
    protected $fillable = [
        'nama', 'id_uji_komp', 'no_registrasi', 'skema_sertifikasi', 'no_sertifikat', 
        'masa_berlaku'
    ];
}
