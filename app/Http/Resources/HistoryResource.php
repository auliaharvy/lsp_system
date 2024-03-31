<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'id_uji_komp' => $this->id_uji_komp,
            'nama_peserta' => $this->nama_peserta,
            'jadwal' => $this->jadwal,
            'skema_sertifikasi' => $this->skema_sertifikasi,
            'kode_skema' => $this->kode_skema,
            'asesor' => $this->asesor,
            'mulai' => $this->mulai,
            'status' => $this->status,
            'id_skema' => $this->id_skema,
            'id_jadwal' => $this->id_jadwal
        ];
    }
}
