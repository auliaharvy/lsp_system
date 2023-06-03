<div class="container mt-10">
	<h6>FR.IA.01. CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h6>
</div>
<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="5"></td>
				</tr>
				<tr>
					<td rowspan="2">
						<div>Skema Sertifikasi (KKNI/Okupasi/Klaster)</div>
					</td>
					<td>
						<div>Judul</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="2">
						<div>{{ $skemaSertifikasi->skema_sertifikasi }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>Nomor</div>
					</td>
					<td>
						<div>:<div>
					</td>
					<td colspan="2">
						<div>{{ $skemaSertifikasi->kode_skema }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>TUK</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="2">
						<div>{{ $skemaSertifikasi->nama_tuk }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Nama Asesor</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="2">
						<div>{{ $skemaSertifikasi->nama_asesor }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Nama Asesi</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="2">
						<div>{{ $skemaSertifikasi->nama_lengkap }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Tanggal</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td colspan="2">
						<div>{{ $skemaSertifikasi->mulai }}</div>
					</td>
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark text-white text-center">
						<div><strong>PANDUAN ASESMEN MANDIRI</strong></div>
					</td>
				</tr>
				<tr>
					<td>
						<div><strong>Instruksi:</strong></div>
						<ul>
							<li>Baca setiap pertanyaan di kolom sebelah kiri.</li>
							<li>Beri tanda centang (&radic;) pada kotak jika Anda yakin dapat melakukan tugas yang dijelaskan.</li>
							<li>Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan bahwa Anda melakukan tugas-tugas ini.</li>
						</ul>
					</td>
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="6"></td>
				</tr>
				@php $a = 1; @endphp
				@foreach($skemaUnit as $data)
					<tr>
						<td rowspan="2">
							<div>Unit Kompetensi {{ $a }}</div>
						</td>
						<td>
							<div>Kode Unit</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $data->kode_unit }}</div>
						</td>
					</tr>
					<tr>
						<td>
							<div>Judul Unit</div>
						</td>
						<td>
							<div>:</div>
						</td>
						<td colspan="2">
							<div>{{ $data->unit_kompetensi }}</div>
						</td>
					</tr>
					@php $a++; @endphp
				@endforeach
			</table>
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="7"></td>
				</tr>
				<tr>
					<td rowspan="2">
						<div>No.</div>
					</td>
					<td rowspan="2">
						<div>Elemen</div>
					</td>
					<td rowspan="2">
						<div>Kriteria Untuk Kerja*</div>
					</td>
					<td rowspan="2">
						<div>Benchmark (SOP / spesifikasi produk industri)</div>
					</td>
					<td colspan="2">
						<div>Rekomendasi</div>
					</td>
					<td rowspan="2">
						<div>Penilaian Lanjut</div>
					</td>
				</tr>
				<tr>
					<td>
						<span>K</span>
					</td>
					<td>
						<span>BK</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
