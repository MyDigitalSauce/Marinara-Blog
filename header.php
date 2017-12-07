<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Marinara_Blog
 */
$enableUserCol = get_theme_mod('enable_user_col'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="container-fluid">
	<header class="row header-row">
		<div class="container padding-0">
			<div class="header-logo-col col-xs-3 col-sm-3 padding-0 text-center">
				<?php $headerIMG = get_theme_mod('header_image'); if ($headerIMG && $headerIMG != 'remove-header'): ?>
					<a href="<?php echo get_site_url(); ?>" title="Go To <?php bloginfo('name'); ?> Home Page" class="header-site-logo-anchor"><img src="<?php echo $headerIMG; ?>" class="header-site-logo-img"></a>
				<?php else: ?>
					<a href="<?php echo get_site_url(); ?>" title="Go To <?php bloginfo('name'); ?> Home Page" class="header-clr"><h1 class="site-title margin-btm-0 row"><?php bloginfo('name'); ?></h1></a>
				<?php endif; ?>
			</div>
			<div class="header-search-col
						<?php if ($enableUserCol && has_nav_menu('header-menu')): ?>
							col-xs-5
						<?php elseif ($enableUserCol && !has_nav_menu('header-menu')): ?>
							col-xs-5
						<?php elseif (!$enableUserCol && has_nav_menu('header-menu')): ?>
							col-xs-7 col-sm-offset-3 col-sm-5
						<?php else: ?>
							col-xs-offset-4 col-xs-5 col-sm-offset-4
						<?php endif; ?>
			  			padding-0">
				<?php
			    /**
			     * @package Marinara_Blog
			     */
				get_template_part('header-parts/header', 'search-form'); ?>
			</div>
			<?php if ($enableUserCol): ?>
				<div class="header-user-options-col 
							<?php if (has_nav_menu('header-menu')) : ?>
								col-xs-2 col-sm-3
							<?php else: ?>
								col-xs-4
							<?php endif; ?>
							padding-0">
					<?php
				    /**
				     * @package Marinara_Blog
				     */
					get_template_part('header-parts/header', 'user-col'); ?>
				</div>
			<?php endif; ?>
			<div class="header-right-dropdown-menu-toggle-col collapsed <?php if ( has_nav_menu( 'header-menu' ) ) : ?> col-xs-2 col-sm-1 <?php else: ?> hidden <?php endif; ?> padding-0">
				<button type="button" class="header-right-dropdown-menu-navbar-toggle navbar-toggle collapsed" data-toggle="collapse" data-target="#header-right-dropdown-menu" aria-expanded="false" aria-controls="navbar">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar top-bar"></span>
				  <span class="icon-bar middle-bar"></span>
				  <span class="icon-bar bottom-bar"></span>
				</button>
				<div class="clearfix"></div>
			</div>
		</div><!-- end of <div class="container"> -->
	</header>
	<div class="right-dropdown-menu-container padding-0">
	    <?php
	    /**
	     * Include header-parts/header-right-dropdown-menu.php
	     * Includes the header right dropdown menu that is shown on dropdown-menu-toggle
	     * @package Marinara_Blog
	     */
		get_template_part( 'header-parts/header', 'right-dropdown-menu' );
	    ?>
	</div><!-- end of <div class="container"> -->