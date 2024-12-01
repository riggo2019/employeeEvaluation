<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="icon" type="image/x-icon" href="{{ asset('image/logo.jpg') }}">
@if (isset($css_files))
    @foreach ($css_files as $css)
        <link rel="stylesheet" href="{{ asset("$css") }}">
    @endforeach
@endif
<title>Website đánh giá nhân viên</title>
