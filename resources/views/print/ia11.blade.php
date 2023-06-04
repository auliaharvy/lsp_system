<div class="container">
  <h6>FR.IA.11 CEKLIS MENINJAU INSTRUMEN ASESMEN</h6>
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
          <td>{{ $skemaSertifikasi['skema_sertifikasi']}}</td>
        </tr>
        <tr>
          <td>TUK</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['nama_tuk'] }}</td>
        </tr>
        <tr>
          <td>Nama Asesor</td>
          <td>:</td>
          <td>{{ $asesor }}</td>
        </tr>
        <tr>
          <td>Nama Asesi</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['nama_peserta'] }}</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>:</td>
          <td>{{ $skemaSertifikasi['mulai'] }}</td>
        </tr>
      </table>
      <table class="table">
        <tr>
          <td class="bg-dark text-white" colspan="3">PANDUAN BAGI PENINJAU /ASESOR</td>
        </tr>
        <tr>
          <td>
            <ul>
              <li>Lengkapi nama unit kompetensi, elemen, kriteria unjuk kerja sesuai kolom dalam tabel.</li>
              <li>Istilah Acuan Pembanding dengan SOP / spesifikasi produk dari industri / orginasi dari tempat kerja
                atau simulasi tempat
                kerja</li>
              <li>Beri tanda centang pada kolom K jika Anda yakin asesi dapat melakukan/mendemonstrasikan tugas seuai
                KUK, atau centang
                pada kolom BK bila sebaliknya.</li>
              <li>Penilaian lanjut diisi bila hasil belum dapat disimpulkan, untuk itu gunakan metode lain sehingga
                keputusan dapat dibuat</li>
            </ul>
          </td>
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
      <table class="col-md-12 table-bordered table-striped">
        <tr>
          <td class="bg-dark text-white text-center px-2">No.</td>
          <td class="bg-dark text-white text-center px-2">Pertanyaan</td>
          <td class="bg-dark text-white text-center px-2">Ya / Tidak</td>
          <td class="bg-dark text-white text-center px-2">Komentar</td>
        </tr>
        @php
        $detailIa11 = collect($data['detail']);
        @endphp
        @foreach ($detailIa11 as $key => $item)
        <tr>
          <td class="text-center px-2">{{ $key+1 }}</td>
          <td class="justify-content-center px-2">{{ $detailIa11[$key]['pertanyaan'] }}</td>
          <td class="justify-content-center px-2">{{ $detailIa11[$key]['tanggapan'] }}</td>
          <td class="justify-content-center text-center px-2">{{ $detailIa11[$key]['komentar'] }}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <div class="col-12 mt-3">
      <div class="p-3">
        <label for="asesor">Nama Peninjau</label>
        <input type="text" class="formcontrol" id="asesor" value={{ $asesor }}>
      </div>
      <div class="p-3">
        <label for="tanggal">Tanggal</label>
        <input type="text" class="formcontrol" id="tanggal" value={{ $skemaSertifikasi['mulai'] }}>
      </div>
      <div class="p-3">
        <label for="komentar">Komentar</label>
        <textarea name="textareakomentar" cols="30" rows="10">{{ $data['ia_11']['komentar'] }}</textarea>
      </div>
    </div>
  </div>
</div>