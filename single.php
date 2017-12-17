<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Marinara_Blog
 */
get_header();
$featImgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div id="inside-page-content-wrapper" class="single-post-content-wrapper-row content-wrapper-row row">
	<?php if ($featImgURL): ?>
	    <div id="inside-page-featured-img-wrapper" class="container">
	        <div class="feat-img-inner-wrapper row">
	            <img src="<?php echo $featImgURL; ?>" alt="<?php the_title(); ?> Featured Image" class="feat-img">
	            <div class="feat-img-caption-title">
	                <h2><?php the_title(); ?></h2>
	            </div>
	        </div>
	    </div>
	<?php else: ?>
	    <div id="inside-page-no-featured-img-wrapper" class="container">
	        <div class="no-feat-img-inner-wrapper row">
	            <div class="no-feat-img-caption-title">
	                <h2><?php the_title(); ?></h2>
	            </div>
	       	</div>
	    </div>
	<?php endif; ?>
	<div class="inside-page-container single-post-container container">
		<div class="breadcrumb-row sm-row clearfix grey-bg">
			<div class="breadcrumb-col col-xs-12 col-sm-6">
				<?php echo marinara_blog_breadcrumb(); ?>
			</div>
			<div class="social-shares-col col-xs-12 col-sm-6 grey-bg">
				<?php echo marinara_blog_social_shares_buttons(); ?>
			</div>
		</div>
		<div class="single-post-types-tab-col col-xs-12 col-md-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'single' ); ?>
				<?php // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>
				<div class="clearfix"></div>
				<?php the_post_navigation(); ?>
			<?php endwhile; // End of the loop. ?>
		</div><!-- end of <div class="single-post-types-tab-col -->
		<div class="sinlge-additional-options-col col-xs-12 col-md-4">
			<?php dynamic_sidebar('single-sidebar-widget'); ?>
		</div><!-- end of <div class="sinlge-additional-options-col -->
	</div>
	<div class="inside-page-footer-container single-post-footer-container container">
		<?php get_template_part( 'inside', 'page-container-footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->
<script type="text/javascript">
jQuery(document).ready(function(){
	/* Modifying underscrore_s post navigation function */
	jQuery('.post-navigation .nav-previous').addClass('col-xs-6 text-left').prepend('<i class="fa fa-angle-double-left fuscia-clr"></i> ');
	jQuery('.post-navigation .nav-next').addClass('col-xs-6 text-right').append(' <i class="fa fa-angle-double-right fuscia-clr"></i>');
});
</script>
<?php get_footer(); ?>