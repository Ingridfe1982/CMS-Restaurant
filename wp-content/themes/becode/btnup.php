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
        <script src="http://localhost/CMS-Restaurant/script/upbutton.js"></script>
</body>
</html>