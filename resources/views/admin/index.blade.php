<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.component.head')
</head>

<body>
    <div id="toast" class="toast"></div>
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
    <script>
        function showToast(message, type) {
            var toast = document.getElementById("toast");
            toast.className = "toast show " + type;
            toast.innerText = message;
            setTimeout(function() {
                toast.className = toast.className.replace("show", "");
            }, 3000);
        }
    </script>
    <script>
        @if (session('message'))
            showToast("{{ session('message') }}", "{{ session('type') }}");
            <?php
            Session::forget('message');
            Session::forget('type');
            ?>
        @endif
    </script>
    @include('admin.component.scripts')
</body>

</html>
