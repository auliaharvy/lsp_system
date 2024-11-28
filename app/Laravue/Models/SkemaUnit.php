<?php
/**
 * File Skema.phpp
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
class SkemaUnit extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "mst_skema_sertifikasi_unit_kompetensi";
    protected $fillable = ['id_skema','kode_unit', 'unit_kompetensi'];

    public function getSkemaUnit($skema_id)
    {
        $skemaUnit = SkemaUnit::where('id_skema', $skema_id)
        ->select('mst_skema_sertifikasi_unit_kompetensi.*')
        ->get();
        
        $plunckData = array();
        foreach($skemaUnit as $row):
            $data['id'] = $row->id;
            $data['elemen'] = SkemaElemenUnit::getSkemaElemen($row->id, null, null);
            $data['kode_unit'] = $row->kode_unit;
            $data['unit_kompetensi'] = $row->unit_kompetensi;
            $data['kelompok_pekerjaan'] = $row->kelompok_pekerjaan;
            $plunckData[] = $data;
		endforeach;
		return $plunckData;
    }
}
