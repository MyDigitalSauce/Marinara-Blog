<?php
/**
 * Template Name: Home
 *
 * This is a custom template for the home page.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package marinara_blog
 */
get_header();
$featImgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$the_excerpt = get_the_excerpt();
if ( $the_excerpt == '' ) {
	$the_excerpt = get_option('marinara_blog_input_site_description');
}
$enableAuthorTab = get_theme_mod('enable_author_tab'); ?>
<div id="inside-page-content-wrapper" class="home-page-content-wrapper-row content-wrapper-row row">
	<?php if ($featImgURL): ?>
	    <div id="inside-page-featured-img-wrapper" class="container">
	        <div class="feat-img-inner-wrapper row">
	            <img src="<?php echo $featImgURL; ?>" alt="<?php the_title(); ?> Featured Image" class="feat-img">
	            <div class="feat-img-caption-title">
	                <h2><?php bloginfo('name'); ?></h2>
	            </div>
	            <?php if ($the_excerpt): ?>
		            <div class="feat-img-caption-description">
		                <h3 class="" style="margin-bottom: 0;"><?php echo $the_excerpt; ?></h3>
		            </div>
		        <?php endif; ?>
	        </div>
	    </div>
	<?php else: ?>
	    <div id="inside-page-no-featured-img-wrapper" class="container">
	        <div class="no-feat-img-inner-wrapper row">
	            <div class="no-feat-img-caption-title">
	                 <h2><?php bloginfo('name'); ?></h2>
	            </div>
	       	</div>
	    </div>
	<?php endif; ?>
	<div class="inside-page-container home-page-container container">
		<div class="content-col col-xs-12">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</div>
		<div class="tabs-col col-xs-12 col-sm-8">

			<?php if ($enableAuthorTab) { ?>
				<ul class="single-post-types-nav-tabs nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#blog" aria-controls="blog" role="tab" data-toggle="tab"><?php _e( 'Blog', 'marinara_blog' ); ?></a></li>
					<li role="presentation"><a href="#authors" aria-controls="authors" role="tab" data-toggle="tab"><?php _e( 'Authors', 'marinara_blog' ); ?></a></li>
				</ul>
				<div class="single-post-types-tab-content tab-content">
					<div role="tabpanel" class="tab-pane active" id="blog">
			<?php } ?>

				<?php get_template_part('template-parts/content', 'home-blog-post-listing'); ?>

			<?php if ($enableAuthorTab) { ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="authors">
						<?php echo do_shortcode('[authors]'); ?>
					</div>
				</div>
			<?php } ?>

		</div><!-- end of <div class=tabs-col -->
		<div class="page-sidebar-col col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div><!-- end of <div class="page-sidebar-col -->
	</div>
	<div class="inside-page-footer-container home-page-footer-container container">
		<?php get_template_part( 'inside', 'page-container-footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->

<?php get_footer(); ?>
