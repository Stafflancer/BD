jQuery(document).ready(function($) 
{
     $('.faqs-panel-heading').click(function(e) {
       $(this).parent('.faqs-pannel-tab').siblings().children('.faqs-panel-content').slideUp(); 
       $(this).parent('.faqs-pannel-tab').siblings().children('.faqs-panel-heading').removeClass('open');
       $(this).parent('.faqs-pannel-tab').siblings().removeClass('faq-toggle');
       $(this).toggleClass('open');
       $(this).parent('.faqs-pannel-tab').addClass('faq-toggle');
       $(this).next('.faqs-panel-content').slideToggle();
    });
});