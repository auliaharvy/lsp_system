<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Ak06Resource extends JsonResource
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
            'aspek' => [
                [
                'item' => 'Prosedur asesmen :',
                'validitas'=> '',
                'reliabel'=> '',
                'fleksibel'=> '',
                'adil'=> '',
                ],
                [
                'item' => '- Rencana Asesmen',
                'validitas'=> $this->rencana_asesmen_validitas,
                'reliabel'=> $this->rencana_asesmen_reliabel,
                'fleksibel'=> $this->rencana_asesmen_fleksibel,
                'adil'=> $this->rencana_asesmen_adil,
                ],
                [
                'item' => '- Persiapan Asesmen',
                'validitas'=> $this->persiapan_asesmen_validitas,
                'reliabel'=> $this->persiapan_asesmen_reliabel,
                'fleksibel'=> $this->persiapan_asesmen_fleksibel,
                'adil'=> $this->persiapan_asesmen_adil,
                ],
                [
                'item' => '- Implementasi Asesmen',
                'validitas'=> $this->implementasi_asesmen_validitas,
                'reliabel'=> $this->implementasi_asesmen_reliabel,
                'fleksibel'=> $this->implementasi_asesmen_fleksibel,
                'adil'=> $this->implementasi_asesmen_adil,
                ],
                [
                'item' => '- Keputusan Asesmen',
                'validitas'=> $this->keputusan_asesmen_validitas,
                'reliabel'=> $this->keputusan_asesmen_reliabel,
                'fleksibel'=> $this->keputusan_asesmen_fleksibel,
                'adil'=> $this->keputusan_asesmen_adil,
                ],
                [
                'item' => '- Umpan Balik Asesmen',
                'validitas'=> $this->umpan_balik_asesmen_validitas,
                'reliabel'=> $this->umpan_balik_asesmen_reliabel,
                'fleksibel'=> $this->umpan_balik_asesmen_fleksibel,
                'adil'=> $this->umpan_balik_asesmen_adil,
                ]
            ],
            'aspekPemenuhan' => [
                'item' => 'Konsistensi keputusan asesmen Bukti dari berbagai asesmen diperiksa untuk konsistensi dimensi kompetensi',
                'taskSkill'=> $this->task_skill,
                'taskManagementSkill'=> $this->task_management_skill,
                'contigency'=> $this->contigency_management_skill,
                'jobRole'=> $this->job_role,
                'transferSkill'=> $this->transfer_skill, 
            ],
            'rekomendasi'=> [
                'item' => 'Rekomendasi untuk peningkatan',
                'rekomendasi'=> $this->rekomendasi_prosedur,
            ],
            'rekomendasiPemenuhan' => [
                'item' => 'Rekomendasi untuk peningkatan',
                'rekomendasi'=> $this->rekomendasi_konsistensi,
            ],'ttdTable'=> [
                'ttd'=> $this->ttd_asesor,
                'komentar'=> $this->komentar,
            ],


        ];
                
                
    }
}
