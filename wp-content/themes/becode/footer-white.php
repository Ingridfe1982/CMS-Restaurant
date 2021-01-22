<section class="big_foot">
<div class="container">
    <!-- beginning of the NEWSLETTER area -->
    <div class="news_content">
        <div class="news_title">Join our<br> newsletter</div>
        <?php if ( is_active_sidebar( 'footer-widget-area5' ) ) : ?>
        <div id="footer-widget-area5" class="news_form" role="complementary"><?php dynamic_sidebar( 'footer-widget-area5' ); ?></div>
        <?php endif; ?>
    </div>
    <!-- beginning of the WIDGET FOOTER area -->
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
  <script>
    // button up
    document.addEventListener('DOMContentLoaded', function() {
       window.onscroll = function(ev) {
       document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" : "cInvisible";
       };
    });
  </script>
        <?php wp_footer(); ?>
</body>
</html>