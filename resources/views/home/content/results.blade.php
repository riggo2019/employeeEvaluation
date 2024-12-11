<div class="container">
    <h1>Kết quả</h1>
    <h3>Họ và tên: <span>{{ $user->full_name }}</span></h3>
    <h3>Bộ phận: <span>{{ $user->department_name }}</span></h3>
    <h3>Ngày bắt đầu làm việc: <span>{{  \Carbon\Carbon::parse($user->start_date)->format('d/m/Y') }}</span></h3>

    <table class="table">
        <thead>
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
        <tfoot>
            <tr>
                <td><strong>Trung bình cộng tất cả</strong></td>
                <td><strong>{{ number_format($overallAverage, 2) }}</strong></td>
                <td><strong>{{ $overallEvaluation }}</strong></td>
            </tr>
        </tfoot>
    </table>


</div>
