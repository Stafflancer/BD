var swiper = new Swiper(".carousel-logos-slider", {
    slidesPerView: 2,
      grid: {
        rows: 2,
      },
      spaceBetween: 22,
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
         renderBullet: function(index, className) {
           return '<span class="' + className + ' swiper-pagination-bullet--svg-animation"><svg width="26" height="26" viewBox="0 0 28 28"><circle class="svg__circle" cx="14" cy="14" r="12" fill="none" stroke-width="2"></circle><circle class="svg__circle-inner" cx="14" cy="14" r="3" stroke-width="0"></circle></svg></span>';
         },
      },
      autoplay: {
        delay: 5500
      },
});

