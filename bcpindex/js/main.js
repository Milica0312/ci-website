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

/*nav*/
$(document).ready(function ($) {
    $.fn.menumaker = function (options) {
        var flexmenu = $(this), settings = $.extend({
                format: 'dropdown',
                sticky: false
            }, options);
        return this.each(function () {
            $(this).find('.button').on('click', function () {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.slideToggle().removeClass('open');
                } else {
                    mainmenu.slideToggle().addClass('open');
                    if (settings.format === 'dropdown') {
                        mainmenu.find('ul').show();
                    }
                }
            });
            flexmenu.find('li ul').parent().addClass('has-sub');
            subToggle = function () {
                flexmenu.find('.has-sub').prepend('<span class="submenu-button"></span>');
                flexmenu.find('.submenu-button').on('click', function () {
                    $(this).toggleClass('submenu-opened');
                    if ($(this).siblings('ul').hasClass('open')) {
                        $(this).siblings('ul').removeClass('open').slideToggle();
                    } else {
                        $(this).siblings('ul').addClass('open').slideToggle();
                    }
                });
            };
            if (settings.format === 'multitoggle')
                subToggle();
            else
                flexmenu.addClass('dropdown');
            if (settings.sticky === true)
                flexmenu.css('position', 'fixed');
            resizeFix = function () {
                var mediasize = 768;
                if ($(window).width() > mediasize) {
                    flexmenu.find('ul').show();
                }
                if ($(window).width() <= mediasize) {
                    flexmenu.find('ul').hide().removeClass('open');
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };

   $('#flexmenu').menumaker({ format: 'multitoggle' });

}(jQuery));


/**/


/*fixing desktop nav*/


    //$('#scrollDiv').hide();
    $(window).scroll(function() {
        if ($(document).scrollTop() > 100) {
          $(".navholder").css({"top": "0", "transition": "0.5s"});
        }
        else {
            $(".navholder").css({"top": "50", "transition": "0.5s"});
        }
    });
