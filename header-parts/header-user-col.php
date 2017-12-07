<?php
/**
 * @package Marinara_Blog
 */
/* Set Current User Variables 
=========================================== */
global $current_user;
$current_user = wp_get_current_user();
$userName = $current_user->user_login;
$userAvatar = get_avatar( $current_user->ID , 24); ?>
<div class="dropdown header-user-options-dropdown">
	<button id="leftHeaderDropdown" class="header-user-options-dropdown-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php if ( is_user_logged_in() ) { ?>
			<span class="user-avatar-wrap"><?php echo $userAvatar; ?></span><span class="hidden-xs">&nbsp;<?php echo $userName; ?>&nbsp;</span><i class="fa fa-angle-down primary-clr bold-it"></i>
		<?php } else { ?>
			<i class="fa fa-user primary-clr"></i> <i class="fa fa-angle-down primary-clr bold-it"></i>
		<?php } ?>
	</button> 
	<div class="dropdown-menu on-right header-user-options-dropdown-menu" aria-labelledby="leftHeaderDropdown">
		<?php if (is_user_logged_in()): ?>
			<?php dynamic_sidebar('header-user-options-dropdown-widget'); ?>
			<a class="logout-btn" href="<?php echo wp_logout_url( $redirect ); ?>" title="Logout"><i class="fa fa-sign-out"></i> Logout</a>
		<?php else: ?>
			<a class="login-btn" href="<?php echo get_site_url(); ?>/login" title="Login"><i class="fa fa-key"></i> Login</a>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
jQuery(document).on('click', 'body .dropdown-menu.on-right.header-user-options-dropdown-menu', function (e) {
  e.stopPropagation();
});
</script>