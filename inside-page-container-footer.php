<?php
/**
 * The template for displaying the  inside page container footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package marinara_blog
 */
?>
<div class="clearfix"></div>
<footer class="site-footer footer-row row">
  <div class="footer-logo-col col-xs-12 text-center">
    <?php $footerImg = get_theme_mod('footer_image'); if (isset($footerImg)): ?>
      <img src="<?php echo $footerImg; ?>" alt="<?php bloginfo('name'); ?>" class="footer-logo">
    <?php else: ?>
      <h2 class="footer-bloginfo-name footer-clr"><?php echo bloginfo('name'); ?></h2>
    <?php endif; ?>
  </div>
	<div class="col-xs-12 text-center">
    <?php get_template_part('footer-parts/footer', 'social-icons'); ?>
    <div class="footer-menu-wrapper">
      <?php if (has_nav_menu( 'footer-menu' )){
        wp_nav_menu( array(
          'menu'              => 'footer-menu',
          'theme_location'    => 'footer-menu',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'navbar-collapse footer-navigation',
          'container_id'      => 'navigation-collapsable',
          'menu_class'        => 'nav navbar-nav footer-menu',
          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          'walker'            => new wp_bootstrap_navwalker())
        ); 
      } ?>
    </div>
  </div>
  <div class="copyright-col col-xs-12 text-center footer-clr">
		&copy; <span class="currYear"><?php echo date('Y'); ?></span> <?php echo bloginfo('name'); ?>
  </div>
  <div class="copyright-col col-xs-12 text-center footer-clr">
    <a href="http://wordpress.org/" title="A Semantic Personal Publishing Platform" rel="generator" target="_blank">Proudly powered by WordPress</a> | Theme: <a href="https://mydigitalsauce.com/sauces/marinara-blog" target="_blank" title="A WordPress Blog Theme">Marinara Blog</a>
  </div>
</footer><!-- end of <footer class="site-footer footer-row row"> -->