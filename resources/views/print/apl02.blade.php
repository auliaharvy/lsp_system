<div class="pr-4 mt-10">
	<h6>FR.APL.02. ASESMEN MANDIRI</h6>
</div>
<div class="pr-4">
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
						<div>{{ $skemaSertifikasi->skema_sertifikasi }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>Nomor</div> </td>
					<td>
						<div>:</div>
					</td>
					<td>
						<div>{{ $skemaSertifikasi->kode_skema }}</div>
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
							<li>Beri tanda centang <input type="checkbox" checked aria-label="Checkbox for following text input"> pada kotak jika Anda yakin dapat melakukan tugas yang dijelaskan.</li>
							<li>Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan bahwa Anda melakukan tugas-tugas ini.</li>
						</ul>
					</td>
				</tr>
			</table>
			<table border="1">
				@php 
					$indexUnitKompetensi = 1; 
				@endphp
				@foreach($data as $row)
					<tr>
						<td>
							<div><strong>Unit Kompetensi: {{ $indexUnitKompetensi }}</strong></div>
						</td>
						<td colspan="4">
							<div>{{ $row['unit_kompetensi'] }}</div>
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
					@foreach($row['elemen'] as $item)
						<tr>
							<td colspan="2">
								<ol>
									<li>Elemen: {{ $item['nama_elemen'] }}</li>
								</ol>
								<ul>
									<li>Kriteria Unjuk Kerja:</li>
								</ul>
									<ol>
										@foreach($item['kuk'] as $atom)
											<li>{{ $atom['kuk'] }}</li>
										@endforeach
									</ol>
								</ul>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					@endforeach
				@php $indexUnitKompetensi++; @endphp
				@endforeach
			</table>
			<table border="1">
				<tr>
					<td><div>Nama Asesi : </div></td>
					<td><div>Tanggal : </div></td>
					<td><div>Tanda Tangan Asesi : </div></td>
				</tr>
				<tr>
					<td><div>{{ $skemaSertifikasi->nama_peserta }}</div></td>
					<td><div>{{ $skemaSertifikasi->mulai }}</div></td>
					<td>
					<div>{{ $skemaSertifikasi->mulai }}</div>
					</td>
				</tr>
				<tr>
					<td class="bg-dark text-white text-center" colspan="3"><div>Ditinjau oleh Asesor:</div></td>
				</tr>
				<tr>
					<td><div>Nama Asesor:</div></td>
					<td>
						<div><strong>Rekomendasi:</strong></div>
						<div>Asesmen dapat dilanjutkan/ tidak dapat dilanjutkan</div>
					</td>
					<td><div>Tanda Tangan dan Tanggal:</div></td>
				</tr>
				<tr>
					<td><div>{{ $skemaSertifikasi->nama_asesor }}</div></td>
					<td>
						<div><strong>Rekomendasi:</strong></div>
						<div>Asesmen dapat dilanjutkan/ tidak dapat dilanjutkan</div>
					</td>
					<td>
						<div>{{ $skemaSertifikasi->mulai }}</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>