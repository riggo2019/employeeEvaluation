<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('home.component.head')
</head>

<body class="">
    @include('home.component.header')
    @include('home.component.toast')
    <div class="main-content">
        @include( $content )
    </div>
    @include('home.component.scripts')
</body>
</html>
