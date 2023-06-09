<div class="pr-4 mt-10">
	<h6>FR.AK.04. BANDING ASESMEN</h6>
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
						<div><span>Tanggal Asesmen</span><span> : </span><span>{{ $data->tanggal_asesmen }}</span>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
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
					<td colspan="3">
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
					<td colspan="3">
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
					<td colspan="3">
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
					<td colspan="5">
						<div class="mb-2">Banding ini diajukan atas Keputusan Asesmen yang dibuat terhadap Skema
							Sertifikasi (Kualifikasi/<s>Klaster</s>/<s>Okupasi</s>) berikut</div>
						<div><strong>Skema Sertifikasi : </strong></div>
						<div class="mb-2">{{ $data->skema }}</div>
						<div><strong>No. Skema Sertifikasi</strong></div>
						<div>{{ $data->no_skema}}</div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div>Banding ini diajukan atas alasan sebagai berikut : </div>
						<div>{{ $data->alasan_banding }}</div>
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<div>Anda mempunyai hak mengajukan banding jika Anda menilai proses asesmen tidak sesuai SOP dan
							tidak memenuhi Prinsip Asesmen.</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div>Tanda Tangan Asesi : </div>
						@if($data->ttd_asesi !== '')
							<div>
								<img class="img-fluid" src="{{ public_path('/uploads/users/signature/'. $data->ttd_asesi )}}" alt="">
							</div>
						@else
							<div><strong>Belum bertanda tangan</strong></div>
						@endif
					</td>					
					<td colspan="3">
						<div>Tanggal : </div>
						<div>{{ $data->tanggal_asesmen }}</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>