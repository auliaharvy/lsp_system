<?php
/**
 * File JadwalAsesor.php
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
class JadwalAsesor extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "rel_jadwal_has_asesor";
    protected $fillable = ['id_jadwal','id_asesor'];

    public function getAsesor($id_jadwal)
    {
        $asesor = JadwalAsesor::where('id_jadwal', $id_jadwal)
        ->join('mst_asesor as b', 'b.id', '=', 'rel_jadwal_has_asesor.id_asesor')
        ->join('users as c', 'c.email', '=', 'b.email')
        ->select('rel_jadwal_has_asesor.*', 'b.nama as nama_asesor', 'c.signature as ttd_asesor')
        ->get();
        
        $plunckData = array();
        foreach($asesor as $row):
            $data['nama_asesor'] = $row->nama_asesor;
            $data['ttd_asesor'] = $row->ttd_asesor;
            $plunckData[] = $data;
		endforeach;
		return $plunckData;
    }
}
