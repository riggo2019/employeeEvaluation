<div class="row">
    <script>
        let tempAnswers = {};
    </script>
    <div class="flex-column align-items-stretch flex-shrink-0 bg-white col-md-3 sidebar-list">
        <div class="align-items-center text-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold">Hạng mục</span>
        </div>
        <div class="list-group list-group-flush border-bottom scrollarea sidebar-items">
            @foreach ($category_list as $category)
                <button 
                    class="list-group-item list-group-item-action py-3 lh-tight load-view-btn"
                    id="viewType_{{ $category['id'] }}" 
                    data-type="{{ $category['id'] }}"
                    onclick="handleClick({{ $category['id'] }})">
                    <div class="w-100">
                        <strong class="mb-1">{{ $category['category_name'] }}</strong>
                    </div>
                    <span class="ms-auto check-icon" id="checkIcon_{{ $category['id'] }}" >
                        <span class="material-icons text-success" style="padding-top: 5px;">check_circle</span>
                    </span>
                </button>
            @endforeach
        </div>
    </div>
    <div class="col-md-9 answer-content" id="answerContent"></div>
</div>