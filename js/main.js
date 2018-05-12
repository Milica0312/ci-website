/*accordions*/
(function($) {

    $('.accordion a').click(function(j) {
        var dropDown = $(this).closest('li').find('p');

        $(this).closest('.accordion').find('p').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery);
/**/
/*news*/
$(window).load(function() {
  $('.post-module').hover(function() {
    $(this).find('.description').stop().animate({
      height: "toggle",
      opacity: "toggle"
    }, 300);
  });
});


/**/
/**/

$(window).scroll(function() {

    //After scrolling 100px from the top...
    if ( $(window).scrollTop() >= 100 ) {
        //  $('#logo').css('display', 'none');
        $('.navholder').css('background-color', 'white');
        $('.navholder nav a').css('color', 'red');
    //Otherwise remove inline styles and thereby revert to original stying
    } else {
        $('.navholder').attr('style', '');
        $('.navholder nav a').attr('style', '');
    }
});/**/
