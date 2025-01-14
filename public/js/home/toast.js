function showToast(message, type = 'info', locale = 'vi') {
    // Tìm phần tử Toast
    const $toast = $('#customToast');
    const $toastHeader = $toast.find('.toast-header');
    const $toastBody = $toast.find('.toast-body');

    // Cập nhật nội dung thông báo
    $toastBody.text(message);
    $toastBody.addClass('text-white');

    // Cập nhật kiểu thông báo (thay đổi màu nền)
    const toastClasses = ['bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-primary'];
    $toast.removeClass(toastClasses.join(' ')).addClass(`bg-${type}`);

    // Định nghĩa tiêu đề theo từng ngôn ngữ
    const titles = {
        vi: {
            success: 'Thành công',
            danger: 'Lỗi',
            warning: 'Cảnh báo',
            info: 'Thông báo',
        },
        ko: {
            success: '성공',
            danger: '오류',
            warning: '경고',
            info: '알림',
        }
    };

    // Lấy tiêu đề phù hợp với loại và ngôn ngữ
    const title = titles[locale]?.[type] || titles[locale]?.info || 'Thông báo';

    // Cập nhật tiêu đề
    $toastHeader.find('strong').text(title);

    $toast.addClass('animate-slide-in');
    // Hiển thị toast
    const toastInstance = new bootstrap.Toast($toast[0]);
    toastInstance.show();

    $toast.on('hidden.bs.toast', function () {
        $toast.removeClass('animate-slide-in');
    });
}
