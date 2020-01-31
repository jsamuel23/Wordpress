<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Attesa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action('attesa_before_post_content'); ?>
	<?php
		$attesa_featImagePosts = apply_filters( 'attesa_post_featured_image_style', attesa_options('_featimage_style_posts', 'content') );
		$attesa_featImageTitle = apply_filters( 'attesa_title_featured_image_style', attesa_options('_featimage_style_posts_title', 'insidecontent') );
	?>
	<header class="entry-header">
		<?php

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta smallText">
				<?php
				attesa_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif;
		if ('post' === get_post_type() && $attesa_featImageTitle == 'insideheader' && $attesa_featImagePosts == 'header' && '' != get_the_post_thumbnail()) {
			the_title( '<span class="entry-title hidden" '. attesa_get_schema_markup('name') .'>', '</span>' );
		} else {
			the_title( '<h1 class="entry-title" '. attesa_get_schema_markup('name') .'>', '</h1>' );
		}
		?>
	</header><!-- .entry-header -->
	<?php
		if ('post' === get_post_type() && $attesa_featImagePosts == 'content') {
			attesa_post_thumbnail();
		} elseif('post' !== get_post_type()) {
			attesa_post_thumbnail();
		}
	?>

	<div class="entry-content" <?php attesa_schema_markup('text'); ?>>
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'attesa' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="page-links-number">',
			'link_after'  => '</span>'
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php attesa_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php do_action('attesa_after_post_content'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
