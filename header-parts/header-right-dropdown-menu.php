<?php
/**
 * @version beta
 *
 * The template for displaying the header off canvas menu.
 *
 * Contains the closing of the header off canvas menu widgets 1, 2 & 3.
 *
 * @package marinara_blog
 *
 * @author jestrada@causeforce.com
 */
?>
<div id="header-right-dropdown-menu" class="header-right-dropdown-menu-navbar-collapse container collapse" aria-expanded="false">
	<div class="hidden dropdown-right-sidebar-menu-wrapper">
	<?php wp_nav_menu( array(
	    'menu'              => 'header-menu',
	    'theme_location'    => 'header-menu',
	    'depth'             => 2,
	    'container'         => 'div',
	    'container_class'   => 'collapse navbar-collapse dropdown-right-sidebar-menu',
	    'container_id'      => 'navigation-collapsable',
	    'menu_class'        => 'nav navbar-nav header-menu',
	    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	    'walker'            => new wp_bootstrap_navwalker())
	  ); ?>
	</div><!-- end of <div class="hidden dropdown-right-sidebar-hidden-menu-wrapper">-->
	<div class="dropdown-right-sidebar-accordion-goes-here">
	<!-- dropdown-right-sidebar-accordion placed here via jQuery -->
	</div>
	<div class="dropdown-right-sidebar-social-icons">
    <?php $phoneNum = get_theme_mod( 'marinara_blog_phone_num'); if ($phoneNum): ?>
      <a class="icon" href="tel+<?php echo $phoneNum; ?>" target="_blank"><i class="fa fa-phone"></i></a>
    <?php endif; ?>
    <?php $email = get_theme_mod('marinara_blog_email'); if ($email): ?>
      <a class="icon" href="mailto:<?php echo $email; ?>" target="_blank"><i class="fa fa-envelope"></i></a>
    <?php endif; ?>
    <?php $twiiterURL = get_theme_mod('marinara_blog_twitter'); if ($twiiterURL): ?>
    	<a class="icon" href="<?php echo $twiiterURL; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
    <?php endif; ?>
    <?php $facebookURL = get_theme_mod('marinara_blog_facebook'); if ($facebookURL): ?>
      <a class="icon" href="<?php echo $facebookURL; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
    <?php endif; ?>
    <?php $instaURL = get_theme_mod('marinara_blog_instagram'); if ($instaURL): ?>
      <a class="icon" href="<?php echo $instaURL; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
    <?php endif; ?>
    <?php $youtubeURL = get_theme_mod('marinara_blog_youtube'); if ($youtubeURL): ?>
      <a class="icon" href="<?php echo $youtubeURL; ?>" target="_blank"><i class="fa fa-youtube"></i></a>
    <?php endif; ?>
    <?php $soundcloudURL = get_theme_mod('marinara_blog_soundcloud'); if ($soundcloudURL): ?>
      <a class="icon" href="<?php echo $soundcloudURL; ?>" target="_blank"><i class="fa fa-soundcloud"></i></a>
    <?php endif; ?>
	</div>
</div><!-- end of <div id="header-right-dropdown-menu" -->
<script type="text/javascript">
jQuery(document).ready(function(){
  var siteLink = '<?php echo get_site_url(); ?>';
  /* Create accordion */
  jQuery('.dropdown-right-sidebar-accordion-goes-here').prepend('<div id="dropdown-right-sidebar-accordion" class="header-right-dropdown-menu-panel-group panel-group text-center" role="tablist" aria-multiselectable="true"></div>');
  /* Create New Panels */
  var panelCount = 1;
  jQuery('.dropdown-right-sidebar-menu-wrapper .menu-item').each(function(){
  /* if the menu item has a parent with a class of navbar-nav */
  if ( jQuery(this).parent().hasClass('navbar-nav') ){
    var $this = $(this);
    var aTarget = '';
    var aText = jQuery(this).children('a').text();
    var aHref = jQuery(this).children('a').attr('href');

    if (aHref.indexOf(siteLink) != -1){
      /* This is a Link Within the Site */
    } else {
      /* This is a Link Outside the Site */
      aTarget = '_blank';
    }
    if ( ! ( jQuery(this).hasClass('menu-item-has-children') ) ){
      /* Menu Item Does Not Have Children */
      var newPanel = '<div class="panel panel-default"><h3 class="panel-title"><a href="'+aHref+'" target="'+aTarget+'">'+aText+'</a></h3></div>';
      jQuery('.header-right-dropdown-menu-panel-group').append(newPanel);
      panelCount++;
    } else {
      /* Menu Item Has Children */
      /* Put Children Links into panelCollapse */
      var dropdownList = '';
      $this.children('ul').find('a').each(function(){
        var aDropdownTarget = '';
        var aDropdownText = jQuery(this).text();
        var aDropdownHref = jQuery(this).attr('href');
        if (aHref){
          if (aHref.indexOf(siteLink) != -1){
            /* This is a Link Within the Site */
          } else {
            /* This is a Link Outside the Site */
            var aTarget = '_blank';
          }    
        }
        dropdownList += '<li><a href="'+aDropdownHref+'" target="'+aDropdownTarget+'">'+aDropdownText+'</a></li>';
      });
      var newPanel = '<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading'+panelCount+'"><h3 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#dropdown-right-sidebar-accordion" href="#collapseM'+panelCount+'" aria-expanded="false" aria-controls="collapseM'+panelCount+'">'+aText+'&nbsp;&nbsp;<i class="fa fa-angle-down rotate-0"></i></a></h3></div><div id="collapseM'+panelCount+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingM'+panelCount+'" aria-expanded="false" style="height: 0px;"><div class="panel-body"><ul class="menu list-unstyled">'+dropdownList+'</ul></div></div></div>';


      jQuery('.header-right-dropdown-menu-panel-group').append(newPanel);
      panelCount++;
    }/* end of if ( ! ( jQuery(this).hasClass('menu-item-has-children') ) ){ */    
  }
  });
});
jQuery('.header-right-dropdown-menu-panel-group .panel-title a').on('click', function(){
  jQuery('.navbar-toggle').click() /* bootstrap 3.x */
});
</script>