<?php

namespace App\Http\Resources;
use App\Laravue\Models\MstFrIa05Detail;

use Illuminate\Http\Resources\Json\JsonResource;

class MstIa05Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $jawaban = New MstFrIa05Detail();
        $dataJawaban = $jawaban->getList($this->id);

        return [
            'id_perangkat' => $this->id,
            'id_skema' => $this->id_skema,
            'kode_unit' => $this->kode_unit,
            'unit_kompetensi' => $this->unit_kompetensi,
            'pertanyaan' => $this->pertanyaan,
            'kunci_jawaban' => $this->kunci_jawaban,
            'no_kunci_jawaban' => $this->no_kunci_jawaban,
            'isi_kunci_jawaban' => $this->isi_kunci_jawaban,
            'list_jawaban' => $dataJawaban,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
