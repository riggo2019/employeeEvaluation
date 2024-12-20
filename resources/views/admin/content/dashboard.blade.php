<h1 class="dash-title">Trang chủ / Đánh giá</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Danh sách đánh giá</div>
            </div>
            <div class="card-body ">
                <div id="datatable_wrapper" class="dataTables_wrapper no-footer">
                    <div class="dataTables_length" id="datatable_length"><label>Hiển thị <select name="datatable_length"
                                aria-controls="datatable" class="">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> dòng</label></div>
                    <div id="datatable_filter" class="dataTables_filter"><label>Tìm kiếm: <input type="search"
                                class="" placeholder="" aria-controls="datatable"></label></div>
                    <table id="datatable" class="cell-border dataTable no-footer" role="grid"
                        aria-describedby="datatable_info">
                        <thead>
                            <tr role="row">
                                <th scope="col" class="sorting_asc" tabindex="0" aria-controls="datatable"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="id: activate to sort column descending" style="width: 52.275px;">id</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="datatable"
                                    rowspan="1" colspan="1"
                                    aria-label="Người bình luận: activate to sort column ascending"
                                    style="width: 251.087px;">Người bình luận</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="datatable"
                                    rowspan="1" colspan="1"
                                    aria-label="Địa chỉ: activate to sort column ascending" style="width: 120.05px;">Địa
                                    chỉ</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="datatable"
                                    rowspan="1" colspan="1"
                                    aria-label="Hình đại diện: activate to sort column ascending"
                                    style="width: 210.4px;">Hình đại diện</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="datatable"
                                    rowspan="1" colspan="1"
                                    aria-label="Nội dung: activate to sort column ascending" style="width: 151.163px;">
                                    Nội dung</th>
                                <th scope="col" class="sorting" tabindex="0" aria-controls="datatable"
                                    rowspan="1" colspan="1"
                                    aria-label="Chức năng: activate to sort column ascending" style="width: 173.425px;">
                                    Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr role="row" class="odd">
                                <td class="sorting_1">id</td>
                                <td>name</td>
                                <td>address</td>
                                <td class="text-center">
                                    <img src="" alt="">
                                </td>
                                <td>content</td>
                                <td class="text-center">
                                    <a href="comment-edit.html" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a data-url="" class="btn btn-danger btn-del-confirm"><i
                                            class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Hiển thị trang 1
                        trên 1 trang</div>
                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"><a
                            class="paginate_button previous disabled" aria-controls="datatable" data-dt-idx="0"
                            tabindex="-1" id="datatable_previous">‹</a><span><a class="paginate_button current"
                                aria-controls="datatable" data-dt-idx="1" tabindex="0">1</a></span><a
                            class="paginate_button next disabled" aria-controls="datatable" data-dt-idx="2"
                            tabindex="-1" id="datatable_next">›</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
