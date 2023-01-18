<?php
/**
 * File MstFrIa05Detail.php
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
class MstFrIa05Detail extends Model
{
    public $guard_name = 'api';

    /**
     * To exclude permission management from the list
     *
     * @param $query
     * @return Builder
     */
    protected $table = "mst_perangkat_ia_05_a";
    protected $fillable = ['id_mst_ia_05', 'no_jawaban', 'jawaban', 'updated_by'];

    public function getList($id_mst_ia_05)
    {
        $mstIa05Detail = MstFrIa05Detail::where('id_mst_ia_05', $id_mst_ia_05)
        ->select('mst_perangkat_ia_05_a.*')
        ->get();
        
        $plunckData = array();
        foreach($mstIa05Detail as $row):
            $data['id'] = $row->id;
            $data['no_jawaban'] = $row->no_jawaban;
            $data['jawaban'] = $row->jawaban;
            $data['updated_by'] = $row->updated_by;
            $data['created_at'] = $row->created_at;
            $data['updated_at'] = $row->updated_at;
            $plunckData[] = $data;
		endforeach;
		return $plunckData;
    }
}
