<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="#" class="col-md-2 text-center">
        <img src="{{ asset('image/logo1.png') }}" alt="logo" height="50px">
    </a>

    <ul class="nav col-8 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home.index') }}" class="nav-link px-4 link-secondary">Trang chủ</a></li>
        <li><a href="{{ route('home.translate') }}" class="nav-link px-4 link-dark">Phiên dịch - Điều phối</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Điều dưỡng</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Kỹ thuật viên</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Khối hành chính</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Quản lý</a></li>
    </ul>
    @if (!Auth::check())
        <div class="col-md-2 text-center">
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
        </div>
    @else
    <div class="col-md-2 d-flex gap-2 flex-row align-items-center">
        <h5 class="fs-6 mb-0">Xin chào: <strong>{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}}</strong></h2>
        <a href="{{ route('logout') }}" class="btn">Đăng xuất</a>
    </div>
    @endif
</header>
