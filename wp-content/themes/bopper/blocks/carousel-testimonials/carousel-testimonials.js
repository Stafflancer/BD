if (jQuery(".testimonials-main").hasClass("testimonials-swiper")) {
    var swiper = new Swiper(".testimonials-swiper", {
        cssMode: true,
        spaceBetween: 0,
        autoplay: {
            delay: 5500
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
         pagination: {
             el: '.swiper-pagination',
             clickable: 'true',
             renderBullet: function(index, className) {
                 return '<span class="' + className + ' swiper-pagination-bullet--svg-animation"><svg width="26" height="26" viewBox="0 0 28 28"><circle class="svg__circle" cx="14" cy="14" r="12" fill="none" stroke-width="2"></circle><circle class="svg__circle-inner" cx="14" cy="14" r="3" stroke-width="0"></circle></svg></span>';
             },
         },
        mousewheel: true,
        keyboard: true,
    });
}

jQuery(document).ready(function($)
{
    $('.video-play-icon').click(function(){
       var dataindex = $(this).attr("video-url");
       $('.bgnw-video').find("source").attr('src', dataindex);
       $(".bgnw-video")[0].load();
       $('.modal-popup').fadeIn(800);
    });
    $('.video-cross-icon').click(function(){
        $('.modal-popup').fadeOut(800);
    });
});