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
	<?php $attesa_showPosts = attesa_options('_show_posts', 'excerpt'); ?>
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
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php attesa_post_thumbnail(); ?>
	<?php if($attesa_showPosts != 'fullpost'): ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else: ?>
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'attesa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'attesa' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links-number">',
				'link_after'  => '</span>'
			) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>
	<footer class="entry-footer">
		<?php if($attesa_showPosts != 'fullpost'): ?>
			<?php $attesa_showMoreButton = attesa_options('_show_more_button', '1'); ?>
			<?php if($attesa_showMoreButton): ?>
				<?php $attesa_moreButtonText = attesa_options('_read_more_text', __( 'Read More', 'attesa' )); ?>
				<?php if($attesa_moreButtonText || is_customize_preview()): ?>
					<div class="read-more smallText"><a href="<?php echo esc_url(get_permalink()); ?>"><span><?php echo esc_html($attesa_moreButtonText); ?></span><i class="<?php attesa_fontawesome_icons('read_more'); ?> spaceLeft" aria-hidden="true"></i></a></div>
				<?php endif; ?>
			<?php endif; ?>
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
		<?php else: ?>
			<?php attesa_entry_footer(); ?>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
