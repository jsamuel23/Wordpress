<?php
/**
 * The push sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Attesa
 */
if ( ! is_active_sidebar( attesa_get_push_sidebar() ) || ! attesa_check_bar('push') ) {
	return;
}
?>
<?php if(attesa_options('_show_opacitypush', '1')): ?>
	<div class="opacityBox"></div>
<?php endif; ?>
<aside id="tertiary" class="widget-area nano" <?php attesa_schema_markup('sidebar'); ?>>
	<div class="close-hamburger">
		<div class="close-ham-inner"></div>
	</div>
	<div class="nano-content">
	<?php do_action('attesa_before_push_sidebar'); ?>
	<?php dynamic_sidebar( attesa_get_push_sidebar() ); ?>
	<?php do_action('attesa_after_push_sidebar'); ?>
	</div>
</aside><!-- #secondary -->