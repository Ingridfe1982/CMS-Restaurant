<?php
if ( is_home() ) :
    get_header( 'blog' );
elseif ( is_archive() ) :
    get_header( 'archive' );
elseif ( is_single() ) :
    get_header( 'single' );
else :
    get_header();
?>
<section id="testimonial">
    <div class="testi_txt">
    [sp_testimonial id="438" ]
    </div>
    <div class="testi_img">
        <img src="http://localhost/CMS-Restaurant/wp-content/uploads/2021/01/customers.png">
    </div>
</section>
<div class="hach_bottom_header">
    <!-- background style hachage-->
</div>
<?php get_footer(); ?>