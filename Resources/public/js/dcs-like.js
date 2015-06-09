$(function () {
    $(document).on('click', '.dcs-like-container a:not(.disabled)', function (event) {
        event.preventDefault();
        $(this).addClass('disabled');
        var element = $(this);
        $.get(element.attr('href'), function (data) {
            var threadId = element.parents('.dcs-like-container').data('dcs-like-thread-id');
            $('.dcs-like-container[data-dcs-like-thread-id="'+threadId+'"]').html(data);
        });
    });
});