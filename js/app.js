$(function() {
    
    $('#javascript').html('enabled');

    $('#screen_resolution').html(screen.width + ' x ' + screen.height);

    $('#browser_size').html(window.innerWidth + ' x ' + window.innerHeight);

    $(window).resize(function() {
        $('#browser_size').html(window.innerWidth + ' x ' + window.innerHeight);
        $('#screen_resolution').html(screen.width + ' x ' + screen.height);
    });

});
