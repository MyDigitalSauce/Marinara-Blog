<?php
/**
 * The template for displaying all author about content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Marinara_Blog
 */
$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
/* Establish Working Varaibles */
$author_name = esc_attr(get_the_author_meta('display_name', $author->ID));
$author_reg_date = date("M Y", strtotime(get_userdata(get_current_user_id( ))->user_registered));
$author_description = get_the_author_meta('description', $author->ID);
/* social */
$author_email = esc_attr(get_the_author_meta('user_email', $author->ID));
$author_website = esc_attr(get_the_author_meta('user_url', $author->ID));
$facebook_url = esc_attr( get_the_author_meta( 'facebook', $author->ID ) );
$twitter_url = esc_attr( get_the_author_meta( 'twitter', $author->ID ) );
$instagram_url = esc_attr( get_the_author_meta( 'instagram', $author->ID ) );
$googleplus_url = esc_attr( get_the_author_meta( 'googleplus', $author->ID ) );
$soundcloud_url = esc_attr( get_the_author_meta( 'soundcloud', $author->ID ) );

$author_avatar_url = esc_attr( get_the_author_meta( 'profile_img', $author->ID ) );
if ( $author_avatar_url == '') {
	$author_avatar = get_avatar($author->ID,96,'',get_the_author_meta('display_name'));
}

// $instagram_id = esc_attr( get_the_author_meta( 'profile_instagram_id', $author->ID ) );
/* determining user role */
if (user_can( $author->ID, 'remove_users' )):
	$author_role = '<i class="fa fa-life-saver"></i> Admin';
elseif (user_can( $author->ID, 'manage_woocommerce' )):
	$author_role = '<i class="fa fa-shopping-cart"></i> Store Manager';
elseif (user_can( $author->ID, 'edit_posts' )):
	$author_role = '<i class="fa fa-pencil"></i> Blogger';
endif;
$author_post_count = count_user_posts( $author->ID , 'post' );
/* woocommerce */
/*$author_product_count = count_user_posts( $author->ID , 'product' );*/
?>
<div class="author-about-row row">
	<div class="author-avatar-col col-xs-12 col-sm-4 sm-padding-right-0">
		<?php if ($author_avatar_url != ''): ?>
			<img src="<?php echo $author_avatar_url; ?>" class="avatar" alt="<?php echo $author_name; ?> Avatar"/>
		<?php else: ?>
			<?php echo $author_avatar; ?>
		<?php endif; ?>
	</div>
	<div class="author-info-col col-xs-12 col-sm-8">
		<h3 class="black-clr"><?php echo $author_name; ?></h3>
		<h3 class="black-clr"><?php bloginfo('name'); ?> <?php echo $author_role; ?> Since: <i class="fa fa-calendar"></i> <?php echo $author_reg_date; ?></h3>
		<div class="clearfix"></div>
		<?php echo $author_description; ?>
		<div class="clearfix"></div>
		<ul class="contact-listing fa-ul">
		<?php if ($author_email): ?>
			<li><i class="fa-li fa fa-envelope"></i> <a href="mailto:<?php echo $author_email; ?>" title="Email <?php echo $author_name; ?>"><?php echo $author_email; ?></a></li>
		<?php endif; ?>
		<?php if ($author_website): ?>
			<li><i class="fa-li fa fa-globe"></i> <a href="<?php echo $author_website; ?>" title="View <?php echo $author_name; ?>'s Website" target="_blank"><?php echo $author_website; ?></a></li>
		<?php endif; ?>
		<?php if ($facebook_url): ?>
			<li><i class="fa-li fa fa-facebook"></i> <a href="<?php echo $facebook_url; ?>" title="View <?php echo $author_name; ?>'s Facebook" target="_blank"><?php echo $facebook_url; ?></a></li>
		<?php endif; ?>
		<?php if ($twitter_url): ?>
			<li><i class="fa-li fa fa-twitter"></i> <a href="<?php echo $twitter_url; ?>" title="View <?php echo $author_name; ?>'s Twitter" target="_blank"><?php echo $twitter_url; ?></a></li>
		<?php endif; ?>
		<?php if ($instagram_url): ?>
			<li><i class="fa-li fa fa-instagram"></i> <a href="<?php echo $googleplus_url; ?>" title="View <?php echo $author_name; ?>'s Instagram" target="_blank"><?php echo $instagram_url; ?></a></li>
		<?php endif; ?>
		<?php if ($googleplus_url): ?>
			<li><i class="fa-li fa fa-google-plus"></i> <a href="<?php echo $googleplus_url; ?>" title="View <?php echo $author_name; ?>'s Google Plus" target="_blank"><?php echo $googleplus_url; ?></a></li>
		<?php endif; ?>
		<?php if ($soundcloud_url): ?>
			<li><i class="fa-li fa fa-soundcloud"></i> <a href="<?php echo $soundcloud_url; ?>" title="View <?php echo $author_name; ?>'s SoundCloud" target="_blank"><?php echo $soundcloud_url; ?></a></li>
		<?php endif; ?>
	</ul>
	</div>
</div>