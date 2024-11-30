<?php

namespace App\Http\Resources;

use App\Laravue\Models\MstFrMapa02;
use Illuminate\Http\Resources\Json\JsonResource;

class Mapa2Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $master = New MstFrMapa02();

        return [
            'id' => $this->id,
            'muk' => $this->muk,
            'versi' => $this->versi,
            'potensi_asesi_1'=> false,
            'potensi_asesi_2'=> false,
            'potensi_asesi_3'=> false,
            'potensi_asesi_4'=> false,
            'potensi_asesi_5'=> false,
        ];
    }
}
