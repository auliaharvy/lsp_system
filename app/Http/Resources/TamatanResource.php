<?php

namespace App\Http\Resources;
use App\Laravue\Models\UjiKomp;

use Illuminate\Http\Resources\Json\JsonResource;

class TamatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $uji = New UjiKomp();
        $dataUji = $uji->getUjiSkema($this->nik);

        return [
            'id' => $this->id,
            'id_user' => $this->id_user,
            'keahlian' => $this->keahlian,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'status' => $this->status,
            'tempat' => $this->tempat,
            'sebagai' => $this->sebagai,
            'name' => $this->name,
            'email' => $this->email,
            'nama_lengkap' => $this->nama_lengkap,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nik' => $this->nik,
            'uji' => $dataUji,
        ];
    }
}
