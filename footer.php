<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the .container-fluid div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Marinara_Blog
 */
?>
  <!-- Footer Modal To Be Used Dynamically -->
  <div id="dynamicFooterModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x white-clr"></i></button>
          <h3 class="modal-title text-center white-clr">Modal Heading</h3>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
  </div>
  <!-- End Footer Modal -->
</div><!-- end of <div class="container-fluid"> -->
<?php wp_footer(); ?>
</body>
</html>
