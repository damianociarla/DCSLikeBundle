$(function () {
    $(document).on('click', '.dcs-like-container a:not(.disabled)', function (event) {
        event.preventDefault();
        $(this).addClass('disabled');
        var element = $(this);
        $.get(element.attr('href'), function (data) {
            element.parents('.dcs-like-container').html(data);
        });
    });
});