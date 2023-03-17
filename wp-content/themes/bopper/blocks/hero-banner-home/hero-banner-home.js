
if(jQuery(window).width() < 991)
  {
     // change functionality for smaller screens
  } else {
     var tl = new TimelineMax({onUpdate:updatePercentage});
    var controller = new ScrollMagic.Controller();



    tl.from('.hero-banner-home .tag-lines', 1, {y: 300, opacity: 0});
    tl.from('.hero-banner-home .tag-lines .indextagline-1', 1, {y: 200, opacity: 0});
    tl.from('.hero-banner-home .tag-lines .indextagline-2', 1, {y: 200, opacity: 0});
    tl.from('.hero-banner-home .tag-lines .indextagline-3', 1, {y: 200, opacity: 0});
    tl.from('.hero-banner-home .tag-lines .indextagline-4', 1, {y: 100, opacity: 0});
    tl.from('.hero-banner-home .hero-banner-button-arrow', 1, {y: 100, opacity: 0});
  // tl.from('.s-2 img', 1, {y: 50, opacity: 0});
  // tl.from('.s-2 .box', 1, {scale: 0, opacity: 0}, "-=2");


    const scene = new ScrollMagic.Scene({
      triggerElement: ".hero-banner-home",
      triggerHook: "onLeave",
      duration: "100%",
    })
      .setPin(".hero-banner-home")
      .setTween(tl)
        .addTo(controller);

    function updatePercentage() {
      tl.progress();
      console.log(tl.progress());
    }
    jQuery(window).scroll(function(){
      if (jQuery(this).scrollTop() > 50) {
          jQuery('.banner-heading').addClass('fixed');
      } else {
          jQuery('.banner-heading').removeClass('fixed');
      }
  });
  jQuery(document).ready(function() {
    jQuery(".hero-banner-home").removeClass("position-relative");
  });
}



