<div class="dash-nav dash-nav-dark">
    <header>
        <div class="easion-logo text-white"><img src="{{ asset('image/logo2.jpg') }}" class="admin-logo"><span>I-Medicare</span></div>
    </header>
    <nav class="dash-nav-list">
        <a href="{{ route('admin.index') }}" class="dash-nav-item">
            <i class="fas fa-home"></i>Trang chủ
        </a>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-user-tie"></i>Quản lý nhân viên</a>
            <div class="dash-nav-dropdown-menu">
                <a href="{{ route('admin.users') }}" class="dash-nav-dropdown-item">Danh sách</a>
                <a href="{{ route('admin.addUsers') }}" class="dash-nav-dropdown-item">Thêm mới</a>
            </div>
        </div>
        {{-- <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-building"></i>Quản lý đánh giá</a>
            <div class="dash-nav-dropdown-menu">
                <a href="user-list.html" class="dash-nav-dropdown-item">Lễ Tân</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Điều dưỡng</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Kỹ thuật viên</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Khối Hành chính</a>
            </div>
        </div> --}}
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-users"></i>Tổng hợp bộ phận</a>
            <div class="dash-nav-dropdown-menu">
                <a href="user-list.html" class="dash-nav-dropdown-item">Lễ Tân</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Điều dưỡng</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Kỹ thuật viên</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Khối Hành chính</a>
            </div>
        </div>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-user"></i></i>Tổng hợp cá nhân</a>
            <div class="dash-nav-dropdown-menu">
                <a href="user-list.html" class="dash-nav-dropdown-item">Lễ Tân</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Điều dưỡng</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Kỹ thuật viên</a>
                <a href="user-add.html" class="dash-nav-dropdown-item">Khối Hành chính</a>
            </div>
        </div>
        <a href="{{ route('logout') }}" class="dash-nav-item logout-option">
            <i class="fas fa-sign-out-alt"></i>Đăng xuất
        </a>
    </nav>
</div>
