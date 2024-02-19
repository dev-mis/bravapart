$('.slider-how-to').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    responsive: [
        {
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                variableWidth: true,
                infinite: false,
                dots: true
            }
        },
        {
            breakpoint: 664,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                variableWidth: true,
                infinite: false,
                dots: true
            }
        },
    ]
});

$('.slider-testimonial').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    nextArrow: '<button type="button" class="slick-next"><i class="fi fi-rr-angle-small-right"></i></button>',
    prevArrow: '<button type="button" class="slick-prev"><i class="fi fi-rr-angle-small-left"></i></button>',
    dots: true,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                dots: false,
            }
        },
    ]
});