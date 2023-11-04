<?php

namespace App\Http\Resources;
use App\Laravue\Models\MstFrIa05Detail;

use Illuminate\Http\Resources\Json\JsonResource;

class MstIa02Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_mst_ia_02' => $this->id,
            'id_skema' => $this->id_skema,
            'versi' => $this->versi,
            'filename_soal' => $this->filename_soal,
            'file_soal' => $this->file_soal,
            'filename_jawaban' => $this->filename_jawaban,
            'file_jawaban' => $this->file_jawaban,
            'upload_by' => $this->upload_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
