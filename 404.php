<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Marinara_Blog
 */
get_header();
?>
<div id="inside-page-content-wrapper" class="page-not-found-page-content-wrapper-row content-wrapper-row row">
    <div id="inside-page-no-featured-img-wrapper" class="container">
        <div class="no-feat-img-inner-wrapper row">
            <div class="no-feat-img-caption-title">
				<h2>404 Error - Page Not Found</h2>
            </div>
       	</div>
    </div>
	<div class="inside-page-container index-page-container container">
		<div class="page-content-col col-xs-12 text-center">
			<h3><?php esc_html_e( 'Nothing was found at this location. Try something else.', 'marinara-blog' ); ?></h3>
		</div><!-- end of <div class="page-content-col -->
	</div>
	<div class="inside-page-footer-container page-not-found-page-footer-container container">
		<?php get_template_part( 'inside_page_container', 'footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->
<?php get_footer(); ?>
