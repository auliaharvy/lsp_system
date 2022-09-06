<?php
/**
 * File Skema.php
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
 * Class Skema Elemen
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
    protected $fillable = ['id_unit_kompetensi','kuk', 'pertanyaan_kuk', 'jumlah_bukti', 'jenis_bukti_id', 'bukti'];

    public function getSkemaElemenUnit($unit_id)
    {
        $skemaUnit = SkemaElemenUnit::where('id_unit_kompetensi', $unit_id)
        ->select('mst_skema_sertifikasi_elemen_kompetensi.*')
        ->get();
        $plunckData = array();
        foreach($skemaUnit as $row):
            $data['kuk'] = $row->kuk;
            $data['pertanyaan_kuk'] = $row->pertanyaan_kuk;
            $data['jumlah_bukti'] = $row->jumlah_bukti;
            $data['jenis_bukti_id'] = $row->jenis_bukti_id;
            $data['nama_jenis_bukti'] = $row->jenis_bukti_id;
            $data['bukti'] = $row->pertanyaan_kuk;
            $plunckData[] = $data;
		endforeach;
		return $plunckData;
    }
}
