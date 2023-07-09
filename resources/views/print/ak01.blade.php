<div class="pr-4 mt-10">
	<h6>FR.AK.01. PERSETUJUAN ASESMEN DAN KERAHASIAAN</h6>
</div>
<div class="pr-4">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
				<tr>
					<td class="bg-dark" colspan="5"></td>
				</tr>
				<tr>
					<td colspan="5">
						<div>Persetujuan Asesmen ini untuk menjamin bahwa Asesi telah diberi arahan secara rinci tentang perencanaan dan proses asesmen</div>
					</td>
				</tr>
				<tr>
					<td rowspan="2">
						<div>Skema Sertifikasi (KKNI/Okupasi/Klaster)</div>
					</td>
					<td>
						<div>Judul<div>
					</td>
					<td>
						<div>:<div>
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
						<div>:<div>
					</td>
					<td colspan="2">
						<div>{{ $data->tuk }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Nama Asesor</div>
					</td>
					<td>
						<div>:<div>
					</td>
					<td colspan="2">
						<div>{{ $data->nama_asesor }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Nama Asesi</div>
					</td>
					<td>
						<div>:<div>
					</td>
					<td colspan="2">
						<div>{{ $data->nama_asesi }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Bukti yang akan dikumpulkan</div>
					</td>
					<td>
						<div>:<div>
					</td>
					<td colspan="2">
						<div>
							@if($data->verifikasi_portfolio == 1)
								<span>Verifikasi portfolio, </span>
							@else
								<span><s>Verifikasi portfolio</s>, </span>
							@endif
							@if($data->observasi_langsung == 1)
								<span>Obervasi langsung, </span>
							@else
								<span><s>Obervasi langsung</s>, </span>
							@endif
							@if($data->hasil_tes_tulis == 1)
								<span>Hasil tes tulis, </span>
							@else
								<span><s>Hasil tes tulis</s>, </span>
							@endif
							@if($data->hasil_tes_lisan == 1)
								<span>Hasil tes lisan, </span>
							@else
								<span><s>Hasil tes lisan</s>, </span>
							@endif
							@if($data->hasil_tes_wawancara == 1)
								<span>Hasil tes wawancara</span>
							@else
								<span><s>Hasil tes wawancara</s></span>
							@endif
						</div>
					</td>
				</tr>
				<tr>
					<td rowspan="3" colspan="2">
						<div>Pelaksanaan asesmen disepakati pada</div>
					</td>
					<td>
						<div>:<div>
					</td>
					<td>
						<div>Hari / Tanggal</div>
					</td>
					<td>
						<div>{{ $data->hari }}, {{ $data->tanggal }} {{ $data->bulan }} {{ $data->tahun }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>:<div>
					</td>
					<td>
						<div>Waktu</div>
					</td>
					<td>
						<div>{{ $skemaSertifikasi->mulai }}</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>:<div>
					</td>
					<td>
						<div>TUK</div>
					</td>
					<td>
						<div>{{ $data->tuk }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div>Asesi: </div>
						<div>{{ $data->pernyataan_asesi }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div>Asesor: </div>
						<div>{{ $data->pernyataan_asesor }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Tanda Tangan Asesor : </div>
						@if($data->tanda_tangan_asesor !== '')
							<div>
								<img class="img-fluid" src="{{ public_path('/uploads/users/signature/'. $data->tanda_tangan_asesor )}}" alt="">
							</div>
						@else
							<div><strong>Belum bertanda tangan</strong></div>
						@endif
					</td>					
					<td colspan="3">
						<div>Tanggal : </div>
						<div>{{ $data->hari }}, {{ $data->tanggal }} {{ $data->bulan }} {{ $data->tahun }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Tanda Tangan Asesi : </div>
						@if($data->tanda_tangan_asesi !== '')
							<div>
								<img class="img-fluid" src="{{ public_path('/uploads/users/signature/'. $data->tanda_tangan_asesi)}}" alt="">
							</div>
						@else
							<div><strong>Belum bertanda tangan</strong></div>
						@endif
					</td>					
					<td colspan="3">
						<div>Tanggal : </div>
						<div>{{ $data->hari }}, {{ $data->tanggal }} {{ $data->bulan }} {{ $data->tahun }}</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>