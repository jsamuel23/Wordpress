<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Attesa
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" <?php attesa_schema_markup( 'main' ); ?>>
				<?php if ( have_posts() ) : ?>
				
					<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) : ?>

						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title" '. attesa_get_schema_markup('headline') .'>', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->
						<div class="blog-entries">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;
						?>
						</div><!-- .blog-entries -->
						<?php

						do_action('attesa_posts_navigation');
					
					endif;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
