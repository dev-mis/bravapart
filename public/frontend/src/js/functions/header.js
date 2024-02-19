var sections = $('section'), 
    nav = $('nav'), 
    navHeight = nav.outerHeight();

$(window).on('scroll', function () {
    var cur_pos = $(this).scrollTop();
  
    sections.each(function() {
        var top = $(this).offset().top - navHeight,
            bottom = top + $(this).outerHeight();
    
        if (cur_pos >= top && cur_pos <= bottom) {
            nav.find('a').removeClass('active');
            sections.removeClass('active');
      
            $(this).addClass('active');
            nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
        }
    });
});

nav.find('a').on('click', function () {
    var $el = $(this), 
        id = $el.attr('href');
  
    var WindowWidth = $(window).width();

    if (WindowWidth < 767) {
        $('.header-menu').slideToggle("slow");
    }

    $('#toggleMenu').children('.fi-rr-menu-burger').show();
    $('#toggleMenu').children('.fi-rr-cross-small').hide();
    
    $('html, body').animate({
        scrollTop: $(id).offset().top - navHeight + 30
    }, 300);
  
    return false;
});

$('#toggleMenu').on('click', function(){
    $('.header-menu').slideToggle("slow");

    $(this).children('.fi-rr-menu-burger').toggle();
    $(this).children('.fi-rr-cross-small').toggle();
});

// header scroll
$(window).scroll(function () {
        
    var sc = $(window).scrollTop();
    var header = $(".header");

    if (sc > 100) {
        header.addClass("onscroll")
    } else {
        header.removeClass("onscroll")
    }
});