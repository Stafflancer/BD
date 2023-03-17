<?php
/**
 * Large Body Copy
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$paragraph = get_field('paragraph');
if(!empty($paragraph)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'large-body-copy-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'large-body-copy';

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
    <div class="large-body-copy-main">
        <div class="large-body-copy-inner">
            <div class="large-body-copy-first"><?php
                if(!empty($paragraph)){ 
                    echo $paragraph; 
                } ?>
            </div>        
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}