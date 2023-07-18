<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Ak06Resource extends JsonResource
{
    /**
     * Transform the resource into an arrayy
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {   
        if($this->bulan == 'Januari'){
            $this->bulan = '01';
        }elseif($this->bulan == 'Februari'){
            $this->bulan = '02';
        }elseif($this->bulan == 'Maret'){
            $this->bulan = '03';
        }elseif($this->bulan == 'April'){
            $this->bulan = '04';
        }elseif($this->bulan == 'Mei'){
            $this->bulan = '05';
        }elseif($this->bulan == 'Juni'){
            $this->bulan = '06';
        }elseif($this->bulan == 'Juli'){
            $this->bulan = '07';
        }elseif($this->bulan == 'Agustus'){
            $this->bulan = '08';
        }elseif($this->bulan == 'September'){
            $this->bulan = '09';
        }elseif($this->bulan == 'Oktober'){
            $this->bulan = '10';
        }elseif($this->bulan == 'November'){
            $this->bulan = '11';
        }elseif($this->bulan == 'Desember'){
            $this->bulan = '12';
        }
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
                'nama'=> $this->nama_asesor,
                // 'tanggal'=> $this->tahun . '-' . $this->bulan . '-' . $this->tanggal,
                'waktu'=> $this->created_at,
                'komentar'=> $this->komentar,
            ],
        ];
    }
}
