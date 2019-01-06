(function () {
    $('.embed-video').each(function (key, item) {
        var image = new Image();
        var iframe = $(this).html();
        var src = $(iframe).attr('src');
        image.src = $(this).data('image');
        image.alt = $(this).data('title');
        $(this).html(image);
        $(this).on('click', function () {
            $(this).html($(iframe).attr('src', src+'&autoplay=1'));
        });
    });
})(jQuery);
