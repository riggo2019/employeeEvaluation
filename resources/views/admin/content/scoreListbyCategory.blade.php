<div class="row">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Danh sách nhân viên</div>
            </div>
            <div class="card-body">
                <table id="scoreByCategoryTable" class="display nowrap table-responsive" style="width:100%">
                    <thead>
                        <th>Họ tên</th>
                        @foreach ($employees as $employee)
                            <th class="text-center">{{ $employee->full_name }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        <tr>
                            <td>Xếp hạng</td>
                            @foreach ($employees as $employee)
                                @php
                                    $ranking = null;
                                @endphp
                                @foreach ($usersWithScores as $score)
                                    @if ($score['user_id'] === $employee->id)
                                        @php
                                            $ranking = $score['ranking'];
                                            break; 
                                        @endphp
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $ranking ?? 'Không xếp hạng' }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Xếp loại</td>
                            @foreach ($employees as $employee)
                                @php
                                    $grade = null;
                                @endphp
                                @foreach ($usersWithScores as $score)
                                    @if ($score['user_id'] === $employee->id)
                                        @php
                                            $grade = $score['grade'];
                                            break; 
                                        @endphp
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $grade ?? 'Không xếp loại' }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Tổng điểm trung bình</td>
                            @foreach ($employees as $employee)
                                @php
                                    $totalAvgScore = null;
                                @endphp
                                @foreach ($usersWithScores as $score)
                                    @if ($score['user_id'] === $employee->id)
                                        @php
                                            $totalAvgScore = $score['totalAvgScore'];
                                            break; 
                                        @endphp
                                    @endif
                                @endforeach
                                <td class="text-center">{{ $totalAvgScore ?? '0' }}</td>
                            @endforeach
                        </tr>
                        @foreach ($category_list as $category)
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                @foreach ($employees as $employee)
                                    <td class="text-center">
                                        @php
                                            $average_score = 0;
                                            if (isset($avgScores[$employee->id])) {
                                                foreach ($avgScores[$employee->id] as $avgScore) {
                                                    if ($avgScore['category_id'] == $category->id) {
                                                        $average_score = $avgScore['average_score'];
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{ $average_score }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#scoreByCategoryTable').DataTable({
            "searching":false,
            scrollX: true,
            "info": false,
            "pageLength": 100,
            "paging": false,
            "sort": false,
            "language": {
                "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
                "zeroRecords": "Không tìm thấy dữ liệu",
                "info": "Hiển thị _PAGE_ / _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ bản ghi)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            }
        });
    });
</script>
