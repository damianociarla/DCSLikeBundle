$(function () {
    $('.dcs-like-container a').click(function (event) {
        event.preventDefault();
        var element = $(this);
        $.get(element.attr('href'), function (data) {
            element.parent('.dcs-like-container').html(data);
        });
    });
});