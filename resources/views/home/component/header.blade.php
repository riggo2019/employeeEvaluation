<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="#" class="col-md-2 text-center">
        <img src="{{ asset('image/logo.jpg') }}" alt="logo" width="50px">
    </a>

    <ul class="nav col-8 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home.index') }}" class="nav-link px-4 link-secondary">Trang chủ</a></li>
        <li><a href="{{ route('home.translate') }}" class="nav-link px-4 link-dark">Phiên dịch - Điều phối</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Điều dưỡng</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Kỹ thuật viên</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Khối hành chính</a></li>
        <li><a href="#" class="nav-link px-4 link-dark">Quản lý</a></li>
    </ul>

    <div class="col-md-2 text-center ">
        <button type="button" class="btn btn-outline-primary me-2">Đăng nhập</button>
        <button type="button" class="btn btn-primary">Đăng ký</button>
    </div>
    <div class="col-md-2 dropdown text-center d-none">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</header>
