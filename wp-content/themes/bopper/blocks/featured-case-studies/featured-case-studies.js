jQuery(document).ready(function($)
{
    let id_stats = [];
   
    jQuery( ".case-studies-item .stats-row .stats-item" ).each(function( index ) {
       
        var ids = $(this).find('.prefix').find('.odometernew').attr('id');
        var stats = $(this).find('.prefix').find('.odometernew').attr('data-value');
        id_stats[ids] = stats;
    });

    var a = 0;
    $(window).scroll(function() 
    {
        var oTop = $('.stats-item').offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
            for (var key in id_stats) {
                var num = id_stats[key];
                const od = new Odometer({
                    el: document.getElementById(key),
                    format: "(,ddd).dd",
                    duration: 3000,
                    theme: "default"
                });
                od.render();
                // Initial Animation
                od.update(num);
            }
            a = 1;
        }
    });

});
