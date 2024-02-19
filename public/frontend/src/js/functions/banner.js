$( document ).ready(function() {
    "use strict";

    // Banner
    var bannerImageDesktop = $('.banner-image.desktop');
    var bannerImageMobile = $('.banner-image.mobile');

    var WindowWidth = $(window).width();

    if (WindowWidth < 767) {
        bannerImageDesktop.hide();
        bannerImageMobile.show();
    } else {
        bannerImageDesktop.show();
        bannerImageMobile.hide();
    }

});