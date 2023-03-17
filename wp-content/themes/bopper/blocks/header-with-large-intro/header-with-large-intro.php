<?php
/**
 * Header with Large Intro
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'header-with-large-intro-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'header-with-large-intro';

if ( ! empty( $block['className'] ) ) {
	$section_class_name .= ' ' . $block['className'];
}


// Start a <container> with possible block options.
$container_args = [
	'container' => 'section', // Any HTML5 container: section, div, etc...
	'id'        => $id, // Container id.
	'class'     => $section_class_name, // Container class.
];

bopper_display_block_background_options( $block, $container_args );

$header_block = get_field('header_style');

if($header_block){
	bopper_display_block_header($header_block);
}

bopper_close_block( $container_args['container'] );