<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package marinara_blog
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-content-body">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'marinara_blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .page-content -->

	<div class="page-content-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'marinara_blog' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</div><!-- .page-footer -->
</article><!-- #post-## -->
