<?php

namespace App\Http\Resources;
use App\Laravue\Models\JadwalAsesor;

use Illuminate\Http\Resources\Json\JsonResource;

class UjiKompResource extends JsonResource
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
            'id' => $this->id,
            'id_ak_01' => $this->id_ak_01,
            'id_ak_02' => $this->id_ak_02,
            'id_ak_03' => $this->id_ak_03,
            'id_ak_04' => $this->id_ak_04,
            'id_ak_05' => $this->id_ak_05,
            'id_ak_06' => $this->id_ak_06,
            'id_ak_07' => $this->id_ak_07,
            'id_apl_01' => $this->id_apl_01,
            'id_apl_02' => $this->id_apl_02,
            'id_asesi' => $this->id_asesi,
            'id_ia_01' => $this->id_ia_01,
            'id_ia_02' => $this->id_ia_02,
            'id_ia_03' => $this->id_ia_03,
            'id_ia_05' => $this->id_ia_05,
            'id_ia_06' => $this->id_ia_06,
            'id_ia_07' => $this->id_ia_07,
            'id_ia_11' => $this->id_ia_11,
            'id_mapa_01' => $this->id_mapa_01,
            'id_mapa_02' => $this->id_mapa_02,
            'id_skema' => $this->id_skema,
            'id_va' => $this->id_va,
            'jadwal' => $this->jadwal,
            'password_asesi' => $this->password_asesi,
            'asesor' => $this->nama_asesor,
            'email_asesor' => $this->email_asesor,
            'kode_skema' => $this->kode_skema,
            'skema_sertifikasi' => $this->skema_sertifikasi,
            'mulai' => $this->mulai,
            'nama_peserta' => $this->nama_peserta,
            'email_peserta' => $this->email_peserta,
            'nama_sekolah' => $this->nama_sekolah,
            'nama_tuk' => $this->nama_tuk,
            'nik' => $this->nik,
            'persentase' => $this->persentase,
            'selesai' => $this->selesai,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
