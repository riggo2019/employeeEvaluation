<div class="p-3 ">
    <h2 class="p-3 pb-5 answer-header">{{ $category_name }}</h2>
    <div class="d-flex flex-column gap-3">
        @foreach($questions as $index => $question)
        <div class="card m-0 mb-3">
            <div class="row g-0">
                <div class="col-md-11 border-end">
                    <div class="card-body">
                        <h5 class="card-title">Câu hỏi {{ $index + 1 }}</h5> <!-- Hiển thị Câu hỏi 1, Câu hỏi 2,... -->
                        <p class="card-text">{{ $question->question_content }}</p> <!-- Hiển thị nội dung câu hỏi -->
                    </div>
                </div>
                <div class="col-md-1">
                    <input type="number" 
                           name="answer-{{ $question->id }}"  
                           class="form-control text-center" 
                           min="0" 
                           max="100" 
                           style="height: 100%;" 
                           oninput="validateInput(this)">
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
<script>
    function validateInput(input) {
        const value = parseInt(input.value, 10);

        if (value < 0 || value > 100) {
            input.value = '';
            showToast('Chỉ cho phép nhập điểm từ 1 tới 100','danger')
        }
    }
</script>