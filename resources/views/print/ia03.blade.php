<div class="container">
  <h6>FR.IA.03 PERTANYAAN UNTUK MENDUKUNG OBSERVASI</h6>
</div>
{{-- @php
$collection = collect( $data );
@endphp
{{ $collection }} --}}

<div class="row col-12">
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
    <table class="table col-12" style="page-break-after: always">
      <tr>
        <td class="bg-dark text-white" colspan="3">PANDUAN BAGI ASESOR</td>
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
    <table class="col-md-12 table-bordered">
      <tr>
        <td class="bg-dark text-white text-center px-2">No.</td>
        <td class="bg-dark text-white text-center px-2">Pertanyaan</td>
        <td class="bg-dark text-white text-center px-2">Tanggapan</td>
        <td class="bg-dark text-white text-center px-2">Rekomendasi</td>
      </tr>
      @php
      $collection = collect( $data['detail'] );
      @endphp
      @foreach ($collection as $key => $val)
      <tr>
        <td class="text-center px-2">{{$key+1}}</td>
        <td class="justify-content-center px-2">{{ $collection[$key]['pertanyaan']}}</td>
        <td class="justify-content-center px-2">{{ $collection[$key]['tanggapan']}}</td>
        <td class="justify-content-center px-2">{{ $collection[$key]['rekomendasi']}}</td>
      </tr>
      @endforeach
    </table>
    <div class="col-12 mt-3">
      <p>Rekomendasi Asesor : </p>
      @if ($data['ia_03']['rekomendasi_asesor'] == 'Kompeten')
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioKompeten" checked>
        <label class="form-check-label" for="inlineRadioKompeten">Kompeten</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioBelumKompeten">
        <label class="form-check-label" for="inlineRadioBelumKompeten">Belum Kompeten</label>
      </div>
      @else
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioKompeten" checked>
        <label class="form-check-label" for="inlineRadioKompeten">Kompeten</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadioBelumKompeten">
        <label class="form-check-label" for="inlineRadioBelumKompeten">Belum Kompeten</label>
      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-4">Umpan Balik untuk Asesi :</div>
        <div class="col-md-8">{{ $data['ia_03']['umpan_balik']}}</div>
      </div>
    </div>
  </div>
</div>