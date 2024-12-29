<?php
/**
 * File UjiKomp.php
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
// use App\Laravue\Models\UjiKomp;

/**
 * Class Skema
 *
 * @package App\Laravue\Models
 */
class UjiKomp extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "trx_uji_komp";
    protected $fillable = ['id', 'nama_peserta','id_asesi', 'id_apl_01', 'id_apl_02', 'id_mapa_01', 'id_skema', 'id_mapa_02', 'id_ak_01',
                            'id_ak_04', 'id_ia_01', 'id_ia_02', 'id_ia_03', 'id_ia_05', 'id_ia_06', 'id_ia_07', 'id_ia_11', 'id_ak_02', 
                            'id_ak_03', 'id_ak_05', 'id_ak_06', 'id_ak_07', 'id_va', 'status', 'persentase'];

    public function getUjiSkema($nik)
        {
            $uji = UjiKomp::leftJoin('mst_skema_sertifikasi', 'mst_skema_sertifikasi.id', '=', 'trx_uji_komp.id_skema')
                ->join('trx_uji_komp_apl_01', 'trx_uji_komp_apl_01.id', '=', 'trx_uji_komp.id_apl_01')
                ->select('mst_skema_sertifikasi.kode_skema', 'mst_skema_sertifikasi.skema_sertifikasi', 'trx_uji_komp.status' )
                ->where('trx_uji_komp_apl_01.nik', $nik)
                ->get();
                
                $plunckData = [];
                $uji = array();
                foreach($uji as $row):
                if ($row->status === 0) {
                    $status = 'Proses';
                } if ($row->status === 1) {
                    $status = 'Kompeten';
                } if ($row->status === 2) {
                    $status = 'Belum Kompeten';
                }
                $data['kode_skema'] = $row->kode_skema;
                $data['skema_sertifikasi'] = $row->skema_sertifikasi;
                $data['status'] = $row->skema_sertifikasi;
                $plunckData[] = $data;
                endforeach;
                return $plunckData;
        }
}
