<div class="container mt-10">
	@php 
		$collection = collect($data);
	@endphp
	@foreach ($collection as $key => $val)
		<table class="table table-bordered">
			@foreach($val as $item)
				<tr>
					<td>{{ $item }}</td>
				</tr>
				<tr>
					<td></td>
				</tr>
			@endforeach
		</table>
	@endforeach
	<h6>FR.APL.02. ASESMEN MANDIRI</h6>
</div>
<div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="4"></td>
				</tr>
				<tr>
					<td rowspan="2">
						<div>Skema Sertifikasi &nbsp; (KKNI/Okupasi/Klaster)</div>
					</td>
					<td>
						<div>Judul</div>
					</td>
					<td>
						<div>:</div>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td>
						<div>Nomor</div> </td>
					<td>
						<div>:</div>
					</td>
					<td>
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
			<table border="1">
				<tr>
					<td>
						<div><strong>Unit Kompetensi: 1</strong></div>
					</td>
					<td colspan="4">
						<div>Mengikuti prosedur kesehatan, keselamatan dan keamanan keria</div>
					</td>
				</tr>
				<tr>
					<td class="bg-dark text-white text-center" colspan="2">
						<div><strong>Dapatkah Saya ................?</strong></div>
					</td>
					<td class="bg-dark text-white text-center">
						<div><strong>K</strong></div>
					</td>
					<td class="bg-dark text-white text-center">
						<div><strong>BK</strong></div>
					</td>
					<td class="bg-dark text-white text-center">
						<div><strong>Bukti yang relevan</strong></div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<ol>
							<li>Elemen: Mengikuti Prosedur-prosedur Kesehatan, Keselamatan dan Keamanan Kerja</li>
						</ol>
						<ul>
							<li>Kriteria Unjuk Kerja:</li>
						</ul>
						<ol>
							<li>Apakah anda dapat Menaati prosedur kesehatan, keselamatan dan keamanan sesuai dengan kebijakan organisasi, undang-undang&nbsp; terkait, persyaratan asuransi, serta <em>safety plan</em> yang tepat ?</li>
							<li>Apakah anda dapat Mengidentifikasikan dan menginformasikan dengan segera prosedur kesehatan, keselamatan, dan keamanan kerja ?</li>
							<li>Apakah anda dapat Melakukan pekerjaan dengan aman dan memastikan bahwa seluruh kegiatan berada dalam suatu kondisi yang aman dan tidak terdapat bahaya bagi pekerja maupun masyarakat ?</li>
						</ol>
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<table border="1">
				<tr>
					<td>Nama Asesi:</td>
					<td>Tanggal:</td>
					<td>Tanda Tangan Asesi:</td>
				</tr>
				<tr>
					<td>{{ $skemaSertifikasi->nama_peserta }}</td>
					<td>{{ $skemaSertifikasi->mulai }}</td>
					<td>Tanda Tangan Asesi</td>
				</tr>
				<tr>
					<td class="bg-dark text-white text-center" colspan="3">Ditinjau oleh Asesor:</td>
				</tr>
				<tr>
					<td>Nama Asesor:</td>
					<td>
						<div><strong>Rekomendasi:</strong></div>
						<div>Asesmen dapat dilanjutkan/ tidak dapat dilanjutkan</div>
					</td>
					<td>Tanda Tangan dan Tanggal:</td>
				</tr>
				<tr>
					<td>{{ $skemaSertifikasi->nama_asesor }}</td>
					<td>
						<div><strong>Rekomendasi:</strong></div>
						<div>Asesmen dapat dilanjutkan/ tidak dapat dilanjutkan</div>
					</td>
					<td>Tanda Tangan dan Tanggal:</td>
				</tr>
			</table>
		</div>
	</div>
</div>