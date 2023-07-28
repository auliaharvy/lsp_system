<?php

namespace App\Http\Resources;
use App\Laravue\Models\SkemaUnit;

use Illuminate\Http\Resources\Json\JsonResource;

class SkemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $unit = New SkemaUnit();
        $dataUnit = $unit->getSkemaUnit($this->id);

        return [
            'id' => $this->id,
            'kode_skema' => $this->kode_skema,
            'skema_sertifikasi' => $this->skema_sertifikasi,
            'nama_kategori' => $this->nama_kategori,
            'jumlah_unit_count' => $this->jumlah_unit_count,
            'jumlah_sertifikasi' => $this->jumlah_sertifikasi,
            'kblui' => $this->kblui,
            'kbji' => $this->kbji,
            'jenjang' => $this->jenjang,
            'kode_sektor' => $this->kode_sektor,
            'visibilitas' => $this->visibilitas,
            'children' =>  $dataUnit,
        ];
    }
}
