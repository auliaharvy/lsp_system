<?php
/**
 * File SkemaElemen.php
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
use App\Laravue\Models\SkemaKukElemen;

/**
 * Class SkemaElemen
 *
 * @package App\Laravue\Models
 */
class SkemaElemenUnit extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "mst_skema_sertifikasi_elemen_kompetensi";
    protected $fillable = ['id_unit','nama_elemen'];

    public static function getSkemaElemen($unit_id, $id_apl_02 = null, $id_ia_01 = null)
    {
        $skemaElemenUnit = SkemaElemenUnit::where('id_unit', $unit_id)
        ->select('mst_skema_sertifikasi_elemen_kompetensi.*')
        ->get();
        
        $plunckData = array();
        foreach($skemaElemenUnit as $row):
            $data['kuk'] = SkemaKukElemen::getSkemaKukElemen($row->id, $id_apl_02, $id_ia_01);
            $data['id_elemen'] = $row->id;
            $data['nama_elemen'] = $row->nama_elemen;
            $data['benchmark'] = $row->benchmark;
            $plunckData[] = $data;
		endforeach;
		return $plunckData;
    }
}