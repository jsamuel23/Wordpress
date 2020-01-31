<?php
/* Functions for composing the footer */

/* Create the footer widgets */
add_action('attesa_footer_widgets', 'attesa_get_footer_widgets');
function attesa_get_footer_widgets() {
	if(attesa_check_bar('footer')): ?>
		<?php $footerNumbers = attesa_options('_footer_numbers', 'threecol'); ?>
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="footerArea">
				<div class="attesaFooterWidget <?php echo esc_attr($footerNumbers); ?>">
					<?php do_action('attesa_before_footer_widgets'); ?>
					<div class="attesa-footer-container">
						<?php if ($footerNumbers == 'onecol'): ?>
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<aside id="footer-1" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</aside><!-- #footer-1 -->
							<?php endif; ?>
						<?php elseif ($footerNumbers == 'twocol'): ?>
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<aside id="footer-1" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</aside><!-- #footer-1 -->
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<aside id="footer-2" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</aside><!-- #footer-2 -->
							<?php endif; ?>
						<?php elseif ($footerNumbers == 'threecol'): ?>
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<aside id="footer-1" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</aside><!-- #footer-1 -->
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<aside id="footer-2" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</aside><!-- #footer-2 -->
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
								<aside id="footer-3" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</aside><!-- #footer-3 -->
							<?php endif; ?>
						<?php elseif ($footerNumbers == 'fourcol'): ?>
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<aside id="footer-1" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</aside><!-- #footer-1 -->
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<aside id="footer-2" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</aside><!-- #footer-2 -->
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
								<aside id="footer-3" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</aside><!-- #footer-3 -->
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
								<aside id="footer-4" class="widget-area footer">
									<?php dynamic_sidebar( 'footer-4' ); ?>
								</aside><!-- #footer-3 -->
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<?php do_action('attesa_after_footer_widgets'); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif;
}

/* Create the sub-footer */
add_action('attesa_sub_footer', 'attesa_get_sub_footer');
function attesa_get_sub_footer() {
	?>
	<div class="footer-bottom-area">
		<div class="site-copy-down smallText">
			<div class="site-info">
				<?php 
				$copyrightText = attesa_options('_copyright_text', '&copy; '.date('Y').' '. get_bloginfo('name'));
				if ($copyrightText || is_customize_preview()): ?>
					<span class="custom"><?php echo wp_kses($copyrightText, attesa_allowed_html()); ?></span>
				<?php endif; ?>
				<?php do_action('attesa_footer_credits'); ?>
			</div><!-- .site-info -->
			<div class="site-social">
				<?php 
				$showInFooter = attesa_options('_social_footer', '1');
				if ($showInFooter == 1) {
					echo attesa_show_social_network('footer'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} ?>
			</div><!-- .site-social -->
		</div>
		<?php $showFooterMenu = attesa_options('_show_footer_menu', '1');
		if ($showFooterMenu) : ?>
			<nav id="footer-navigation" class="second-navigation smallText" <?php attesa_schema_markup('site-navigation'); ?>>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'depth' => 1, 'fallback_cb' => false ) ); ?>
			</nav>
		<?php endif; ?>
	</div>
	<?php
}