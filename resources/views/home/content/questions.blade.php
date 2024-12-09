<div class="p-3 ">
    <div class="d-flex justify-content-between align-items-center py-3">
        <h2 class="answer-header">{{ $category_name }}</h2>
        <h2 class="" id="avgPoint"></h2>
    </div>
    <div class="d-flex flex-column gap-3">
        @foreach ($questions as $index => $question)
            <div class="card m-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-11 border-end">
                        <div class="card-body">
                            <h5 class="card-title">Câu hỏi {{ $index + 1 }}</h5>
                            <!-- Hiển thị Câu hỏi 1, Câu hỏi 2,... -->
                            <p class="card-text">{{ $question->question_content }}</p>
                            <!-- Hiển thị nội dung câu hỏi -->
                        </div>
                    </div>
                    <div class="col-md-1">
                        <input type="number" name="answer-{{ $question->id }}" class="form-control point-input text-center"
                            min="0" max="100" style="height: 100%;">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end align-items-center py-3">
        <button class="btn btn-primary" id="nextButton">Tiếp theo</button>
    </div>
</div>
<script>
    $(document).ready(function() {
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

        $('#nextButton').on('click', function () {
            let allFilled = true;

            // Kiểm tra tất cả các ô nhập
            $('.point-input').each(function () {
                const value = $(this).val();
                const parentCard = $(this).closest('.card');
                if (value === '' || isNaN(parseInt(value, 10))) {
                    allFilled = false;
                    parentCard.addClass('error-border');
                } else {
                    parentCard.removeClass('error-border'); 
                }
            });

            if (!allFilled) {
                showToast('Bạn chưa trả lời tất cả câu hỏi', 'danger');
            } else {
                showToast('Tất cả câu hỏi đã được trả lời. Chuyển sang bước tiếp theo.', 'success');
            }
        });
    });
</script>
