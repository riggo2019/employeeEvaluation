
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Load view đầu tiên
    var firstButton = $('.load-view-btn').first();
    firstButton.addClass('active');
    loadView(1);

    

    $('.load-view-btn').click(function () {
        var viewType = $(this).data('type');

        $('.load-view-btn').removeClass('active');
        $(this).addClass('active');

        loadView(viewType)
    });
    
});

function loadView(viewType) {
    $.ajax({
        url: `${baseUrl}/loadView`,
        method: 'POST',
        data: { viewType: viewType },
        success: function (response) {
            if (response.status) {
                $('#answerContent').html(response.html);
                // Phục hồi dữ liệu đã lưu
                if (tempAnswers[viewType]) {
                    for (const [key, value] of Object.entries(tempAnswers[viewType])) {
                        $(`input[name="${key}"]`).val(value);
                    }
                }
                console.log('View loaded successfully');
                $('html, body').animate({ scrollTop: 0 });
            } else {
                alert('Failed to load view: ' + response.message);
            }
        },
        error: function (xhr) {
            alert('Error: ' + xhr.status + ' ' + xhr.statusText);
        }
    });
    const maxViewType = Math.max(...Object.keys(tempAnswers).map(Number)) || 0;

    $(".load-view-btn").each(function () {
        const viewType = $(this).data("type");

        if (tempAnswers[viewType]) {
            $(`#checkIcon_${viewType}`).show();
            $(this).prop("disabled", false);
        } else if (viewType === maxViewType + 1) {
            $(`#checkIcon_${viewType}`).hide();
            $(this).prop("disabled", false);
        } else {
            $(this).prop("disabled", true);
            $(`#checkIcon_${viewType}`).hide();
        }
    });
}

