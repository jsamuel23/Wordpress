<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Attesa
 */

?>
		</div><!-- #content -->
		<?php do_action('attesa_after_site_content'); ?>
		</div><!-- .attesa-content-container -->

		<footer id="colophon" class="site-footer" <?php attesa_schema_markup('footer'); ?>>
			<?php do_action('attesa_before_footer_section'); ?>
			<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
				<div class="mainFooter">
				
					<?php do_action('attesa_footer_widgets'); ?>
					
					<?php 
					if (attesa_options('_show_subfooter', '1')) {
						do_action('attesa_sub_footer');
					}
					?>
					
				</div>
			<?php endif; ?>
		</footer><!-- #colophon -->
	</div><!-- #page -->
</div><!-- .attesa-site-wrap -->
<?php get_sidebar('push'); ?>
<?php 
	if (attesa_options('_social_float', '')) {
		echo attesa_show_social_network('float'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	if (attesa_options('_show_scrolltotop', '1')):
		$attesa_scrolltotopIcon = attesa_options('_scrolltotop_icon', 'fa fa-angle-up');
		$attesa_scrolltotopMobile = attesa_options('_show_scrolltotop_mobile', '');
		?>
		<a href="#top" id="toTop" class="<?php echo $attesa_scrolltotopMobile ? 'scrolltop_on' : 'scrolltop_off' ?>"><i class="<?php echo esc_attr($attesa_scrolltotopIcon); ?>" aria-hidden="true"></i></a>
	<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
