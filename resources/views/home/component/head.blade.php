<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="icon" type="image/x-icon" href="{{ asset('image/logo2.jpg') }}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
@if (isset($css_files))
    @foreach ($css_files as $css)
        <link rel="stylesheet" href="{{ asset("$css") }}">
    @endforeach
@endif
<link rel="stylesheet" href="{{ asset("/css/bootstrap/bootstrap.min.css") }}">
<link rel="stylesheet" href="{{ asset("/css/home/style.css") }}">
<title>{{ $title }}</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

