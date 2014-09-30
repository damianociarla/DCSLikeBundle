$(function () {
    $(document).on('click', '.dcs-like-container a', function (event) {
        event.preventDefault();
        var element = $(this);
        $.get(element.attr('href'), function (data) {
            element.parent('.dcs-like-container').html(data);
        });
    });
});