<div class="container">
  <h6>FR.AK.05 LAPORAN ASESMEN</h6>
</div>
<div class="container">
  <div class="row">
    <div class="col-12">
      <table class="table">
        <tr>
          <td class="bg-dark" colspan="3"></td>
        </tr>
        <tr>
          <td>Skema Sertifikasi</td>
          <td>:</td>
          <td> {{ $skemaSertifikasi['skema_sertifikasi'] }}</td>
        </tr>
        <tr>
          <td>Nama Asesor</td>
          <td>:</td>
          <td>{{ $asesor }}</td>
        </tr>
        <tr>
          <td>TUK</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['nama_tuk'] }}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['mulai']}}</td>
        </tr>
      </table>
      <table class="table table-bordered col-md-12">
        <tr>
          <td class="bg-dark text-white" colspan="3"></td>
        </tr>
        <tr>
          <td class="justify-content-center" rowspan="2">
            Uji Kompetensi
          </td>
          <td class="justify-content-center">Kode Unit</td>
          <td>
            <ul>
              @foreach ($skemaUnit as $unit)
              <li>{{ $unit['kode_unit'] }}</li>
              @endforeach
            </ul>
          </td>
        </tr>
        <tr>
          <td class="justify-content-center">Judul Unit</td>
          <td>
            <ul>
              @foreach ($skemaUnit as $unit)
              <li>{{ $unit['unit_kompetensi']}}</li>
              @endforeach
            </ul>
          </td>
        </tr>
      </table>
    </div>
    <div class="col-12">
      <table class="table table-borderless">
        <tr>
          <td>Nama Asesi</td>
          <td>:</td>
          <td>{{ $data['ak_05']->nama_asesi }}</td>
        </tr>
        <tr>
          <td>Rekomendasi</td>
          <td>:</td>
          <td>{{ $data['ak_05']->rekomendasi }}</td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td>:</td>
          <td>{{ $data['ak_05']->keterangan }}</td>
        </tr>
        <tr>
          <td>Aspek Negatif dan Positif Dalam Asesmen</td>
          <td>:</td>
          <td>{{ $data['ak_05']->aspek}}</td>
        </tr>
        <tr>
          <td>Pencatatan Penolakan Hasil Asesmen</td>
          <td>:</td>
          <td>{{ $data['ak_05']->pencatatan_penolakan }}</td>
        </tr>
        <tr>
          <td>Saran Perbaikan (Asesor / Personil Terkait)</td>
          <td>:</td>
          <td>{{ $data['ak_05']->saran_perbaikan }}</td>
        </tr>
      </table>
    </div>
  </div>
</div>