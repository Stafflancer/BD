<?php
/**
 * Clutch widget
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$label = get_field('label');
$widget = get_field('widget');
if(!empty($widget)){
	// Create id attribute allowing for custom "anchor" value.
	$id = 'clutch-widget-' . $block['id'];

	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className".
	$section_class_name = 'clutch-widget-sec';

	if ( ! empty( $block['className'] ) ) {
		$section_class_name .= ' ' . $block['className'];
	}


	// Start a <container> with possible block options.
	$container_args = [
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'id'        => $id, // Container id.
		'class'     => $section_class_name, // Container class.
	];

	bopper_display_block_background_options( $block, $container_args ); ?>
		<div class="clutch-widget-main">
			<div class="clutch-widget-inner"><?php
				if(!empty($label)){ ?>
					<label class="h4"><?php echo $label; ?></label><?php
				} ?>
				<div class="clutch-widget-outer">
					<?php echo $widget; ?>
				</div>
			</div>
		</div><?php
	bopper_close_block( $container_args['container'] );
}