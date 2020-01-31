<?php
/**
 * Attesa custom class for customizer
 *
 * @package Attesa
 */
if( class_exists( 'WP_Customize_Control' ) ):
	class Attesa_Customize_Heading extends WP_Customize_Control {
		public $type = 'heading';

		public function render_content() {
			if ( !empty( $this->label ) ) : ?>
				<h3 class="attesa_options-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
			<?php endif;
			if($this->description){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php }
		}
	}
	class Attesa_Fontawesome_Icon extends WP_Customize_Control{
		public function render_content(){
			?>
				<label>
					<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					</span>
					<?php if($this->description){ ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
					<?php } ?>
					<div class="attesa-selected-icon">
						<i class="<?php echo esc_attr($this->value()); ?>"></i>
						<span><i class="fas fa fa-angle-down"></i></span>
					</div>
					<ul class="attesa-icon-list clearfix">
						<?php
						if ($this->type == 'iconScrollTop') {
							$attesa_font_awesome_icon_array = attesa_get_font_awesome_scrolltop();
						} elseif ($this->type == 'iconWooCommerceCart') {
							$attesa_font_awesome_icon_array = attesa_get_font_awesome_cart();
						} elseif ($this->type == 'iconCustomField') {
							$attesa_font_awesome_icon_array = attesa_get_font_awesome_general();
						}
						foreach ($attesa_font_awesome_icon_array as $attesa_font_awesome_icon) {
							$icon_class = $this->value() == $attesa_font_awesome_icon ? 'icon-active' : '';
							echo '<li class='.esc_attr($icon_class).'><i class="'.esc_attr($attesa_font_awesome_icon).'"></i></li>';
						}
						?>
					</ul>
					<input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
				</label>
			<?php
		}
	}
	class Attesa_Choose_Show extends WP_Customize_Control {
		public function render_content(){
			if ( empty( $this->choices ) )
			return;
			?>
					<span class="customize-control-title attesatab">
					<?php echo esc_html( $this->label ); ?>
					<span><i class="fas fa fa-angle-down"></i></span>
					</span>
					<?php if($this->description){ ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
					<?php }
					$multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
					echo '<ul class="attesa-multiple-checkbox '.esc_attr($this->type).'">';
					$checkExcludedType = array('toShowShare', 'toShowFooterCallout');
					if (!in_array($this->type, $checkExcludedType)):
					?>
						<li class="attesaToShow entire">
							<input type="checkbox" class="<?php if(in_array( 'entire_website', $multi_values )) { echo 'active'; }?>" <?php checked( in_array( 'entire_website', $multi_values ) ); ?> value="entire_website"/><label><?php echo esc_html_e('Entire website', 'attesa'); ?></label>
						</li>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( 'home_page', $multi_values ) ); ?> value="home_page"/><label><?php echo esc_html_e('Home page', 'attesa'); ?></label>
						</li>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( 'blog_page', $multi_values ) ); ?> value="blog_page"/><label><?php echo esc_html_e('Blog page', 'attesa'); ?></label>
						</li>
						<?php if (function_exists( 'is_woocommerce' )) : ?>
							<li class="attesaToShow isentire">
								<input type="checkbox" <?php checked( in_array( 'woocommerce_shop', $multi_values ) ); ?> value="woocommerce_shop"/><label><?php echo esc_html_e('WooCommerce Shop page', 'attesa'); ?></label>
							</li>
						<?php endif; ?>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( 'author_page', $multi_values ) ); ?> value="author_page"/><label><?php echo esc_html_e('Author page', 'attesa'); ?></label>
						</li>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( 'date_page', $multi_values ) ); ?> value="date_page"/><label><?php echo esc_html_e('Archive page', 'attesa'); ?></label>
						</li>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( 'search_page', $multi_values ) ); ?> value="search_page"/><label><?php echo esc_html_e('Search page', 'attesa'); ?></label>
						</li>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( 'notfound_page', $multi_values ) ); ?> value="notfound_page"/><label><?php echo esc_html_e('404 page', 'attesa'); ?></label>
						</li>
					<?php
					endif; 
					foreach ( $this->choices as $value => $label ) {
						?>
						<li class="attesaToShow isentire">
							<input type="checkbox" <?php checked( in_array( $value, $multi_values ) ); ?> value="<?php echo esc_attr($value); ?>"/><label><?php echo esc_html($label); ?></label>
						</li>
					<?php
					}
					echo '</ul>';
					?>
					<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
			<?php
		}
	}
endif;