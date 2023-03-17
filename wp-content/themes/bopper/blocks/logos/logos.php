<?php
/**
 * Logos
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$icon = get_field('icon');
$label = get_field('label');
$heading = get_field('heading');
$intro = get_field('intro');
$logos = get_field('logos');

if($icon || $label || $heading || $intro || $logos){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'logos-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'logos';

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
    <div class="before-content-outer">
        <div class="before-content"><?php
            if(!empty($icon)){ ?>
                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>"><?php
            } 
            if(!empty($label)){ ?>
                <label class="h4"><?php echo $label; ?></label><?php
            } 
            if(!empty($heading)){ ?>
                <h2><?php echo $heading; ?></h2>
                <span class="gradient-line"></span><?php
            } ?>
        </div><?php
        if(!empty($intro)){ ?>
            <div class="logo-content">
                <p class="large"><?php echo $intro; ?></p>
            </div><?php
        } ?>  
    </div>     
    <div class="logo-outer">
        <div class="logos-main">
            <?php
            if(!empty($logos)){ 
                $size = 'full'; ?>
                    <div class="logos-wrapper"><?php
                        foreach( $logos as $image_id ){ ?>
                            <div class="logos-item">
                                <?php echo wp_get_attachment_image( $image_id, $size ); ?>
                            </div><?php
                        } ?>
                    </div>
                    <?php
            } ?>
        </div>
    </div>
    <?php
    bopper_close_block( $container_args['container'] ); 
} ?>
 

