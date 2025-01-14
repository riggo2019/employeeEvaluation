<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/toast.css') }}>
</head>

<body class="bg-light">
    <div id="toast" class="toast"></div>
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
        <select onchange="window.location.href=this.value" class="form-select-sm p-1 position-absolute" style="top:50px;">
            <option value="{{ route('change.language', 'vi') }}"
                {{ app()->getLocale() === 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
            <option value="{{ route('change.language', 'ko') }}"
                {{ app()->getLocale() === 'ko' ? 'selected' : '' }}>한국어</option>
        </select>
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">{{ __('messages.login') }}</h3>
            <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label">{{ __('messages.user_name') }}</label>
                    <input type="text" class="form-control" id="user_name" name="user_name"
                        placeholder="{{ __('messages.input_user_name') }}" required>
                    @if ($errors->has('user_name'))
                        <span class="text-danger ds-alert">* {{ $errors->first('user_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('messages.password') }}</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="{{ __('messages.input_password') }}" required>
                    @if ($errors->has('password'))
                        <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary w-100">{{ __('messages.login') }}</button>
            </form>
            {{-- <div class="text-center mt-3">
                <p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
            </div> --}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
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
</html>
