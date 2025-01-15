<div class="dash-nav dash-nav-dark">
    <header>
        <div class="easion-logo text-white"><img src="{{ asset('image/logo2.jpg') }}" class="admin-logo"><span>I-Medicare</span></div>
    </header>
    <nav class="dash-nav-list">
        <a href="{{ route('admin.index') }}" class="dash-nav-item">
            <i class="fas fa-home"></i>{{ __('messages.home') }}
        </a>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-user-tie"></i>{{ __('admin.employee_manager') }}</a>
            <div class="dash-nav-dropdown-menu">
                <a href="{{ route('admin.users') }}" class="dash-nav-dropdown-item">{{ __('admin.employee_list') }}</a>
                <a href="{{ route('admin.addUsers') }}" class="dash-nav-dropdown-item">{{ __('admin.add_employee') }}</a>
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
                <i class="fas fa-users"></i>{{ __('admin.scoreListbyCategory') }}</a>
            <div class="dash-nav-dropdown-menu">
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 1]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_1') }}</a>
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 2]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_2') }}</a>
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 3]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_3') }}</a>
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 4]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_4') }}</a>
            </div>
        </div>
        <div class="dash-nav-dropdown">
            <a href="javascript::void(0)" class="dash-nav-item dash-nav-dropdown-toggle">
                <i class="fas fa-user"></i></i>{{ __('admin.scoreListByEmployee') }}</a>
            <div class="dash-nav-dropdown-menu">
                <a href="{{ route('admin.scoreListByEmployee', ['department_id' => 1]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_1') }}</a>
                <a href="{{ route('admin.scoreListByEmployee', ['department_id' => 2]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_2') }}</a>
                <a href="{{ route('admin.scoreListByEmployee', ['department_id' => 3]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_3') }}</a>
                <a href="{{ route('admin.scoreListByEmployee', ['department_id' => 4]) }}" class="dash-nav-dropdown-item">{{ __('admin.department_4') }}</a>
            </div>
        </div>
        <a href="{{ route('logout') }}" class="dash-nav-item logout-option">
            <i class="fas fa-sign-out-alt"></i>{{ __('messages.logout') }}
        </a>
    </nav>
</div>
