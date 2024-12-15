<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Kết quả đánh giá</h1>
    </div>

    <!-- User Information -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="card-title">Thông tin nhân viên</h3>
            <hr>
            <div>
                <p><strong>Họ và tên:</strong> <span>{{ $user->full_name }}</span></p>
                <p><strong>Bộ phận:</strong> <span>{{ $user->department_name }}</span></p>
                <p><strong>Ngày bắt đầu làm việc:</strong>
                    <span>{{ \Carbon\Carbon::parse($user->start_date)->format('d/m/Y') }}</span>
                </p>
            </div>
        </div>
    </div>
    <!-- Scores Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title">Chi tiết điểm số</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Danh mục</th>
                            <th>Điểm trung bình</th>
                            <th>Đánh giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scores as $score)
                            <tr>
                                <td>{{ $score['category_name'] }}</td>
                                <td>{{ number_format($score['average_score'], 2) }}</td>
                                <td>{{ $score['evaluation'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td><strong>Trung bình cộng tất cả</strong></td>
                            <td><strong>{{ number_format($overallAverage, 2) }}</strong></td>
                            <td><strong>{{ $overallEvaluation }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
