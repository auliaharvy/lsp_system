<?php

namespace App\Http\Resources;
use App\Laravue\Models\JadwalAsesor;

use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $asesor = New JadwalAsesor();
        $dataAsesor = $asesor->getAsesor($this->id);

        return [
            'id' => $this->id,
            'id_perangkat' => $this->id_perangkat,
            'id_skema' => $this->id_skema,
            'id_tuk' => $this->id_tuk,
            'id_asesor' => $this->id_asesor,
            'jadwal' => $this->jadwal,
            'nama_asesor' => $this->nama_asesor,
            'nama_perangkat' => $this->nama_perangkat,
            'nama_skema' => $this->nama_skema,
            'nama_tuk' => $this->nama_tuk,
            'persyaratan' => $this->persyaratan,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'password_asesi' => $this->password_asesi,
        ];
    }
}
