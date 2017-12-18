<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Marinara_Blog
 */
get_header();
$feat_img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div id="inside-page-content-wrapper" class="page-content-wrapper-row content-wrapper-row row">
	<?php if ($feat_img_url): ?>
	    <div id="inside-page-featured-img-wrapper" class="container">
	        <div class="feat-img-inner-wrapper row">
	            <img src="<?php echo $feat_img_url; ?>" alt="<?php the_title(); ?> Featured Image" class="feat-img">
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
	<div class="inside-page-container page-container container">
		<div class="breadcrumb-row sm-row clearfix grey-bg">
			<div class="breadcrumb-col col-xs-12 col-sm-6">
				<?php echo marinara_blog_breadcrumb(); ?>
			</div>
			<div class="social-shares-col col-xs-12 col-sm-6 grey-bg">
				<?php echo marinara_blog_social_shares_buttons(); ?>
			</div>
		</div>
		<div class="page-content-col col-xs-12">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
		</div><!-- end of <div class="page-content-col -->
	</div>
	<div class="inside-page-footer-container page-footer-container container">
		<?php get_template_part( 'inside', 'page-container-footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->
<?php get_footer(); ?>