<div class="pr-4 mt-10">
	<h6>FR.IA.01. CEKLIS OBSERVASI AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h6>
</div>
<div class="pr-4">
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
			<table class="table table-bordered" style="margin-bottom: 300px;">
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
							<li>Beri tanda centang <input type="checkbox" checked aria-label="Checkbox for following text input"> pada kotak jika Anda yakin dapat melakukan tugas yang
								dijelaskan.</li>
							<li>Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan
								bahwa Anda melakukan tugas-tugas ini.</li>
						</ul>
					</td>
				</tr>
			</table>
			@php $a = 1; $b = 1;@endphp
			@foreach($data['listDataKuk'] as $row)
				<table class="table table-bordered">
					<tr>
						<td class="bg-dark" colspan="7"></td>
					</tr>
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
							<div>{{ $row['kode_unit']}}</div>
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
							<div>{{ $row['unit_kompetensi']}}</div>
						</td>
					</tr>
				</table>
				<table class="table table-bordered" style="margin-bottom: 50px;">
				<table>
<tr>
<td rowspan="2">
<div><strong>No.</strong></div>
</td>
<td rowspan="2">
<div><strong>Elemen</strong></div>
</td>
<td rowspan="2">
<div><strong>Kriteria Unjuk Kerja*</strong></div>
</td>
<td rowspan="2">
<div><strong>Benchmark&nbsp;</strong></div>
<div><strong>(SOP / spesifikasi produk industri)</strong></div>
</td>
<td colspan="2">
<div><strong>Rekomendasi</strong></div>
</td>
<td>
<div><strong>Penilaian Lanjut</strong></div>
</td>
</tr>
<tr>
<td>
<div><strong>K</strong></div>
</td>
<td>
<div><strong>BK</strong></div>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td rowspan="3">
<div><span style="font-weight: 400;">1</span></div>
</td>
<td rowspan="3">
<div><span style="font-weight: 400;">Mengintreprestasikan kebutuhan desain latar sesuai dengan rancangan kondisi lokasi, setting situasi/ suasana/ Budaya</span></div>
</td>
<td>
<ul>
<li><span style="font-weight: 400;">Mengidentifikasi konsep desain latar dan naskah&nbsp;</span></li>
</ul>
</td>
<td rowspan="3">
<div><span style="font-weight: 400;">SKKNI</span></div>
</td>
<td>
<div><span style="font-weight: 400;">☐</span></div>
</td>
<td>
<div><span style="font-weight: 400;">☐</span></div>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<div><span style="font-weight: 400;">1.2 Memerlukan jenis dan bentuk standar desain latar yang diperlukan&nbsp;</span></div>
</td>
<td>
<div><span style="font-weight: 400;">☐</span></div>
</td>
<td>
<div><span style="font-weight: 400;">☐</span></div>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<div><span style="font-weight: 400;">1.3 Merencanakan seluruh desain latar yang diperlukan dengan mempertimbangkan perbandingan ukuran, bentuk dan fungsi&nbsp;</span></div>
</td>
<td>
<div><span style="font-weight: 400;">☐</span></div>
</td>
<td>
<div><span style="font-weight: 400;">☐</span></div>
</td>
<td>&nbsp;</td>
</tr>
				</table>
			@endforeach
		</div>
	</div>
</div>