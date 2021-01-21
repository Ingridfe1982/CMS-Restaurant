jQuery(document).ready(function ($) {

    $('.sp-testimonial-free-section').each(function (index) {
        var tfree_custom_slider_id = $(this).attr('id');
        
        if ( tfree_custom_slider_id != '') {
            jQuery('#' + tfree_custom_slider_id).slick({
                pauseOnFocus: false,
                slidesToScroll: 1,
                prevArrow: "<div class='slick-prev'><i class='fa fa-angle-left'></i></div>",
                nextArrow: "<div class='slick-next'><i class='fa fa-angle-right'></i></div>",
            });
        }
    });
});