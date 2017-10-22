<?php
/**
 * The template for displaying the footer social icons.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package marinara_blog
 */
$phoneNum = get_theme_mod( 'marinara_blog_phone_num');
$email = get_theme_mod('marinara_blog_email');
$twiiterURL = get_theme_mod('marinara_blog_twitter');
$facebookURL = get_theme_mod('marinara_blog_facebook');
$instaURL = get_theme_mod('marinara_blog_instagram');
$gplusURL = get_theme_mod('marinara_blog_google_plus');
$linkedinURL = get_theme_mod('marinara_blog_linkedin');
$pinterestURL = get_theme_mod('marinara_blog_pinterest');
$tumblrURL = get_theme_mod('marinara_blog_tumblr');
$youtubeURL = get_theme_mod('marinara_blog_youtube');
$soundcloudURL = get_theme_mod('marinara_blog_soundcloud');
if ($phoneNum != '' || $email != '' || $twiiterURL != '' || $facebookURL != '' || $instaURL != '' || $youtubeURL != '' || $soundcloudURL != ''): ?>
  <div class="footer-social-icons">
    <?php if ($phoneNum): ?>
      <div class="phone-footer-social-icon">
        <a href="tel:<?php echo $phoneNum; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Call <?php bloginfo('name'); ?>"><i class="fa fa-phone"></i></a>
      </div>
    <?php endif; if ($email): ?>
      <div class="email-footer-social-icon">
        <a href="mailto:<?php echo $email; ?>" type="button" data-toggle="tooltip" data-placement="top" title="Email <?php bloginfo('name'); ?>"><i class="fa fa-envelope"></i></a>
      </div>
    <?php endif; if ($twiiterURL): ?>
    <div class="twitter-footer-social-icon">
      <a href="<?php echo $twitterURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Twiiter"><i class="fa fa-twitter"></i></a>
    </div>
    <?php endif; if ($facebookURL): ?>
    <div class="fb-footer-social-icon">
      <a href="<?php echo $facebookURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Facebook"><i class="fa fa-facebook"></i></a>
    </div>
    <?php endif; if ($instaURL): ?>
    <div class="ig-footer-social-icon">
      <a href="<?php echo $instaURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Instagram"><i class="fa fa-instagram"></i></a>
    </div>
    <?php endif; if ($gplusURL): ?>
    <div class="gplus-footer-social-icon">
      <a href="<?php echo $gplusURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Google Plus"><i class="fa fa-google-plus"></i></a>
    </div>
    <?php endif; if ($linkedinURL): ?>
    <div class="linkedin-footer-social-icon">
      <a href="<?php echo $linkedinURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Linkedin"><i class="fa fa-linkedin"></i></a>
    </div>
    <?php endif; if ($pinterestURL): ?>
    <div class="pin-footer-social-icon">
      <a href="<?php echo $pinterestURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Linkedin"><i class="fa fa-pinterest"></i></a>
    </div>
    <?php endif; if ($tumblrURL): ?>
    <div class="tmblr-footer-social-icon">
      <a href="<?php echo $tumblrURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> Tumblr"><i class="fa fa-tumblr"></i></a>
    </div>
    <?php endif; if ($youtubeURL): ?>
    <div class="yt-footer-social-icon">
      <a href="<?php echo $youtubeURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> YouTube"><i class="fa fa-youtube"></i></a>
    </div>
    <?php endif; if ($soundcloudURL): ?>
    <div class="sc-footer-social-icon">
      <a href="<?php echo $soundcloudURL; ?>" target="_blank" type="button" data-toggle="tooltip" data-placement="top" title="View <?php bloginfo('name'); ?> SoundCloud"><i class="fa fa-soundcloud"></i></a>
    </div>
    <?php endif; ?>
  </div>
<?php endif; ?>