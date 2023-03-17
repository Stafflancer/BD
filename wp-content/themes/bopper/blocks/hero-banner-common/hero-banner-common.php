<?php
/**
 * Hero Banner - Common Block Template.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$heading = get_field('heading');
$content = get_field('content');
$button = get_field('button');
if($heading || $content || $button){
	// Create id attribute allowing for custom "anchor" value.
	$id = 'hero-common-' . $block['id'];

	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className".
	$section_class_name = 'hero-banner-common';

	if ( ! empty( $block['className'] ) ) {
		$section_class_name .= ' ' . $block['className'];
	}

	// Start a <container> with possible block options.
	$container_args = [
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'id'        => $id, // Container id.
		'class'     => $section_class_name, // Container class.
	];

	bopper_display_block_background_options( $block, $container_args  );
	bopper_display_breadcrumbs();?>
	<div class="banner-common-inner"><?php
		if($heading){ ?>
			<div class="banner-heading">
				<h1><?php echo $heading; ?></h1>
			</div><?php
		}
		if($content){ ?>
			<div class="banner-content">
				<?php echo $content; ?>
			</div><?php
		}
		$buttons = get_field( 'buttons');
	    if($buttons){
	        bopper_display_header_buttons($buttons);
	    }?>
	</div><?php
	bopper_close_block( $container_args['container'] );
}