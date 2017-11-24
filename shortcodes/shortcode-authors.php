<?php
/**
 * @version beta
 *
 * marinara_blog blog reel [authors orderby=""] shortcode.
 *
 * @package marinara_blog
 */
?>
<div class="author-listing-wrapper clearfix">
<?php
$order = 'ASC';
if ($orderBy == 'registered'){
	$order = 'DESC';
}
$userArgs = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => 'editor',
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => $orderBy,
	'order'        => $order,
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => ''
 );
$authors = get_users($userArgs);
foreach( $authors as $author ){
	
	$author_avatar_url = esc_attr( get_the_author_meta( 'profile_img', $author->ID ) );
	if ( $author_avatar_url == '') {
		$author_avatar = get_avatar($author->ID,200);
	}
	$author_posted_articles_cnt = count_user_posts( $author->ID , 'post' );
	$author_email = esc_html($author->user_email);
	$author_name = $author->display_name;
	$author_url = get_site_url().'/blog/author/'.$author->user_nicename;
	?>
	<div class="col-sm-12">
		<div class="author-row author-row-<?php echo $author->ID; ?> row">
			<a href="<?php echo $author_url; ?>" title="<?php echo $author_name; ?>" class="author-avatar-col col-xs-4" style="padding-right: 0;">
				<?php if ($author_avatar_url != ''): ?>
					<img src="<?php echo $author_avatar_url; ?>" class="avatar" alt="<?php echo $author_name; ?> Avatar"/>
				<?php else: ?>
					<?php echo $author_avatar; ?>
				<?php endif; ?>
			</a>
			<div class="col-xs-8">
				<h4 class="author-name"><a href="<?php echo $author_url; ?>" title="<?php echo $author_name; ?>" class=""><?php echo $author_name; ?></a></h4>
				<p class="author-website-count"><i class="fa fa-pencil"></i>&nbsp;<?php echo $author_posted_articles_cnt; ?>&nbsp;<?php echo ($author_posted_articles_cnt==1?'Article':'Articles');?> Written</p>
			</div>
		</div>
	</div>
<?php }
if( empty( $authors ) ) {
  echo '<div class="no-authors-col col-xs-12"><h4>There are no users with the role: Author</h4></div>';
} ?>
</div><!-- end of <div class="author-listing-wrapper"> -->