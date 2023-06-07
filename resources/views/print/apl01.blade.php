<div class="pr-4">
	<h6>FR.APL.01. PERMOHONAN SERTIFIKASI KOMPETENSI</h6>
	<h6>Bagian 1 : Rincian Data Pemohon Sertifikasi</h6>
	<p>Pada bagian ini, cantumlan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini.</p>
	<h6>a. Data Pribadi</h6>
</div>
<div class="pr-4">
 	<div class="row">
 		<div class="col-12">
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="3"></td>
				</tr>
				<tr>
					<td>Nama lengkap</td>
					<td>:</td>
					<td>{{ $data->nama_lengkap }}</td>
				</tr>
				<tr>
					<td>No. KTP/NIK/Paspor</td>
					<td>:</td>
					<td>{{ $data->nik }}</td>
				</tr>
				<tr>
					<td>Tempat / tgl. Lahir</td>
					<td>:</td>
					<td>{{ $data->tempat_lahir }} / {{ $data->tanggal_lahir }}</td>
				</tr>
				<tr>
					<td>Jenis kelamin</td>
					<td>:</td>
					<td>{{ $data->jenis_kelamin }}</td>
				</tr>
				<tr>
					<td>Alamat rumah</td>
					<td>:</td>
					<td>{{ $data->alamat }}</td>
				</tr>
				<tr>
					<td>No HP</td>
					<td>:</td>
					<td>{{ $data->no_hp }}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td>{{ $data->email }}</td>
				</tr>
				<tr>
					<td>Kualifikasi Pendidikan</td>
					<td>:</td>
					<td>{{ $data->nama_sekolah }} ({{ $data->tingkat }})</td>
				</tr>
			</table>
			<h6>b. Data Pekerjaan Sekarang</h6>
			<table class="table table-bordered">
				<tr>
					<td>Nama Institusi / Perusahaan</td>
					<td>:</td>
					<td></td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<td></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td></td>
				</tr>
				<tr  >
					<td>No Telp</td>
					<td>:</td>
					<td></td>
				</tr>
				<tr  >
					<td>Email</td>
					<td>:</td>
					<td></td>
				</tr>
				<tr>
					<td>Fax</td>
					<td>:</td>
					<td></td>
				</tr>
			</table>
			<h6>Bagian 2 : Data Sertifikasi</h6>
			<p>Tuliskan Judul dan Nomor Skema Sertifikasi yang anda ajukan berikut Daftar Unit Kompetensi sesuai kemasan pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta pengalaman kerja yang anda miliki.</p>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="4"></td>
				</tr>
				<tr>
					<td rowspan="2">Skema Sertifikasi (KKNI/Okupasi/Klaster)</td>
					<td>Judul</td>
					<td>:</td>
					<td>{{ $skemaSertifikasi->skema_sertifikasi }}</td>
				</tr>
				<tr>
					<td>Nomor</td>
					<td>:</td>
					<td>{{ $skemaSertifikasi->kode_skema }}</td>
				</tr>
				<tr>
					<td colspan="2">Tujuan Asesmen</td>
					<td>:</td>
					<td>
						<ul>
							<li>Sertifikasi</li>
							<li>Sertifikasi Ulang</li>
							<li>Pengakuan Kompetensi Terkini (PKT)</li>
							<li>Rekognisi Pembelajaran Lampau</li>
							<li>Lainnya</li>
						</ul>
					</td>
				</tr>
			</table>
			<h6>Daftar Unit Kompetensi sesuai kemasan</h6>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark text-white text-center">No.</td>
					<td class="bg-dark text-white text-center">Kode Unit</td>
					<td class="bg-dark text-white text-center">Judul Unit</td>
					<td class="bg-dark text-white text-center">Jenis Standar (Standar Khusus/Standar Internasional/SKKNI)</td>
				</tr>
				@php $a = 1; @endphp
				@foreach ($skemaUnit as $data)
					<tr>
						<td>{{ $a }}</td>
						<td>{{ $data->kode_unit }}</td>
						<td>{{ $data->unit_kompetensi }}</td>
						<td>SSKNI</td>
					</tr>
					@php $a++; @endphp
				@endforeach
			</table>
			<h6>Bagian 3 : Bukti Kelengkapan Pemohon</h6>
			<p>Bukti Persyaratan Dasar Pemohon</p>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark text-white text-center" rowspan="2">No.</td>
					<td class="bg-dark text-white text-center" rowspan="2">Bukti Persyaratan Dasar</td>
					<td class="bg-dark text-white text-center" colspan="2">Ada</td>
					<td class="bg-dark text-white text-center" rowspan="2">Tidak Ada</td>
				</tr>
				<tr>
					<td class="bg-dark text-white text-center">Memenuhi Syarat</td>
					<td class="bg-dark text-white text-center">Tidak Memenuhi Syarat</td>
				</tr>
				<tr>
					<td>1. </td>
					<td>Pas Foto 3 x 4</td>
					<td class="text-justify">
						@if ($data->foto !== '')
							<div style="text-align: center;"><input type="checkbox" checked aria-label="Checkbox for following text input"></div>
						@endif
					</td>
					<td>
						@if ($data->foto === '')
							<div></div>
						@endif
					</td>
					<td></td>
				</tr>
				<tr>
					<td>2. </td>
					<td>Fotocopy Sertifikat PKL</td>
					<td class="text-justify">
						@if ($data->sertifikat !== '')
							<div style="text-align: center;"><input type="checkbox" checked aria-label="Checkbox for following text input"></div>
						@endif
					</td>
					<td>
						@if ($data->sertifikat === '')
							<div></div>
						@endif
					</td>
					<td></td>
				</tr>
				<tr>
					<td>3. </td>
					<td>Fotocopy KK/KTP/Kartu Pelajar</td>
					<td class="text-justify">
						@if ($data->identitas !== '')
							<div style="text-align: center;"><input type="checkbox" checked aria-label="Checkbox for following text input"></div>
						@endif
					</td>
					<td>
						@if ($data->identitas === '')
							<div></div>
						@endif
					</td>
					<td></td>
				</tr>
				<tr>
					<td>4. </td>
					<td>Fotocopy Raport sem. 1-4</td>
					<td>
						@if ($data->raport !== '')
							<div style="text-align: center;"><input type="checkbox" checked aria-label="Checkbox for following text input"></div>
						@endif
					</td>
					<td>
						@if ($data->raport === '')
							<div></div>
						@endif
					</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>