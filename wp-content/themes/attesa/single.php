<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Attesa
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" <?php attesa_schema_markup( 'main' ); ?>>

		<?php
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'single' );

				$attesa_showPrevNext = attesa_options('_show_prevnext_section', '1');
				if ($attesa_showPrevNext) {
					if ( 'post' === get_post_type() ) {
						the_post_navigation( array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'attesa' ) . '<i class="' . esc_attr(attesa_get_fontawesome_icons('general_prefix')) . ' fa-lg fa-angle-double-right spaceLeft"></i></span> ' .
								'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'attesa' ) . '</span> ' .
								'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="' . esc_attr(attesa_get_fontawesome_icons('general_prefix')) . ' fa-lg fa-angle-double-left spaceRight"></i>' . __( 'Previous Post', 'attesa' ) . '</span> ' .
								'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'attesa' ) . '</span> ' .
								'<span class="post-title">%title</span>',
						) );
					}
				}
				
				do_action('attesa_after_single_post_content');

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
