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
<section id="discorver_food">
<div class="container">
    <div class="d_food">    
        <div class="insta_d_food">
            <?php echo do_shortcode('[instagram-feed num=4 cols=2]');?>
        </div>
        <div class="txt_d_food">
            <h2>LET'S DISCOVER FOOD</h2>
            <h1>DISCOVER OUR MENU</h1>
            <div class="text_d_food">
                For those pure food indulgence in mind, come next door and sate your desires with our ever changing internationally ans seasonally inspired small plates. We love food, lots of different food, just like you.
            </div>
            <div class="read_more">
                <a href="http://localhost/CMS-Restaurant/index.php/menu/">View the full Menu</a>
            </div>
        </div>
    </div>
</div>
</section>
<?php get_footer(); ?>