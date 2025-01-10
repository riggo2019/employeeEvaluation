<div class="container-fluid">
    <div class="d-flex flex-column justify-content-start gap-4">
        <h1 class="fs-3">Quản lý đánh giá nhân viên</h1>
        <p>Chào mừng {{ Auth::user()->last_name }}!</p>
        <div class="mb-3 d-flex flex-row align-items-center">
            <button class="toggle-admin-option w-25 btn btn-primary p-3">Quản lý nhân viên</button>
            <div class="group-items ms-2">
                <a href="{{ route('admin.users') }}" class="btn btn-primary p-3 w-20 text-white">Danh sách nhân viên</a>
                <a href="{{ route('admin.addUsers') }}" class="btn btn-primary p-3 w-20 text-white">Thêm mới nhân viên</a>
            </div>
        </div>
        <div class="mb-3 d-flex flex-row align-items-center">
            <button class="toggle-admin-option w-25 btn btn-success p-3">Tổng hợp bộ phận</button>
            <div class="group-items ms-2">
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Lễ Tân</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Điều dưỡng</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Kỹ thuật viên</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Khối hành chính</a>
            </div>
        </div>
        <div class="mb-3 d-flex flex-row align-items-center">
            <button class="toggle-admin-option w-25 btn btn-warning p-3">Báo cáo đánh giá</button>
            <div class="group-items ms-2">
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Lễ Tân</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Điều dưỡng</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Kỹ thuật viên</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">Khối hành chính</a>
            </div>
        </div>
    </div>
</div>
