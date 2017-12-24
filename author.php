<?php
/**
 * The template for displaying all author/member pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Marinara_Blog
 */
get_header();
$author = get_user_by( 'slug', get_query_var( 'author_name' ) ); ?>
<div id="inside-page-content-wrapper" class="author-page-content-wrapper-row content-wrapper-row row">
    <div id="inside-page-no-featured-img-wrapper" class="container">
        <div class="no-feat-img-inner-wrapper row">
            <div class="no-feat-img-caption-title">				
            	 <h2><?php echo $author_name; ?></h2>
            </div>
       	</div>
    </div>
	<div class="inside-page-container author-page-container container">
		<div class="single-post-types-tab-col col-xs-12 col-sm-8">
			<ul class="single-post-types-nav-tabs nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"><?php _e( 'About', 'marinara-blog' ); ?></a></li>
				<li role="presentation"><a href="#blog" aria-controls="blog" role="tab" data-toggle="tab"><?php _e( 'Blog', 'marinara-blog' ); ?></a></li>
			</ul>
			<div class="single-post-types-tab-content tab-content">
				<div role="tabpanel" class="tab-pane active" id="about">
					<?php get_template_part('template-parts/content', 'author-about'); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="blog">
					<?php get_template_part('template-parts/content', 'blog-post-listing'); ?>
				</div>
			</div>
		</div><!-- end of <div class="single-post-types-tab-col -->
		<div class="social-media-col hidden-xs col-sm-4">
			<?php dynamic_sidebar('author-sidebar-widget'); ?>
		</div><!-- end of <div class="social-media-col -->
	</div>
	<div class="inside-page-footer-container author-page-footer-container container">
		<?php get_template_part( 'inside', 'page-container-footer' ); ?>
	</div>
</div><!-- end of <div id="inside-page-content-wrapper" -->
<?php get_footer(); ?>