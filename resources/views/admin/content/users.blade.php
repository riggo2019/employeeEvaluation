<div class="row">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Danh sách nhân viên</div>
            </div>
            <div class="card-body ">
                <table id="usersTable" class="">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên nhân viên</th>
                            <th>Bộ phận</th>
                            <th>Tên đăng nhập</th>
                            <th>Quyền</th>
                            <th>Ngày bắt đầu làm việc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->department_name }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->is_admin == 0 ? 'Nhân viên' : 'Quản lý' }}</td>
                            <td>{{ $user->formatted_start_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
