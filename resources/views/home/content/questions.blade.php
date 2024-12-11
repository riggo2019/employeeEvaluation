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
                            <p class="card-text">{{ $question->question_content }}</p>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <input type="number" name="{{ $question->id }}"
                            class="form-control point-input text-center" min="0" max="100"
                            style="height: 100%;">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between align-items-center py-3">
        <?php if( $viewType > 1 && isset($prevViewType)): ?>
        <button class="btn btn-primary" id="prevButton" data-view-type="{{ $viewType }}"
            data-prev-view-type="{{ $prevViewType }}">Quay lại</button>
        <?php endif; ?>

        <?php if( $viewType < 13 ): ?>
        <button class="btn btn-primary" id="nextButton" data-view-type="{{ $viewType }}"
            data-next-view-type="{{ $nextViewType }}">Tiếp theo</button>
        <?php else: ?>
        <button class="btn btn-primary" id="finalButton" data-view-type="{{ $viewType }}">Hoàn thành</button>
        <?php endif; ?>
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

        $('#nextButton').on('click', function() {
            let allFilled = true;
            // Kiểm tra tất cả các ô nhập
            $('.point-input').each(function() {
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
                return;
            } else {
                var viewType = $(this).data('view-type');
                var nextViewType = $(this).data('next-view-type');
                tempAnswers[viewType] = {};
                $('.point-input').each(function() {
                    const questionId = $(this).attr('name');
                    const value = $(this).val();
                    tempAnswers[viewType][questionId] = value;
                });
                $('.load-view-btn').removeClass('active');
                console.log(tempAnswers)
                $(`#viewType_${nextViewType}`).addClass('active');
                loadView(nextViewType)
            }
        });

        $('#prevButton').on('click', function() {
            var viewType = $(this).data('view-type');
            var prevViewType = $(this).data('prev-view-type');

            tempAnswers[viewType] = {};
            $('.point-input').each(function() {
                const questionId = $(this).attr('name');
                const value = $(this).val();
                tempAnswers[viewType][questionId] = value;
            });

            $('.load-view-btn').removeClass('active');

            $(`#viewType_${prevViewType}`).addClass('active');
            loadView(prevViewType)
        });

        $('#finalButton').on('click', function() {
            var viewType = $(this).data('view-type');
            tempAnswers[viewType] = {};
            $('.point-input').each(function() {
                const questionId = $(this).attr('name');
                const value = $(this).val();
                tempAnswers[viewType][questionId] = value;
            });
            $.ajax({
                url: `${baseUrl}/storeScore`,
                method: 'POST',
                data: {
                    scores: tempAnswers,
                    _token: $('meta[name="csrf-token"]').attr('content'), // Bảo mật CSRF
                },
                success: function(response) {
                    console.log(response);
                    showToast('Đánh giá thành công', 'success');
                    window.location.href = `${baseUrl}/results`; 
                },
                error: function(xhr) {
                    alert('Lỗi khi lưu dữ liệu: ' + xhr.responseText);
                }
            });
        });
    });
</script>
