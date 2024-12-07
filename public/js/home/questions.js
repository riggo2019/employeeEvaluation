$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    var firstButton = $('.load-view-btn').first();
    firstButton.addClass('active');

    var viewType = firstButton.data('type');

    $.ajax({
        url: `${baseUrl}/loadView`,
        method: 'POST',
        data: { viewType: viewType },
        success: function (response) {
            if (response.status) {
                $('#answerContent').html(response.html);
            } else {
                alert('Failed to load view: ' + response.message);
            }
        },
        error: function (xhr) {
            alert('Error: ' + xhr.status + ' ' + xhr.statusText);
        }
    });

    $('.load-view-btn').click(function () {
        var viewType = $(this).data('type');

        $('.load-view-btn').removeClass('active');
        $(this).addClass('active');

        $.ajax({
            url: `${baseUrl}/loadView`,
            method: 'POST',
            data: { viewType: viewType },
            success: function (response) {
                if (response.status) {
                    $('#answerContent').html(response.html);
                    console.log('thanh cong');
                } else {
                    alert('Failed to load view: ' + response.message);
                }
            },
            error: function (xhr) {
                alert('Error: ' + xhr.status + ' ' + xhr.statusText);
            }
        });
    });
});