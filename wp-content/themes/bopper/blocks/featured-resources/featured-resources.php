<?php
/**
 * Featured Resources
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

if(have_rows('resources')){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'featured-resources-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'featured-resources';

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
    <div class="featured-resources-main featured-resources-swiper">
        <div class="swiper-wrapper"><?php
            while(have_rows('resources')){
                the_row();
                $resource_label = get_sub_field('resource_label');
                $resource = get_sub_field('resource');
                $resource_button_label = get_sub_field('resource_button_label');
                $title = get_the_title($resource);
                $excerpt = get_the_excerpt($resource); 
                $permalink = get_the_permalink($resource);
                $featured_resource_image = get_the_post_thumbnail($resource); ?>
                <div class="featured-resources-item swiper-slide">
                    <div class="featured-resources-item-inner">
                        <div class="case-study-block-bottom">
                            <div class="news_content"><?php
                                if($resource_label){ ?>
                                    <label><?php echo $resource_label; ?></label><?php
                                }  ?>                    
                                <a href="<?php echo $permalink; ?>"><h2 class="news_heading"><?php echo $title; ?></h2></a><?php
                                if($excerpt){ ?>
                                    <div class="excerpt-text">
                                        <p><?php echo $excerpt; ?></p>
                                    </div><?php
                                } ?>
                                <a href="<?php echo $permalink; ?>" class="wp-block-button__link wp-element-button"><?php echo $resource_button_label; ?></a>
                            </div>
                        </div><?php
                        if ( $featured_resource_image ) { ?>
                            <div class="thumbnail_ava">
                                <a href="<?php echo $permalink; ?>"><?php echo $featured_resource_image; ?></a>
                            </div><?php 
                        } ?>
                    </div>
                </div><?php
            } ?>
        </div>
        <div class="swiper-pagination"></div>
    </div><?php
    $buttons = get_field( 'buttons');
    if($buttons){
        bopper_display_header_buttons($buttons);
    }
    bopper_close_block( $container_args['container'] );
}