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
use App\Laravue\Models\UjiKompApl2Detail;
use App\Laravue\Models\UjiKompIa01Detail;

/**
 * Class Skema Elemen
 *
 * @package App\Laravue\Models
 */
class SkemaKukElemen extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "mst_skema_sertifikasi_kuk_elemen";
    protected $fillable = ['id_elemen','kuk', 'pertanyaan_kuk', 'jumlah_bukti', 'jenis_bukti_id', 'bukti'];

    public static function getSkemaKukElemen($unit_id, $id_apl_02 = null, $id_ia_01 = null)
    {
        $skemaUnit = SkemaKukElemen::where('id_elemen', $unit_id)
        ->select('mst_skema_sertifikasi_kuk_elemen.*', 'a.nama as nama_jenis_bukti')
        ->join('mst_jenis_bukti as a', 'a.id', '=', 'mst_skema_sertifikasi_kuk_elemen.jenis_bukti_id')
        ->get();
        $plunckData = array();
        foreach($skemaUnit as $row):
            $data['id'] = $row->id;
            $data['kuk'] = $row->kuk;
            $data['pertanyaan_kuk'] = $row->pertanyaan_kuk;
            $data['jumlah_bukti'] = $row->jumlah_bukti;
            $data['jenis_bukti_id'] = $row->jenis_bukti_id;
            $data['nama_jenis_bukti'] = $row->nama_jenis_bukti;
            $data['bukti'] = $row->bukti;
            if($id_apl_02 !== null){
                $data['is_kompeten_from_apl_02_detail'] = UjiKompApl2Detail::getIsKompeten($row->id, $id_apl_02);
            }
            if($id_ia_01 !== null){
                $data['is_kompeten_from_ia_01_detail'] = UjiKompIa01Detail::getIsKompeten($row->id, $id_ia_01);
                $data['penilaian_lanjut_from_ia_01_detail'] = UjiKompIa01Detail::getPenilaianLanjut($row->id, $id_ia_01);
            }
            $plunckData[] = $data;
		endforeach;
		return $plunckData;
    }
}
