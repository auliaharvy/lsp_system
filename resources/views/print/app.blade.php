<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{$title}}</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		@include('style')
	</head>
	<body>
		@yield('content')
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
		<script>
			const tanggalWaktu = document.getElementById("tanggalWaktu");
			const dt = new Date();
			const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
			const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			tanggalWaktu.innerHTML = hari[dt.getDay()]+ " " + dt.getDate() + " " + bulan[dt.getMonth()] + " " + dt.getFullYear();

			const cancel = document.getElementById("cancel");
			const cancelExcel = document.getElementById("cancel-excel");
			const containerAlert = document.getElementById("container-alert");
			const containerAlertExcel = document.getElementById("container-alert-excel");
			const ok = document.getElementById("ok");
			const okExcel = document.getElementById("ok-excel");

			function alertBox(id){
				containerAlert.style.display = "flex";
				const okId = document.getElementById("ok-id");
			 	const href = document.createAttribute("href");
			 	href.value = `/delete/${id}`;
			 	okId.setAttributeNode(href);
			}				

			function alertExcelBox(){
			 	containerAlertExcel.style.display = "flex";
			}

			okExcel.onclick = function(){
			 	containerAlertExcel.style.display = "none";
			}

			cancel.onclick = function(){
				containerAlert.style.display = "none";
			}

			cancelExcel.onclick = function(){
				containerAlertExcel.style.display = "none";
			}
		</script>
	</body>
</html>