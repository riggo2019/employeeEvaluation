<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="#" class="col-md-3 text-center">
        <img src="{{ asset('image/logo1.png') }}" alt="logo" height="50px">
    </a>
    <ul class="nav col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home.index') }}" class="nav-link px-4 link-secondary">Trang chủ</a></li>
        @if (Auth::check() && Auth::user()->is_admin == 1)
            <li><a href="{{ route('admin.index') }}" class="nav-link px-4 link-dark">Trang quản lý</a></li>
        @else
            @if(Auth::user()->answered == 1)
                <li><a href="{{ route('home.results') }}" class="nav-link px-4 link-dark">Trang kết quả</a></li>
            @else
                <li><a href="{{ route('home.answer') }}" class="nav-link px-4 link-dark">Trả lời câu hỏi</a></li>
            @endif
        @endif
        <li><a href="{{ route('evaluation_management') }}" class="nav-link px-4 link-secondary">Quản lý đánh giá</a></li>
    </ul>


    @if (!Auth::check())
        <div class="col-md-3 text-end me-4">
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
        </div>
    @else
        <div class="col-md-3 d-flex gap-2 flex-row align-items-center justify-content-end me-4">
            <h2 class="fs-6 mb-0">Xin chào:
                <strong>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</strong></h2>
            <a href="{{ route('logout') }}" class="btn">Đăng xuất</a>
        </div>
    @endif
</header>
