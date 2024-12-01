<div class="pr-4 mt-10">
  <h6>FR.IA.03 PERTANYAAN UNTUK MENDUKUNG OBSERVASI</h6>
</div>
<div class="pr-4">
  <div class="row">
    <div class="col-12">
			<div class="table-responsive">
        <table class="table table-bordered tree">
          <tr class="no-page-break">
            <td class="bg-dark" colspan="3"></td>
          </tr>
          <tr class="no-page-break">
            <td>Skema Sertifikasi</td>
            <td>:</td>
            <td>{{ $skemaSertifikasi['skema_sertifikasi']}}</td>
          </tr>
          <tr class="no-page-break">
            <td>TUK</td>
            <td>:</td>
            <td>{{ $skemaSertifikasi['nama_tuk'] }}</td>
          </tr>
          <tr class="no-page-break">
            <td>Nama Asesor</td>
            <td>:</td>
            <td>{{ $asesor }}</td>
          </tr>
          <tr class="no-page-break">
            <td>Nama Asesi</td>
            <td>:</td>
            <td>{{ $skemaSertifikasi['nama_peserta'] }}</td>
          </tr>
          <tr class="no-page-break">
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $skemaSertifikasi['mulai'] }}</td>
          </tr>
        </table>
      </div>
			<div class="table-responsive">
        <table class="table table-bordered tree">
          <tr class="no-page-break">
            <td class="bg-dark text-white" colspan="3">PANDUAN BAGI ASESOR</td>
          </tr>
          <tr class="no-page-break">
            <td>
              <ul>
                <li>Formulir ini di isi oleh asesor kompetensi dapat sebelum, pada saat atau setelah melakukan
                  asesmen dengan methode observasi demonstrasi
                </li>
                <li>Pertanyaan dibuat dengan tujuan untuk menggali, dapat berisi pertanyaan yang berkaitan
                  dengan dimensi kompetensi, batasan variabel dan aspek kritis yang relevan dengan skenario
                  tugas dan praktik demonstrasi
                </li>
                <li>Jika pertanyaan disampaikan sebelum asesi melakukan praktik demonstrasi, maka
                  pertanyaan dibuat berkaitan dengan aspek K3L, SOP, penggunaan peralatasn dan
                  perlengkapan.
                </li>
                <li>Jika setelah asesi melakukan praktik demonstrasi terdapat item pertanyaan pendukung
                  observasi telah terpenuhi, maka pertanyaan tersebut tidak perlu ditanyakan lagi dan cukup
                  memberi catatan bahwa sudah terpenuhi pada saat tugas praktek demonstrasi pada kolom
                  tanggapan
                </li>
                <li>Jika pada saat observasi adalah hal yang perlu dikonfirmasi sedangkan di instrumen daftar
                  pertanyaan pendukung observasi tidak ada, maka asesor dapat memberikan pertanyaan
                  dengan syarat pertanyaan harus berkaitan dengan tugas praktek demonstrasi. jika dilakukan,
                  asesor harus mencatat dalam instrumen pertanyaan pendukung observasi.
                </li>
                <li>Tanggapan asesi ditulis pada kolom tanggapan
                </li>
              </ul>
            </td>
          </tr>
        </table>
      </div>
			<div class="table-responsive">
				<table class="table table-bordered tree" style="margin-bottom: 50px;">
          <thead>
            <tr class="no-page-break">
              <td class="bg-dark text-white text-center align-middle" rowspan="{{ $kelompok_pekerjaan->count() + 1 }}">Kelompok Pekerjaan {{ $nama_kelompok_pekerjaan }}</td>
              <td class="bg-dark text-white text-center">No</td>
              <td class="bg-dark text-white text-center">Kode Unit</td>
              <td class="bg-dark text-white text-center">Judul Unit</td>
            </tr>
          </thead>
					@foreach($kelompok_pekerjaan as $row)
						<tr class="no-page-break">
							<td class="text-center">{{ $loop->iteration }}</td>
							<td>{{ $row->kode_unit }}</td>
							<td>{{ $row->unit_kompetensi }}</td>
						</tr>
					@endforeach
				</table>
			</div>
      <table class="col-md-12 table-bordered">
        <tr class="no-page-break">
          <td rowspan="2" class="bg-dark text-white text-center px-2">No.</td>
          <td rowspan="2" class="bg-dark text-white text-center px-2">Pertanyaan</td>
          <td rowspan="2" class="bg-dark text-white text-center px-2">Tanggapan</td>
          <td colspan="2" class="bg-dark text-white text-center px-2">Pencapaian</td>
        </tr>
        <tr class="no-page-break">
          <td class="bg-dark text-white text-center px-2">Ya</td>
          <td class="bg-dark text-white text-center px-2">Tdk</td>
        </tr>
        @php
        $collection = collect( $data['detail'] );
        @endphp
        @foreach ($collection as $key => $val)
        <tr class="no-page-break">
          <td class="text-center px-2">{{$key+1}}</td>
          <td class="justify-content-center px-2">{{ $collection[$key]['pertanyaan']}}</td>
          <td class="justify-content-center px-2">{{ $collection[$key]['tanggapan']}}</td>
          <td class="justify-content-center px-2">
            @if ($collection[$key]['tanggapan'] == 1)
            <input type="checkbox" checked aria-label="Checkbox for following text input">
            @endif
          </td>
          <td class="justify-content-center px-2">
            @if ($collection[$key]['tanggapan'] == 0)
            <input type="checkbox" checked aria-label="Checkbox for following text input">
            @endif
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
</div>
</div>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        display: table-header-group;
    }
    tbody {
        display: table-row-group;
    }
    .no-page-break {
        page-break-inside: avoid;
    }
		.styled-list {
		padding-left: 20px; /* Memberikan ruang di kiri */
		list-style-type: disc; /* Menggunakan tanda bulat */
	}
	.styled-list div {
		display: list-item; /* Membuat elemen <div> tampil seperti <li> */
		list-style-position: inside; /* Menampilkan tanda bulat di dalam padding */
	}

  /* Menjaga kolom pertama tetap di posisi */
  td:first-child, th:first-child {
      position: sticky;
      left: 0;
      background-color: white;
      z-index: 2;
  }
</style>