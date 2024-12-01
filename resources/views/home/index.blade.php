<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('home.component.head')
</head>

<body class="">
    @include('home.component.header')
    <div class="container">
        @include( $content )
    </div>
    @include('home.component.scripts')
</body>
</html>
