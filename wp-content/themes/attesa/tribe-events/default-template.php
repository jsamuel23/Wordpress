<?php
/**
 * The Events Calendar plugin template.
 *
 * @package Attesa
 */
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" <?php attesa_schema_markup( 'main' ); ?>>
			<div class="attesa-tribe-events">
				<?php tribe_events_before_html(); ?>
				<?php tribe_get_view(); ?>
				<?php tribe_events_after_html(); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();