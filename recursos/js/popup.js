
$(document).ready(function() {
    $('#open').click(function() {
        $('#popup').fadeIn('slow');
        $('body').css('opacity', '0.9');
    });

    $('#close').click(function() {
        $('#popup').fadeOut('slow');
        $('body').css('opacity', '1');
    });
});

