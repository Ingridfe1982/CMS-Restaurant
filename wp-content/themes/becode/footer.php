
        <div>----------------------------------------</br>DEBUT DE FOOTER.PHP </div>
<section class="big_foot">
<div class="container">
    <!-- beginning of the widget area -->
    <?php if ( is_active_sidebar( 'footer-widget-area1' )|| is_active_sidebar( 'footer-widget-area2' ) || is_active_sidebar( 'footer-widget-area3' ) || is_active_sidebar( 'footer-widget-area4' ) ) : ?>
    <div class="footer_widget">
        <div id="footer-widget-area1" class="footer_widget_1" role="complementary">
        <?php dynamic_sidebar( 'footer-widget-area1' ); ?>
        </div>
        <div id="footer-widget-area2" class="footer_widget_2_3" role="complementary">
        <?php dynamic_sidebar( 'footer-widget-area2' ); ?>
        </div>
        <div id="footer-widget-area3" class="footer_widget_2_3" role="complementary">
        <?php dynamic_sidebar( 'footer-widget-area3' ); ?>
        </div>
        <div id="footer-widget-area4" class="footer_widget_4" role="complementary">
        <?php dynamic_sidebar( 'footer-widget-area4' ); ?>
        </div>
    </div>
    <?php endif; ?>
    <!-- end of the widget area -->


    <footer>
        <p>© 2021 All Rights Reserved. Designed by Devdesign Studio Team 42</p>
    </footer>
</div>
</section>
        <?php wp_footer(); ?>
</body>
</html>