<?php

namespace App\Http\Controllers\Api;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller as BaseController;

class SendEmailController extends BaseController
{
    public function index(Request $request){
        $params = $request->all();
        $data_email = [
            'subject' => 'Selamat ' . $params['nama_asesi'] . ', uji LSP kamu sudah di nilai',
            'sender_name' => 'lsp2cb@gmail.com',
            'isi' => [
              'status' => strtoupper($params['rekomendasi']),
              'nama_asesi' => $params['nama_asesi'],
              'rekomendasi' => $params['rekomendasi'],
              'keterangan' => $params['keterangan'],
              'aspek' => $params['aspek'],
              'pencatatan_penolakan' => $params['pencatatan_penolakan'],
              'saran_perbaikan' => $params['saran_perbaikan'],
            ],
        ];
        Mail::to($params['email'])->send(new SendEmail($data_email));
        return '<h1>berhasil</h1>';
    }
}