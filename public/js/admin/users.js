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

// Sử dụng cài đặt ngôn ngữ tương ứng với locale của ứng dụng
var selectedLanguage = languageSettings[locale] || languageSettings['vi']; // fallback to Vietnamese if no match

$(document).ready(function () {
    $('#usersTable').DataTable({
        "info": false,
        "pageLength": 5,
        "language": selectedLanguage
    });
});
