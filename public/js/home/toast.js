function showToast(message, type = 'info') {
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

    // Cập nhật tiêu đề (nếu cần)
    const title = {
        success: 'Thành công',
        danger: 'Lỗi',
        warning: 'Cảnh báo',
        info: 'Thông báo',
    }[type] || 'Thông báo';

    $toastHeader.find('strong').text(title);
    
    $toast.addClass('animate-slide-in');
    // Hiển thị toast
    const toastInstance = new bootstrap.Toast($toast[0]);
    toastInstance.show();

    $toast.on('hidden.bs.toast', function () {
        $toast.removeClass('animate-slide-in');
    });
}