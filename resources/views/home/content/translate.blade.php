<div class="row">
    <script>
        let tempAnswers = {};
    </script>
    <div class="flex-column align-items-stretch flex-shrink-0 bg-white col-md-3 sidebar-list">
        <div class="align-items-center text-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold">Hạng mục</span>
        </div>
        <div class="list-group list-group-flush border-bottom scrollarea sidebar-items">
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_1"
                data-type="1">
                <div class="w-100">
                    <strong class="mb-1">Dịch vụ</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_2"
                data-type="2">
                <div class="w-100">
                    <strong class="mb-1">Giao tiếp</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_3"
                data-type="3">
                <div class="w-100">
                    <strong class="mb-1">Lãnh đạo và người quản lý</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_4"
                data-type="4">
                <div class="w-100">
                    <strong class="mb-1">Trách nhiệm</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_5"
                data-type="5">
                <div class="w-100">
                    <strong class="mb-1">Hỗ trợ</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_6"
                data-type="6">
                <div class="w-100">
                    <strong class="mb-1">Sự quan tâm đối với công việc</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_7"
                data-type="7">
                <div class="w-100">
                    <strong class="mb-1">Hiệu quả công việc</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_8"
                data-type="8">
                <div class="w-100">
                    <strong class="mb-1">Duy trì trật tự</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_9"
                data-type="9">
                <div class="w-100">
                    <strong class="mb-1">Tính cởi mở, khả năng nhận thức về nhận thức, phát triển bản thân</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_10"
                data-type="10">
                <div class="w-100">
                    <strong class="mb-1">Trật tự</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_11"
                data-type="11">
                <div class="w-100">
                    <strong class="mb-1">Lý trí và quản lý cảm xúc</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_12"
                data-type="12">
                <div class="w-100">
                    <strong class="mb-1">Tình yêu Công ty, quảng cáo</strong>
                </div>
            </button>
            <button class="list-group-item list-group-item-action py-3 lh-tight load-view-btn" id="viewType_13"
                data-type="13">
                <div class="w-100">
                    <strong class="mb-1">Tính chuyên môn trong công việc</strong>
                </div>
            </button>
        </div>
    </div>
    <div class="col-md-9 answer-content" id="answerContent">

    </div>
