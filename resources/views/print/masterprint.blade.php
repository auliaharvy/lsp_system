<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Report LSP System</title>
</head>

<body>
  @foreach ($datamodule as $module)
  @include('print.' . $module['nama'],
  [
  'data' => $module['data'],
  'skemaUnit' => $skemaunit,
  'skemaSertifikasi' => $skemasertifikasi,
  'asesor' => $asesor
  ])
  <div style="page-break-after: always"></div>
  @endforeach
  {{-- {{ $datamodule }} --}}
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>