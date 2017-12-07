<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Marinara_Blog
 */
if ( ! is_active_sidebar( 'page-sidebar-widget' ) ) {
	return;
} ?>
<div class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'page-sidebar-widget' ); ?>
</div>