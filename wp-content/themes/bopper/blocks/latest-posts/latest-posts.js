var swiper = new Swiper(".mySwiper", {
    scrollbar: {
        el: ".swiper-scrollbar",
        draggable: true,
        hide: true,
    },
    autoplay: {
        delay: 5500
    },
    spaceBetween: 30,
    watchSlidesProgress: true,
	breakpoints: {
	1024: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
	  768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
	  320: {
        slidesPerView: 1,
        spaceBetween: 20,
      }
	},
    slidesPerView: 3,
});