@if (!$selectedEmployee)
    <div class="">
        <h2>{{ __('admin.no_employee') }}</h2>
    </div>
@else
    <label for="EmployeeList" id="">{{ __('admin.selectEmployee') }}</label>
    <select name="user_id" id="EmployeeList" class="form-select mb-3">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}"
                {{ $selectedUserId && $selectedUserId == $employee->id ? 'selected' : '' }}>
                {{ $employee->full_name }}</option>
        @endforeach
    </select>


    <div class="">
        <h4 class="my-3">{{ __('admin.Employee_info') }}</h4>
        <div class="d-flex flex-row">
            <p>{{ __('messages.full_name') }}: {{ $selectedEmployee->full_name }}</p>
            <a href="{{ route('evaluation_management', ['department_id' => 1]) }}"
                class="nav-link px-4 {{ $content == 'home.content.evaluation_management' ? 'link-primary fw-bold' : 'link-primary' }}">{{ __('messages.evaluation_management') }}</a>

        </div>

        <p>{{ __('messages.department') }}: {{ $selectedEmployee->department_name }}</p>
        <p>{{ __('admin.start_date') }}: {{ $selectedEmployee->formatted_start_date }}</p>
    </div>


    <div class="nav mb-4 border-bottom">
        <button class="nav-link active tab" data-tab="tab1">{{ __('admin.scoreListByEmployee_tab1') }}</button>
        <button class="nav-link tab" data-tab="tab2">{{ __('admin.scoreListByEmployee_tab2') }}</button>
    </div>

    <div id="tab1" class="container">
        <h3 class="my-3">{{ __('admin.scoreListByEmployee_tab1') }}</h3>
        <table id="scoreListByEmployee" class="display table-responsive" style="width:100%">
            <thead>
                <th>{{ __('admin.index') }}</th>
                <th>{{ __('messages.category') }}</th>
                <th>{{ __('messages.question') }}</th>
                <th>{{ __('admin.user_score') }}</th>
                <th>{{ __('admin.admin_score') }}</th>
            </thead>
            <tbody>
                @php
                    $questionIndex = 1; // Khởi tạo số thứ tự câu hỏi
                @endphp
                @foreach ($category_list as $category)
                    @foreach ($category->questions as $index => $question)
                        <tr>
                            @if ($index == 0)
                                <td class="text-center" rowspan="{{ count($category->questions) }}">
                                    {{ $questionIndex++ }}</td>
                                <td rowspan="{{ count($category->questions) }}">
                                    {{ $category->category_name }}
                                </td>
                            @endif

                            <td>{{ $question->question_content }}</td>
                            </td>
                            <td class="text-center">
                                @foreach ($selectedEmployee->admin_question_scores as $adminScore)
                                    @if ($adminScore->question_id == $question->id)
                                        {{ number_format($adminScore->score, 2) }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach ($selectedEmployee->user_question_scores as $userScore)
                                    @if ($userScore->question_id == $question->id)
                                        {{ number_format($userScore->score, 2) }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="tab2" class="container" style="display:none;">
        <h2 class="my-3">{{ __('admin.scoreListByEmployee_tab2') }}</h2>
        <div class="d-flex flex-row gap-3">
            <table id="chartList" class="display table-responsive" style="width:100%">
                <thead>
                    <th>{{ __('messages.full_name') }}</th>
                    <th class="text-center">{{ $selectedEmployee->full_name }}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ __('admin.ranking') }}</td>
                        <td>{{ $selectedEmployee->rank }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('admin.evaluate') }}</td>
                        <td>{{ $selectedEmployee->grade }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('admin.average_point') }}</td>
                        <td>{{ round($selectedEmployee->final_average_score, 2) }}</td>
                    </tr>
                    @foreach ($category_list as $category)
                        @foreach ($selectedEmployee->final_average_scores as $categoryId => $score)
                            @if ($categoryId == $category->id)
                                <!-- Kiểm tra nếu category_id khớp -->
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ number_format($score, 2) }}</td>
                                    <!-- Làm tròn điểm trung bình thành 2 chữ số -->
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div style="width: 65%; overflow-x: auto;">
                <canvas id="categoryChart"></canvas> <!-- Vị trí để hiển thị biểu đồ -->
            </div>
        </div>
    </div>
