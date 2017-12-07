<?php
/**
 * The template for displaying all author's posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Marinara_Blog
 */
?>
<?php if ( 'post' === get_post_type() ) : ?>

	<?php $thumbnailurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
	<div class="blog-article-wrapper col-xs-12 col-sm-6 col-md-4">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<div class="blog-article-meta-info-wrapper">
					<a href="<?php the_permalink(); ?>" title="Read More"><?php the_title( '<h3 class="entry-title">', '</h3>' ); ?></a>
					<p class="article-category"><i class="fa fa-tag"></i> <?php the_category( ', ' ); ?></p>
					<p class="article-meta-info">posted <i class="fa fa-clock-o"></i> <?php the_time( get_option( 'date_format' ) ); ?> by <?php echo get_avatar( get_the_author_meta('ID'), 24 ); ?> <?php the_author_posts_link(); ?>
					</p>
				</div>
				<div class="blog-article-thumbnail-wrapper">
					<a href="<?php the_permalink(); ?>" title="Read More"><img class="" src="<?php echo $thumbnailurl; ?>" alt="<?php the_title(); ?>"/></a>
				</div>
				<div class="blog-article-excerpt-wrapper">
					<p><?php the_excerpt(); ?></p>
				</div>
		</article><!-- end of <article> -->
	</div><!-- end of <div class="blog-article-wrapper col-xs-4"> -->

<?php elseif ( 'product' === get_post_type() ) : ?>
	
	<?php the_title(); ?>
	<p>Products Post format - Design Not Yet Complete</p>

<?php endif; ?>