jQuery(document).ready(function($) 
{
      $('.panel-heading').click(function(e) {
       $(this).parent('.pannel-tab').siblings().children('.panel-content').slideUp(); 
       $(this).parent('.pannel-tab').siblings().children('.panel-heading').removeClass('open');
       $(this).parent('.pannel-tab').siblings().removeClass('faq-toggle');
       $(this).toggleClass('open');
       $(this).parent('.pannel-tab').addClass('faq-toggle');
       $(this).next('.panel-content').slideToggle();
      });
});