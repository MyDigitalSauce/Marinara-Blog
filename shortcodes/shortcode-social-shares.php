<?php
/**
 * @version beta
 *
 * marinara_blog Shortcode Social Boxes. [marinara_blog_social_shares]
 *
 * @package marinara_blog
 */
?>
<?php
$post = get_post();

// Get Twitter Handle
$twitterHandle = str_replace('https://twitter.com/', '', get_theme_mod('marinara_blog_twitter'));

// Get current page URL 
$urlToShare = get_permalink();

// Get current page title
$titleToShare = str_replace( ' ', '%20', $post->post_title);

// Get Post Thumbnail for pinterest
$thumbnailToShare = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

// Get Bloginfo Name
$siteTitle = str_replace( ' ', '%20', get_bloginfo('name'));

// Social Share URL
$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$urlToShare;
if ($twitterHandle){  
  $twitterURL = 'https://twitter.com/intent/tweet?text='.$titleToShare.'&amp;url='.$urlToShare.'&amp;via='.$twitterHandle;
} else {
  $twitterURL = 'https://twitter.com/intent/tweet?text='.$titleToShare.'&amp;url='.$urlToShare.'&amp;via='.$siteTitle;
}
$googleURL = 'https://plus.google.com/share?url='.$urlToShare;
$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$urlToShare.'&amp;media='.$thumbnailToShare[0].'&amp;description='.$titleToShare;
?>
<ul id="oneday-social-shares" class="social-shares clearfix">
  <li class="facebook-share col-xs-3">
    <a href="<?php echo $facebookURL; ?>"  type="button" data-toggle="tooltip" data-placement="top" title="Share On Facebook" target="_blank">
      <i class="fa fa-facebook"></i>
    </a>
  </li>
  <li class="twitter-share col-xs-3">
    <a href="<?php echo $twitterURL; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Share On Twitter" rel="nofollow" target="_blank">
      <i class="fa fa-twitter"></i>
    </a>
  </li>
  <li class="pinterest-share col-xs-3">
    <a href="<?php echo $pinterestURL; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Share On Pinterest" target="_blank">
      <i class="fa fa-pinterest"></i>
    </a>
  </li>
  <li class="google-share col-xs-3">
    <a href="<?php echo $googleURL; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Share On Google Plus" target="_blank">
      <i class="fa fa-google"></i>
    </a>
  </li>
</ul>
