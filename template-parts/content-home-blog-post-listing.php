<?php
/**
 * Template part for displaying blog page posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Marinara_Blog
 */
$showByAuthor = get_theme_mod('show_by_author_on_blog_listing'); ?>

<div class="blog-listing-wrapper wrapper">
	<?php
	wp_reset_query();
	$articlesArgs = array(
		'post_type' => 'post',
		'paged' => get_query_var('page') ? get_query_var('page') : 1
	);
	$articlesQuery = new WP_Query( $articlesArgs );
	$articleCnt = 0;
	while ( $articlesQuery->have_posts() ) : $articlesQuery->the_post();
		$post_format = get_post_format();
		$feat_img_url  = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$author_avatar = get_avatar( get_the_author_meta('ID'), 200 ); ?>
	    <div class="article article-<?php echo $articleCnt; ?> <?php if (isset($post_format) && $post_format != ""): echo 'article-'.$post_format; endif; ?> article-wrapper clearfix">
	    	<?php if (isset($post_format) && $post_format == "aside") { ?>
				<div class="article-desc col-xs-12">
					<?php if ($showByAuthor): ?>
						<span class="author"> by <?php echo $author_avatar; ?>&nbsp;<?php the_author_posts_link(); ?></span>
					<?php endif; ?>
					<span class="publish-date"> published on <i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?>
				</div>
		    	<div class="article-content-col col-xs-12">
		    		<div class="article-content"><?php the_content(); ?></div>
		    	</div>
	    	<?php } else if (isset($post_format) && $post_format == "gallery") {
	    		$gallery_imgs = get_post_gallery_images(); ?>

		    	<div class="col-sm-5 col-xs-12 article-gallery-col">
		    		<?php if ( ! empty($gallery_imgs)) { ?>
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
		    		<?php } else { ?>
		    			<p><?php _e('No Gallery Images Are Set, Go to the Post Editor and Input a Gallery Shortcode into the WordPress Content Area.', 'marinara-blog'); ?></p>
	    			<?php } ?>
					<div class="article-desc">
						In <span class="category"><i class="fa fa-tag"></i>&nbsp;<?php the_category( ', ' ); ?></span>
						<?php if ($showByAuthor): ?>
							<span class="author"> by <?php echo $author_avatar; ?>&nbsp;<?php the_author_posts_link(); ?></span>
						<?php endif; ?>
						<span class="publish-date"> published on <i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?>
					</div>
		      	</div>
			  	<div class="col-sm-7 col-xs-12">
					<div class="article-title" style="margin-top: 0;"><a class="h3" href="<?php the_permalink(); ?>" title="View More"><?php the_title(); ?></a></div>
					<div class="article-excerpt"><?php echo get_the_excerpt(); ?></div>
					<div class="article-read-more"><a href="<?php the_permalink(); ?>" title="Read More..."><?php echo $post->comment_count?>&nbsp;<?php echo ($post->comment_count==1?'<i class="fa fa-comment"></i>':'<i class="fa fa-comments"></i>');?>&nbsp;Read More</a></div>
				</div>
			<?php } else if ( isset( $post_format ) && $post_format == "video" ) {
				$media = get_media_embedded_in_content( 
				    apply_filters( 'the_content', get_the_content() )
				); ?>
				<div class="col-xs-12 article-video-col">
		    		<?php if(! empty($media)): ?>
						<?php echo $media[0]; ?>
					<?php else: ?>
						<p><?php _e('No Video is Embeded, Go to the Post Editor and Input a Video into the WordPress Content Area.', 'marinara-blog'); ?></p>
					<?php endif; ?>
				</div>
		    	<div class="col-sm-5 col-xs-12 article-desc-col">
					<div class="article-desc">
						In <span class="category"><i class="fa fa-tag"></i>&nbsp;<?php the_category( ', ' ); ?></span>
						<?php if ($showByAuthor): ?>
							<span class="author"> by <?php echo $author_avatar; ?>&nbsp;<?php the_author_posts_link(); ?></span>
						<?php endif; ?>
						<span class="publish-date"> published on <i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?>
					</div>
		      	</div>
			  	<div class="col-sm-7 col-xs-12">
		    		<?php if($feat_img_url != ''): ?>
						<div class="article-title" style="margin-top: 0;"><a class="h3" href="<?php the_permalink(); ?>" title="View More"><?php the_title(); ?></a></div>
					<?php endif; ?>
					<div class="article-excerpt"><?php echo get_the_excerpt(); ?></div>
					<div class="article-read-more"><a href="<?php the_permalink(); ?>" title="Read More..."><?php echo $post->comment_count?>&nbsp;<?php echo ($post->comment_count==1?'<i class="fa fa-comment"></i>':'<i class="fa fa-comments"></i>');?>&nbsp;Read More</a></div>
				</div>

	    	<?php } else if ($post_format == "" || $post_format == "image") { ?>
		    	<div class="col-sm-5 col-xs-12 article-img-col">
		    		<?php if($feat_img_url): ?>
						<img src="<?php echo $feat_img_url; ?>" alt="<?php the_title_attribute(); ?>" class="full-width">
					<?php else: ?>
						<div class="article-title" style="margin-top: 0;"><a class="h3" href="<?php the_permalink(); ?>" title="View More"><?php the_title(); ?></a></div>
					<?php endif; ?>
					<div class="article-desc">
						In <span class="category"><i class="fa fa-tag"></i>&nbsp;<?php the_category( ', ' ); ?></span>
						<?php if ($showByAuthor): ?>
							<span class="author"> by <?php echo $author_avatar; ?>&nbsp;<?php the_author_posts_link(); ?></span>
						<?php endif; ?>
						<span class="publish-date"> published on <i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?>
					</div>
		      	</div>
			  	<div class="col-sm-7 col-xs-12">
		    		<?php if($feat_img_url != ''): ?>
						<div class="article-title" style="margin-top: 0;"><a class="h3" href="<?php the_permalink(); ?>" title="View More"><?php the_title(); ?></a></div>
					<?php endif; ?>
					<div class="article-excerpt"><?php echo get_the_excerpt(); ?></div>
					<div class="article-read-more"><a href="<?php the_permalink(); ?>" title="Read More..."><?php echo $post->comment_count?>&nbsp;<?php echo ($post->comment_count==1?'<i class="fa fa-comment"></i>':'<i class="fa fa-comments"></i>');?>&nbsp;Read More</a></div>
				</div>
	    	<?php } ?>
	    </div>
		<?php $articleCnt++; ?>
	<?php
	endwhile; // End of the loop.
	marinara_blog_numeric_posts_nav( $articlesQuery ); 
	?>
</div><!-- end of <div class="blog-listing-wrapper wrapper"> -->