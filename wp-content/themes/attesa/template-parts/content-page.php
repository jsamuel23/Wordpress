<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Attesa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action('attesa_before_page_content'); ?>
	<?php
		$attesa_featImagePages = apply_filters( 'attesa_page_featured_image_style', attesa_options('_featimage_style_pages', 'content') );
		$attesa_featImageTitle = apply_filters( 'attesa_title_featured_image_style_page', attesa_options('_featimage_style_pages_title', 'insidecontent') );
	?>
	<header class="entry-header">
		<?php
		if ($attesa_featImageTitle == 'insideheader' && $attesa_featImagePages == 'header' && '' != get_the_post_thumbnail()) {
			the_title( '<span class="entry-title hidden" '. attesa_get_schema_markup('name') .'>', '</span>' );
		} else {
			the_title( '<h1 class="entry-title" '. attesa_get_schema_markup('name') .'>', '</h1>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php
		if ($attesa_featImagePages == 'content') {
			attesa_post_thumbnail();
		}
	?>

	<div class="entry-content" <?php attesa_schema_markup('text'); ?>>
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'attesa' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'attesa' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link smallText"><i class="' . esc_attr(attesa_get_fontawesome_icons('edit')) . ' spaceRight" aria-hidden="true"></i>',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	<?php do_action('attesa_after_page_content'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
