<?php
if ( is_home() ) :
    get_header( 'blog' );
elseif ( is_archive() ) :
    get_header( 'archive' );
elseif ( is_single() ) :
    get_header( 'single' );
else :
    get_header();
endif;
?>
<section class="d_food">
<div class="container">
    <div class="insta_d_food"></div>
    <div class="txt_d_food"></div>
</di>
</section>
<?php get_footer(); ?>