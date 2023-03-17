<?php
/**
 * Two Column Content
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

if(have_rows('columns')){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'two-column-content-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'two-column-content';

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
        <div class="two-column-top">
            <div class="heading-icon"><?php
                if(!empty($icon)){ ?>
                    <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>"><?php
                } 
                if(!empty($label)){ ?>
                    <label class="h4"><?php echo $label; ?></label><?php
                }  ?>
            </div><?php
            if(!empty($heading)){ ?>
                <h2><?php echo $heading; ?></h2><?php
            } 
            if(!empty($intro)){ ?>
                <p class="large"><?php echo $intro; ?></p><?php
            } ?> 
        </div>
        <div class="two-column-bottom">
        <?php
        while(have_rows('columns')){ 
        	the_row(); 
        	$heading = get_sub_field('heading');
        	$paragraph = get_sub_field('paragraph');
        	$link = get_sub_field('link'); ?>
	        <div class="two-column-content-item">
	        	<div class="columns-inner-text"><?php
					if( !empty( $heading) ){ ?>
						<h3><?php echo $heading; ?></h3><?php
					} 
					if( !empty( $paragraph )){ ?>
						<?php echo $paragraph; ?><?php
					} 
					if ( ! empty( $link ) && ! empty( $link['url'] ) ){ ?>
						<a href="<?php echo esc_url( $link['url'] ); ?>" class="columns-link" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a><?php
					} ?>
				</div>
	        </div><?php
	    } ?></div>
    </div><?php
    bopper_close_block( $container_args['container'] ); 
} ?>
 

