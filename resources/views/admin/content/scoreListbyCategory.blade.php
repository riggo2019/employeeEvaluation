<table id="scoreByCategoryTable" class="display nowrap table-responsive" style="width:100%">
    <thead>
        <th>{{ __('messages.full_name') }}</th>
        @foreach ($employees as $employee)
            <th class="text-center">{{ $employee->full_name }}</th>
        @endforeach
    </thead>
    <tbody>
        <tr>
            <td>{{ __('admin.ranking') }}</td>
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
                <td class="text-center">{{ $ranking ?? __('admin.no_ranking')  }}</td>
            @endforeach
        </tr>
        <tr>
            <td>{{ __('admin.evaluate') }}</td>
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
                <td class="text-center">{{ $grade ?? __('admin.no_evaluate') }}</td>
            @endforeach
        </tr>
        <tr>
            <td>{{ __('admin.average_point') }}</td>
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

<script>
    $(document).ready(function() {
        var locale = '{{ app()->getLocale() }}';
        var languageSettings = {
            'vi': {
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
            },
            'ko': {
                "lengthMenu": "_MENU_ 개의 항목을 표시합니다.",
                "zeroRecords": "데이터가 없습니다.",
                "info": "페이지 _PAGE_ / _PAGES_",
                "infoEmpty": "데이터 없음",
                "infoFiltered": "(전체 _MAX_ 개의 항목 중 필터링됨)",
                "search": "검색:",
                "paginate": {
                    "first": "처음",
                    "last": "끝",
                    "next": "다음",
                    "previous": "이전"
                }
            }
        };
        var selectedLanguage = languageSettings[locale] || languageSettings['vi'];
        $('#scoreByCategoryTable').DataTable({
            "searching": false,
            scrollX: true,
            "info": false,
            "pageLength": 100,
            "paging": false,
            "sort": false,
            "language": selectedLanguage
        });
    });
</script>
