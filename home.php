<?php
/**
 * The template for displaying the blog with no sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * No Sidebar Blog
 * 
 * @package Marinara_Blog
 */
get_header(); ?>
<div id="inside-page-content-wrapper" class="blog-page-content-wrapper-row content-wrapper-row row">
	    <div id="inside-page-no-featured-img-wrapper" class="container">
	        <div class="no-feat-img-inner-wrapper row">
	            <div class="no-feat-img-caption-title">
	                 <h2><?php the_title(); ?></h2>
	            </div>
	       	</div>
	    </div>
	<div class="inside-page-container blog-page-container container">
		<div class="blog-post-listing-col col-xs-12 col-sm-8">
			<?php get_template_part('template-parts/content', 'blog-post-listing'); ?>
		</div><!-- end of <div class="blog-post-listing-col -->
		<div class="page-sidebar-col col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div><!-- end of <div class="page-sidebar-col -->
	</div>
	<div class="inside-page-footer-container blog-page-footer-container container">
		<?php get_template_part( 'inside', 'page-container-footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->
<?php get_footer(); ?>
