<?php
/**
 * Open Content
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$label = get_field('label');
$heading = get_field('heading');
$content = get_field('content');
$button = get_field('button');

if(!empty($label) || !empty($heading) || !empty($content) || !empty($button)){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'open-content-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'open-content';

    if ( ! empty( $block['className'] ) ) {
    	$section_class_name .= ' ' . $block['className'];
    }

    $label = get_field('label');

    // Start a <container> with possible block options.
    $container_args = [
    	'container' => 'section', // Any HTML5 container: section, div, etc...
    	'id'        => $id, // Container id.
    	'class'     => $section_class_name, // Container class.
    ];

    bopper_display_block_background_options( $block, $container_args ); ?>
    <div class="carousel-before-content">
        <div class="two-column-top"><?php
            if(!empty($label)){ ?>
                <label class="h5"><?php echo $label; ?></label><?php
            }  
            if(!empty($heading)){ ?>
                <h2><?php echo $heading; ?></h2><?php
            } 
            if(!empty($content)){ 
                echo $content; 
            } 
            if(!empty($button) && !empty($button['url'])){ ?>
                <a href="<?php echo esc_url($button['url']); ?>" class="wp-block-button__link wp-element-button"><?php echo $button['title']; ?></a><?php 
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] ); 
} ?>
 

