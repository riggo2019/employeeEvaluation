<div class="container py-4">
    <div class="d-flex flex-row justify-content-center gap-3 mb-3">
        @foreach ($departments as $department)
            <a href="{{ route('evaluation_management', ['department_id' => $department->id]) }}" 
               class="btn {{ $selectedDepartmentId == $department->id ? 'btn-primary' : 'btn-secondary'}}">
                {{ $department->department_name }}
            </a>
        @endforeach
    </div>
    <h2 class="text-center mb-4">Đánh Giá Nhân Viên - {{ $selectedDepartment ? 'Khối: '. $selectedDepartment->department_name : 'Tất cả'}}</h2>
    <form action="{{ route('storeAdminScores') }}" method="POST">
        @csrf
        <div class="row border bg-light">
            <div class="col-2 align-self-center text-center p-2">Hạng Mục</div>
            <div class="col-10">
                <div class="row">
                    <div class="col-5 align-self-center border-start border-end text-center p-2">Tiêu chí</div>
                    <div class="col-7">
                        <div class="row p-2">
                            @foreach ($employees as $employee)
                                <div class="col-3 text-center border-end">{{ $employee->full_name }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catrgory_list">
            @foreach ($category_list as $category)
                <div class="row mt-3 border" data-category="{{ $category->id }}">
                    <div class="col-2 align-self-start text-center px-3 pt-1 toggle-category-questions">
                        <p class="mb-0">{{ $category->category_name }}</p>
                        <span class="material-icons border w-100">keyboard_arrow_up</span>
                    </div>
                    <div class="col-10">
                        <div class="question-container">
                            @foreach ($category->questions as $question)
                                <div class="row">
                                    <div class="col-5 d-flex align-items-center border p-3" style="height:150px">
                                        {{ $question->question_content }}</div>
                                    <div class="col-7">
                                        <div class="row" style="height: 100%">
                                            @foreach ($employees as $employee)
                                                <div class="col-3 text-center border-end border-bottom p-2">
                                                    <input type="text" class="text-center point-input"
                                                        style="width:100%;height:100%;"
                                                        name="questionScores[{{ $employee->id }}][{{ $question->id }}]"
                                                        data-category="{{ $category->id }}"
                                                        data-user="{{ $employee->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-5 d-flex align-items-center border" style="height:100px">ĐIỂM TRUNG BÌNH
                                THEO
                                HẠNG MỤC</div>
                            <div class="col-7">
                                <div class="row" style="height: 100%">
                                    @foreach ($employees as $employee)
                                        <div class="col-3 text-center border-end p-2">
                                            <input type="text" class="text-center" style="width:100%;height:100%;"
                                                name="categoryScores[{{ $employee->id }}][{{ $category->id }}]"
                                                readonly>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="text-center w-30 btn btn-primary mt-3"type="submit">Lưu điểm đánh giá</button>
    </form>
</div>
<script>
    var employees = @json($employees);



    $(document).ready(function() {
        $('.toggle-category-questions').on('click', function () {
            $(this).next('.col-10').find('.question-container').toggle();
            var icon = $(this).find('span');
            if (icon.text() === 'keyboard_arrow_up') {
                icon.text('keyboard_arrow_down')
            } else {
                icon.text('keyboard_arrow_up')
            }
        })

        $('.point-input').on('click input', function() {
            if (parseInt($(this).val()) < 0 || parseInt($(this).val()) > 100 || isNaN($(this).val())) {
                $(this).val('');
                showToast('Chỉ cho phép nhập điểm từ 0 tới 100', 'danger');
            }
            let total = 0,
                count = 0;

            $('.point-input').each(function() {
                const value = parseInt($(this).val(), 10);
                if (!isNaN(value)) {
                    total += value;
                    count++;
                }
            });

            const average = count > 0 ? (total / count).toFixed(2) : 0;
            $('#avgPoint').text(`Trung bình: ${average}`);
        });

        $('.point-input').trigger('input');

        // Hàm tính điểm trung bình
        function calculateAverages() {
            // Lặp qua từng category
            $('[data-category]').each(function() {
                const categoryId = $(this).data('category');

                // Lấy các ô input thuộc category hiện tại
                const rows = $(this).find('input[name^="questionScores"]');
                const employeeScores = {};

                // Gom điểm theo từng user
                rows.each(function() {
                    const userId = $(this).data('user');
                    const value = $(this).val().trim(); // Lấy giá trị

                    if (value !== "") {
                        const score = parseFloat(value) || 0;

                        if (!employeeScores[userId]) {
                            employeeScores[userId] = [];
                        }
                        employeeScores[userId].push(score);
                    }
                });

                // Tính trung bình cho từng user
                for (const userId in employeeScores) {
                    const scores = employeeScores[userId];
                    const total = scores.reduce((a, b) => a + b, 0);
                    const average = scores.length > 0 ? (total / scores.length).toFixed(2) : "";

                    // Gán giá trị vào ô input trung bình
                    $(`input[name="categoryScores[${userId}][${categoryId}]"]`).val(average);
                }
            });
        }

        // Gọi hàm khi có thay đổi
        $('form').on('input', 'input[name^="questionScores"]', function() {
            calculateAverages();
        });

        // Tính trung bình ban đầu
        calculateAverages();
    });
</script>
