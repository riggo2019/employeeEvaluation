<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="icon" type="image/x-icon" href="{{ asset('image/logo2.jpg') }}">

<link rel="stylesheet" href="{{ asset('/lib/fontawesome.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
    integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<link rel="stylesheet" href={{ asset('/css/toast.css') }}>
<link href="{{ asset('/lib/nunitofont.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/css/admin/easion.css') }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/lib/jquery.dataTables.min.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
@if (isset($css_files))
    @foreach ($css_files as $css)
        <link rel="stylesheet" href="{{ asset("$css") }}">
    @endforeach
@endif
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title>Trang quản lý</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
