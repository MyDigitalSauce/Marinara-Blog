<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package marinara_blog
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-details-wrapper wrapper">
		<div class="single-header">
			<?php the_title( '<h2 class="post-title">', '</h2>' ); ?>
		</div><!-- end of .single-header -->
		<div class="single-meta">
			<p>Posted in <i class="fa fa-th-list"></i> <?php /* display single categories */ the_terms( $post->ID, 'category', '', ', ', '' ); ?> by <?php echo get_avatar( get_the_author_meta('ID'), 24 ); ?> <?php the_author_posts_link(); ?> published on <i class="fa fa-clock-o"></i> <?php the_time( get_option( 'date_format' ) ); ?> </p>
		</div><!-- end of .single-meta -->
		<div class="single-content">
			<?php
			$post_format = get_post_format();
			if (isset($post_format) && $post_format == "gallery") { 
				$content = strip_shortcode_gallery( get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
				$gallery_imgs = get_post_gallery_images(); ?>

					<div id="article-gallery-carousel-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">

					  <ol class="carousel-indicators">
					  	<?php $gallery_imgs_count = count($gallery_imgs);
					  	for ($i = 0; $i < $gallery_imgs_count; $i++) {
					  		if ($i == 0): ?>
						    <li data-target="#article-gallery-carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i; ?>" class="active"></li>
							<?php else: ?>
							    <li data-target="#article-gallery-carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i; ?>"></li>
							<?php endif;
					  	} ?>
					  </ol>

					  <div class="carousel-inner" role="listbox">
						<?php //Retrieves an array of image URLs that belong to the first gallery added to the specified post.
						$i = 0;
						foreach ($gallery_imgs as $gallery_img) { ?>
						    <div class="item <?php if ($i == 0) { echo 'active'; } ?>">
						      <img src="<?php echo $gallery_img; ?>" alt="<?php the_title_attribute(); ?>">
						    </div>
						<?php $i++; } ?>
					  </div>

					  <a class="left carousel-control" href="#article-gallery-carousel-<?php the_ID(); ?>" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#article-gallery-carousel-<?php the_ID(); ?>" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div><!-- end of <div id="article-gallery-carousel -->

				<?php echo $content;
			} else {
				the_content();
			}
			if (has_tag()): ?>
				<p><i class="fa fa-tag"></i> <?php /* display single tags */ the_tags( 'Tags: ', ', ', '' ); ?></p>
			<?php endif;
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'marinara_blog' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- end of <div class="single-content"> -->
	</div><!-- end of <div class="single-details-wrapper wrapper -->
</div><!-- end of #post-## -->
