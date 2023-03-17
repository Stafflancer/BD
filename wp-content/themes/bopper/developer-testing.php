<?php /* Template Name: Developer Testing */
get_header(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<style type="text/css">


.s-2 {
  position: relative;
  height:100vh;
  background-color: rgba(221, 221, 221, 0.2);
}
.s-2-inner,
.banner-heading {
  width: 100%;
  position: absolute;
  left: 50%;
  max-width: 1256px;
  top: 50%;
  text-align: center;
  transform: translate(-50%, -50%);
  color: #fff;
}
.banner-heading h1{
    font-size: 80px;
    line-height: 70px;
}
.banner-heading.fixed h1{
    -webkit-animation: goDown2 1s ease-in-out forwards;
    animation: goDown2 1s ease-in-out forwards;
}
.banner-heading.fixed{
    -webkit-animation: goDown1 1s ease-in-out forwards;
    animation: goDown1 1s ease-in-out forwards;
}
@keyframes goDown1 {
  0% {
    top: 50%;
  }
  100% {
    top: 173px;
  }
}
@keyframes goDown2 {
  0% {
    font-size: 80px;
    line-height: 70px;
  }
  100% {
    font-size: 24px;
    line-height: 40px;
  }
}
.s-2-inner-2{
  width: 100%;
  position: absolute;
  left: 50%;
  max-width: 1256px;
  top: 80%;
  text-align: center;
  transform: translate(-50%, -50%);
}
figure.video-background {
    padding: 56.25% 0 0 0;
}
figure.video-background iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
}

  </style>
</head>

<body>



  <section class="s-2">
    <figure class="video-background d-block h-auto w-100 h-100 object-cover m-0 position-absolute top-0 bottom-0 start-0 end-0 object-top z-0">
        <iframe loading="lazy" title="Bop Design: The B2B Marketing Agency" src="https://player.vimeo.com/video/797824456?h=52b55042de&amp;dnt=1&amp;app_id=122963&amp;controls=0&amp;muted=1&amp;hd=1&amp;autoplay=1&amp;loop=1" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>      </figure>
                <div class="banner-heading">
                  <h1>The B2B Marketing Agency</h1>
                </div>
              <div class="s-2-inner">
                 <div class="head1 f-44">My powerfull animation with GSAP</div>
                   <div class="head2 f-44">My powerfull animation with GSAP</div>
                <div class="head3 f-44">My powerfull animation with GSAP</div>
                <div class="head4 f-44">My powerfull animation with GSAP</div>
            </div>
              <div class="s-2-inner-2">
                  <a href="#" class="button">Watch me</a>
              </div>
  </section>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script><!-- 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TimelineMax.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/plugins/animation.gsap.min.js"></script>

<script type="text/javascript">
  var tl = new TimelineMax({onUpdate:updatePercentage});
  var controller = new ScrollMagic.Controller();


    tl.from('.s-2-inner', 1, {y: 300, opacity: 0});
    tl.from('.s-2-inner-2', 1, {y: 300, opacity: 0});
    tl.from('.s-2-inner .head1', 1, {y: 200, opacity: 0});
    tl.from('.s-2-inner .head2', 1, {y: 200, opacity: 0});
    tl.from('.s-2-inner .head3', 1, {y: 200, opacity: 0});
    tl.from('.s-2-inner .head4', 1, {y: 100, opacity: 0});
    tl.from('.s-2-inner-2 a', 1, {y: 100, opacity: 0});
  // tl.from('.s-2 img', 1, {y: 50, opacity: 0});
  // tl.from('.s-2 .box', 1, {scale: 0, opacity: 0}, "-=2");


  const scene = new ScrollMagic.Scene({
    triggerElement: ".s-2",
    triggerHook: "onLeave",
    duration: "100%",
  })
    .setPin(".s-2")
    .setTween(tl)
      .addTo(controller);

  function updatePercentage() {
    tl.progress();
    console.log(tl.progress());
  }


  jQuery(window).scroll(function(){
      if (jQuery(this).scrollTop() > 250) {
          jQuery('.banner-heading').addClass('fixed');
      } else {
          jQuery('.banner-heading').removeClass('fixed');
      }
});
</script>
</body>

</html>
<?php
get_footer(); ?>