@endif
<script>
    $(document).ready(function() {
        var department_id =
            '{{ $selectedDepartmentId }}'; // Nhúng giá trị department_id từ Blade vào JavaScript
        $('#EmployeeList').on('change', function() {
            var user_id = $(this).val();
            window.location.href =
                "{{ route('admin.scoreListByEmployee', ['department_id' => '__department_id__']) }}"
                .replace('__department_id__', department_id) + '?user_id=' + user_id;
        });
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
        $('.tab').on('click', function() {
            var tab = $(this).data('tab');
            console.log(tab)

            $('.container').hide();

            $('.tab').removeClass('active');

            if (tab == 'tab1') {
                $(`#tab1`).show();
                if ($.fn.dataTable.isDataTable('#scoreListByEmployee')) {
                    $('#scoreListByEmployee').DataTable().destroy();
                }

                // Khởi tạo lại DataTable
                $('#scoreListByEmployee').DataTable({
                    "searching": false,
                    scrollX: true,
                    "info": false,
                    "pageLength": 100,
                    "paging": false,
                    "sort": false,
                    "language": selectedLanguage
                });
            } else if (tab == 'tab2') {
                $(`#tab2`).show();
                // Hủy khởi tạo DataTable nếu nó đã được khởi tạo trước đó
                if ($.fn.dataTable.isDataTable('#chartList')) {
                    $('#chartList').DataTable().destroy();
                }

                // Khởi tạo lại DataTable
                $('#chartList').DataTable({
                    "searching": false,
                    scrollX: true,
                    "info": false,
                    "pageLength": 100,
                    "paging": false,
                    "sort": false,
                    "language": selectedLanguage
                });
            }

            $(this).addClass('active');

        });

        var selectedLanguage = languageSettings[locale] || languageSettings['vi'];
        $('#chartList').DataTable({
            "searching": false,
            scrollX: true,
            "info": false,
            "pageLength": 100,
            "paging": false,
            "sort": false,
            "language": selectedLanguage
        });

        $('#scoreListByEmployee').DataTable({
            "searching": false,
            scrollX: true,
            "info": false,
            "pageLength": 100,
            "paging": false,
            "sort": false,
            "language": selectedLanguage
        });




    });

    // Dữ liệu điểm số của từng category
    var categories = @json($category_list->pluck('category_name')); // Lấy danh sách tên categories
    var scores = @json(
        $category_list->map(function ($category) use ($selectedEmployee) {
            return $selectedEmployee->final_average_scores[$category->id] ?? 0; // Điểm của nhân viên theo từng category
        }));

    // Vẽ biểu đồ
    var ctx = document.getElementById('categoryChart').getContext('2d');
    var categoryChart = new Chart(ctx, {
        type: 'bar', // Biểu đồ dạng thanh
        data: {
            labels: categories, // Các danh mục (categories)
            datasets: [{
                label: '{{ __('admin.category_score') }}', // Tiêu đề của biểu đồ
                data: scores, // Dữ liệu điểm số của các categories
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Màu nền của các thanh
                borderColor: 'rgba(54, 162, 235, 1)', // Màu viền của các thanh
                borderWidth: 1, // Độ dày viền của các thanh
                datalabels: {
                    display: true, // Bật hiển thị
                    align: 'top', // Đặt nhãn ở phía trên đầu thanh
                    anchor: 'end', // Căn nhãn vào cuối thanh
                    formatter: function(value) {
                        return value.toFixed(2); // Hiển thị giá trị với 2 chữ số thập phân
                    },
                    font: {
                        weight: 'bold', // Định dạng chữ đậm
                        size: 14 // Kích thước chữ
                    },
                    color: 'black', // Màu chữ
                }
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', // Vị trí legend
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw.toFixed(2); // Hiển thị điểm với 2 chữ số thập phân
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Y bắt đầu từ 0
                    ticks: {
                        stepSize: 1, // Bước nhảy của trục Y
                    }
                }
            }
        }
    });
</script>
