<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.component.head')
</head>

<body>
    <div class="dash">
        @include('admin.component.sidebar')
        <div class="dash-app">
            @include('admin.component.header')
            <main class="dash-content">
                @include($content)
            </main>
        </div>
        @include('admin.component.toast')
    </div>
    @include('admin.component.scripts')
</body>

</html>
