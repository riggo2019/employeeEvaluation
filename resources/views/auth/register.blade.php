<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Đăng ký</h3>
            <form action="{{ route('auth.register') }}" method="post" class="m-t" role="form"
                enctype="multipart/form-data">
                @csrf
                @if (session('error'))
                    <div class="alert alert-danger">
                        {!! session('error') !!}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif
                <div class="mb-3">
                    <label for="first_name" class="form-label">Họ và tên đệm</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                    value="{{ old('first_name') }}" placeholder="Nhập họ và tên đệm" required>
                    @if ($errors->has('first_name'))
                        <span class="text-danger ds-alert">* {{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nhập tên"
                    value="{{ old('last_name') }}" required>
                    @if ($errors->has('last_name'))
                        <span class="text-danger ds-alert">* {{ $errors->first('last_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="user_name" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="user_name" name="user_name"
                    value="{{ old('user_name') }}"  placeholder="Nhập tên đăng nhập" required>
                    @if ($errors->has('user_name'))
                        <span class="text-danger ds-alert">* {{ $errors->first('user_name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Nhập mật khẩu" required>
                    @if ($errors->has('password'))
                        <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu" required>
                    @if ($errors->has('password.confirmed'))
                        <span class="text-danger ds-alert">* {{ $errors->first('password_confirmation') }}</span>
                    @endif  
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng ký</button>
            </form>
            <div class="text-center mt-3">
                <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
