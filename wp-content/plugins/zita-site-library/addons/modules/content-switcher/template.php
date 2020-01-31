<?php
/**
 * elaet Radio Button Switcher Module Template.
 *
 * @package elaet
 */

// Wrapper.

	$this->add_render_attribute(
		'th_wrapper', 'class', [
			'elaet-th-wrapper',
		]
	);

// Toggle Headings.
$this->add_render_attribute( 'th_toggle', 'class', 'elaet-th-toggle' );
// Toggle Headings inner.
$this->add_render_attribute( 'sec_1', 'class', 'elaet-sec-1' );
$this->add_render_attribute( 'sec_2', 'class', 'elaet-sec-2' );
// Inline Editing Heading 1.
$this->add_inline_editing_attributes( 'th_section_heading_1', 'basic' );
$this->add_render_attribute( 'th_section_heading_1', 'class', 'elaet-th-head-1' );
// Inline Editing Heading 2.
$this->add_inline_editing_attributes( 'th_section_heading_2', 'basic' );
$this->add_render_attribute( 'th_section_heading_2', 'class', 'elaet-th-head-2' );
$this->add_render_attribute( 'main_btn', 'class', 'elaet-main-btn' );
$this->add_render_attribute( 'main_btn', 'data-switch-type', $settings['th_select_switch'] );
// Toggle Sections.
$this->add_render_attribute( 'th_toggle_sections', 'class', 'elaet-th-toggle-sections' );
if ( 'content' === $settings['th_select_section_1'] ) {
	$this->add_render_attribute( 'th_section_1', 'class', 'elaet-th-content-1' );
}
if ( 'content' === $settings['th_select_section_2'] ) {
	$this->add_render_attribute( 'th_section_2', 'class', 'elaet-th-content-2' );
}
if ( 'on' === $settings['th_default_switch'] ) {
	$this->add_render_attribute( 'th_section_1', 'style', 'display: none;' );
} else {
	$this->add_render_attribute( 'th_section_2', 'style', 'display: none;' );
}
$this->add_render_attribute( 'th_section_1', 'class', 'elaet-th-section-1' );
$this->add_render_attribute( 'th_section_2', 'class', 'elaet-th-section-2' );
// Toggle Switch - Round 1.
$this->add_render_attribute( 'th_switch_label', 'class', 'elaet-th-switch-label' );
$this->add_render_attribute(
	'th_switch_round_1', 'class', [
		'elaet-th-switch',
		'elaet-switch-round-1',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_switch_round_1', 'type', 'checkbox' );
$this->add_render_attribute(
	'th_span_round_1', 'class', [
		'elaet-th-slider',
		'elaet-th-round',
		'elementor-clickable',
	]
);
// Toggle Switch - Round 2.
$this->add_render_attribute( 'th_div_round_2', 'class', 'elaet-toggle' );
$this->add_render_attribute(
	'th_input_round_2', 'class', [
		'elaet-switch-round-2',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_round_2', 'type', 'checkbox' );
$this->add_render_attribute( 'th_input_round_2', 'name', 'group1' );
$this->add_render_attribute( 'th_input_round_2', 'id', 'toggle_' . $node_id );
$this->add_render_attribute( 'th_label_round_2', 'for', 'toggle_' . $node_id );
$this->add_render_attribute( 'th_label_round_2', 'class', 'elementor-clickable' );

// Toggle Switch - Capsule.
$this->add_render_attribute( 'th_div_cap', 'class', 'elaet-toggle elaet-capsule-div' );
$this->add_render_attribute(
	'th_input_cap', 'class', [
		'elaet-switch-round-2',
		'elaet-switch-capsule',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_cap', 'type', 'checkbox' );
$this->add_render_attribute( 'th_input_cap', 'name', 'group1' );
$this->add_render_attribute( 'th_input_cap', 'id', 'toggle_' . $node_id );
$this->add_render_attribute( 'th_label_cap', 'for', 'toggle_' . $node_id );
$this->add_render_attribute( 'th_label_cap', 'class', 'elementor-clickable' );

// Toggle Switch - Rectangle.
$this->add_render_attribute( 'th_label_rect', 'class', 'elaet-th-switch-label' );
$this->add_render_attribute(
	'th_input_rect', 'class', [
		'elaet-th-switch',
		'elaet-switch-rectangle',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_rect', 'type', 'checkbox' );
$this->add_render_attribute( 'th_span_rect', 'class', 'elaet-th-slider' );
$this->add_render_attribute( 'th_span_rect', 'class', 'elementor-clickable' );

// Toggle Switch - Oval Tick Box.
$this->add_render_attribute(
	'th_div_label_box', 'class', [
		'elaet-label-box',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_oval_label_box', 'type', 'checkbox' );
$this->add_render_attribute( 'th_input_oval_label_box', 'name', 'elaet-label-box' );
$this->add_render_attribute(
	'th_input_oval_label_box', 'class', [
		'elaet-label-box-checkbox',
		'elaet-switch-oval-label-box',
		'elaet-switch-label-box',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_oval_label_box', 'id', 'myonoffswitch_' . $node_id );
$this->add_render_attribute( 'th_label_oval_label_box', 'class', 'elaet-label-box-label' );
$this->add_render_attribute( 'th_label_oval_label_box', 'for', 'myonoffswitch_' . $node_id );
$this->add_render_attribute( 'th_span_inner_oval_label_box', 'class', 'elaet-label-box-inner' );
$this->add_render_attribute( 'th_span_inactive_oval_label_box', 'class', 'elaet-label-box-inactive' );
$this->add_render_attribute( 'th_span_oval_label_box', 'class', 'elaet-label-box-switch' );
$this->add_render_attribute( 'th_span_active_oval_label_box', 'class', 'elaet-label-box-active' );

// Toggle Switch - Label Box.
$this->add_render_attribute(
	'th_div_label_box', 'class', [
		'elaet-label-box',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_label_box', 'type', 'checkbox' );
$this->add_render_attribute( 'th_input_label_box', 'name', 'elaet-label-box' );
$this->add_render_attribute(
	'th_input_label_box', 'class', [
		'elaet-label-box-checkbox',
		'elaet-switch-label-box',
		'elementor-clickable',
	]
);
$this->add_render_attribute( 'th_input_label_box', 'id', 'myonoffswitch_' . $node_id );
$this->add_render_attribute( 'th_label_label_box', 'class', 'elaet-label-box-label' );
$this->add_render_attribute( 'th_label_label_box', 'for', 'myonoffswitch_' . $node_id );
$this->add_render_attribute( 'th_span_inner_label_box', 'class', 'elaet-label-box-inner' );
$this->add_render_attribute( 'th_span_inactive_label_box', 'class', 'elaet-label-box-inactive' );
$this->add_render_attribute( 'th_span_label_box', 'class', 'elaet-label-box-switch');
$this->add_render_attribute( 'th_span_active_label_box', 'class', 'elaet-label-box-active' );
?>

<div <?php echo $this->get_render_attribute_string( 'th_wrapper' ); ?>>
	<div <?php echo $this->get_render_attribute_string( 'th_toggle' ); ?>>
		<div <?php echo $this->get_render_attribute_string( 'sec_1' ); ?>>
			<<?php echo $settings['th_header_size']; ?> <?php echo $this->get_render_attribute_string( 'th_section_heading_1' ); ?> data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'th_section_heading_1' ); ?></<?php echo $settings['th_header_size']; ?>>
		</div>
		<div <?php echo $this->get_render_attribute_string( 'main_btn' ); ?>>

			<?php $switch_html = ''; ?>
			<?php $is_checked  = ( 'on' === $settings['th_default_switch'] ) ? 'checked' : ''; ?>
			<?php
			switch ( $settings['th_select_switch'] ) {
				case 'round_1':
					$switch_html = '<label ' . $this->get_render_attribute_string( 'th_switch_label' ) . '><input ' . $this->get_render_attribute_string( 'th_switch_round_1' ) . ' ' . $is_checked . '><span ' . $this->get_render_attribute_string( 'th_span_round_1' ) . '></span></label>';
					break;

				case 'round_2':
					$switch_html = '<div ' . $this->get_render_attribute_string( 'th_div_round_2' ) . '><input ' . $this->get_render_attribute_string( 'th_input_round_2' ) . ' ' . $is_checked . '><label ' . $this->get_render_attribute_string( 'th_label_round_2' ) . '></label></div>';
					break;

				case 'capsule':
					$switch_html = '<div ' . $this->get_render_attribute_string( 'th_div_cap' ) . '><input ' . $this->get_render_attribute_string( 'th_input_cap' ) . ' ' . $is_checked . '><label ' . $this->get_render_attribute_string( 'th_label_cap' ) . '></label></div>';
					break;

				case 'rectangle':
					$switch_html = '<label ' . $this->get_render_attribute_string( 'th_label_rect' ) . '><input ' . $this->get_render_attribute_string( 'th_input_rect' ) . ' ' . $is_checked . '><span ' . $this->get_render_attribute_string( 'th_span_rect' ) . '></span></label>';
					break;

				case 'oval_label_box':
$switch_html = 
			'<div ' . $this->get_render_attribute_string( 'th_div_oval_label_box' ) . '>
			<input ' . $this->get_render_attribute_string( 'th_input_oval_label_box' ) . ' ' . $is_checked . '>
			<label ' . $this->get_render_attribute_string( 'th_label_oval_label_box' ) . '">
			<span ' . $this->get_render_attribute_string( 'th_span_inner_oval_label_box' ) . '>
			<span ' . $this->get_render_attribute_string( 'th_span_inactive_oval_label_box' ) . '>
			<span ' . $this->get_render_attribute_string( 'th_span_oval_label_box' ) . '>✓
			</span>
			</span>
			<span ' . $this->get_render_attribute_string( 'th_span_active_oval_label_box' ) . '>
			<span ' . $this->get_render_attribute_string( 'th_span_oval_label_box' ) . '>✓
			</span>
			</span>
			</span>
			</label>
			</div>';
					break;

				case 'label_box':
$switch_html = 
			'<div ' . $this->get_render_attribute_string( 'th_div_label_box' ) . '>
			<input ' . $this->get_render_attribute_string( 'th_input_label_box' ) . ' ' . $is_checked . '>
			<label ' . $this->get_render_attribute_string( 'th_label_label_box' ) . '">
			<span ' . $this->get_render_attribute_string( 'th_span_inner_label_box' ) . '>
			<span ' . $this->get_render_attribute_string( 'th_span_inactive_label_box' ) . '>
			<span ' . $this->get_render_attribute_string( 'th_span_label_box' ) . '>ON
			</span>
			</span>
			<span ' . $this->get_render_attribute_string( 'th_span_active_label_box' ) . '>
			<span ' . $this->get_render_attribute_string( 'th_span_label_box' ) . '>ON
			</span>
			</span>
			</span>
			</label>
			</div>';
					break;


				default:
					break;
			}
			?>

			<!-- Display Switch -->
			<?php echo $switch_html; ?>

		</div>
		<div <?php echo $this->get_render_attribute_string( 'sec_2' ); ?>>
			<<?php echo $settings['th_header_size']; ?> <?php echo $this->get_render_attribute_string( 'th_section_heading_2' ); ?> data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'th_section_heading_2' ); ?></<?php echo $settings['th_header_size']; ?>>
		</div>
	</div>
	<div <?php echo $this->get_render_attribute_string( 'th_toggle_sections' ); ?>>
		<div <?php echo $this->get_render_attribute_string( 'th_section_1' ); ?>>
			<?php echo do_shortcode( $this->get_modal_content( $settings, $node_id, 'th_select_section_1' ) ); ?>
		</div>
		<div <?php echo $this->get_render_attribute_string( 'th_section_2' ); ?>>
			<?php echo do_shortcode( $this->get_modal_content( $settings, $node_id, 'th_select_section_2' ) ); ?>
		</div>
	</div>
</div>
