$(document).ready(function () {
    $('.toggle-admin-option').click(function () {
        const groupItems = $(this).next('.group-items');

        if (groupItems.hasClass('active')) {
            groupItems.removeClass('active'); 
        } else {
            groupItems.addClass('active'); 
        }
    });
});
