 <div class="container mt-10">
	<h6>FR.AK.04. BANDING ASESMEN</h6>
 </div>
 <div class="container">
	<div class="row">
		<div class="col-12">
			<table class="table table-bordered">
				<tr>
					<td colspan="5">
						<div><span>Nama Asesi</span><span> : </span><span>{{ $data->nama_asesi }}</span></div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div><span>Nama Asesor</span><span> : </span><span>{{ $data->nama_asesor }}</span></div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div><span>Tanggal Asesmen</span><span> : </span><span>{{ $data->tanggal_asesmen }}</span></div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div>Jawablah dengan Ya atau Tidak pertanyaan-pertanyaan berikut ini</div>
					</td>
					<td>
						<div>YA</div>
					</td>
					<td>
						<div>TIDAK</div>
					</td>
				</tr>
				<tr>
					<td>
						<div>Apakah Proses Banding telah dijelaskan kepada Anda?</div>
					</td>
					@if ($data->penjelasan === 1) 
						<td>
							<div>YA</div>
						</td>
						<td>
							<div></div>
						</td>
					@else
						<td>
							<div></div>
						</td>
						<td>
							<div>TIDAK</div>
						</td>
					@endif
				</tr>
				<tr>
					<td>
						<div>Apakah Anda telah mendiskusikan Banding dengan Asesor?</div>
					</td>
					@if ($data->diskusi === 1) 
						<td>
							<div>YA</div>
						</td>
						<td>
							<div></div>
						</td>
					@else
						<td>
							<div></div>
						</td>
						<td>
							<div>TIDAK</div>
						</td>
					@endif
				</tr>
				<tr>
					<td>
						<div>Apakah Anda mau melibatkan “orang lain” membantu Anda dalam Proses Banding?</div>
					</td>
					@if ($data->melibatkan === 1) 
						<td>
							<div>YA</div>
						</td>
						<td>
							<div></div>
						</td>
					@else
						<td>
							<div></div>
						</td>
						<td>
							<div>TIDAK</div>
						</td>
					@endif
				</tr>
				<tr>
					<td colspan="3">
						<div class="mb-2">Banding ini diajukan atas Keputusan Asesmen yang dibuat terhadap Skema Sertifikasi (Kualifikasi/Klaster/Okupasi) berikut</div>
						<div><strong>Skema Sertifikasi : </strong></div>
						<div class="mb-2">{{ $data->skema }}</div>
						<div><strong>No. Skema Sertifikasi</strong></div>
						<div>{{ $data->no_skema}}</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div>Banding ini diajukan atas alasan sebagai berikut : </div>
						<div>{{ $data->alasan_banding }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div>Anda mempunyai hak mengajukan banding jika Anda menilai proses asesmen tidak sesuai SOP dan tidak memenuhi Prinsip Asesmen.</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div><span>Tanda Tangan Asesi : </span><span>Tanggal : </span></div>
						<div><span>Letakan foto disini</span><span>{{ $data->tanggal_asesmen }}</span></div>
					</td>
				</tr>
			</table>
		</div>
	</div>
 </div>