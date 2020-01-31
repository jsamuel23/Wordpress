<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) : ?>
	<div class="edd_download_image hover_<?php echo esc_attr(attesa_options('_imagehover_effect', 'none')); ?>">
		<a href="<?php the_permalink(); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
		</a>
	</div>
<?php endif; ?>