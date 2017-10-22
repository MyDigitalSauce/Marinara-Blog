<?php
/**
 * Template part for displaying blog page posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package marinara_blog
 */
?>
<!-- post type post -->
<div class="blog-listing-wrapper wrapper">
	<?php $sQuery = get_search_query();
	$articlesArgs = array(
		's' => $sQuery,
		'post_type' => 'post',
	);
	$articlesQuery = new WP_Query( $articlesArgs );
	$articleCnt = 0;
	if ( $articlesQuery->have_posts() ):
		while ( $articlesQuery->have_posts() ) : $articlesQuery->the_post();
			$feat_img_url  = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$author_avatar = get_avatar( get_the_author_meta('ID'), 200 ); ?>
		    <div class="article article-<?php echo $articleCnt; ?> article-wrapper clearfix" data-article-title="<?php the_title_attribute(); ?>">
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
						<span class="publish-date"> published on <i class="fa fa-calendar"></i> <?php the_time( 'F j Y'); ?>
					</div>
		      	</div>
			  	<div class="col-sm-7 col-xs-12">
		    		<?php if($feat_img_url != ''): ?>
						<div class="article-title" style="margin-top: 0;"><a class="h3" href="<?php the_permalink(); ?>" title="View More"><?php the_title(); ?></a></div>
					<?php endif; ?>
					<div class="article-excerpt"><?php echo get_the_excerpt(); ?></div>
					<div class="article-read-more"><a href="<?php the_permalink(); ?>" title="Read More..."><?php echo $post->comment_count?>&nbsp;<?php echo ($post->comment_count==1?'<i class="fa fa-comment"></i>':'<i class="fa fa-comments"></i>');?>&nbsp;Read More</a></div>
				</div>
		    </div>
			<?php $articleCnt++; ?>
		<?php endwhile; // End of the loop. ?>
	<?php else: ?>
		<p>No Results Found</p>
	<?php endif; ?>
</div><!-- end of <div class="blog-listing-wrapper wrapper"> -->