<?php
/**
 * Sticky Content
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');
$content_left = get_field('content_left');
$content_right = get_field('content_right');
if(!empty($block_header) || !empty($content_left) || !empty($content_right)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'sticky-content-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'sticky-content';

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
    <div class="sticky-content-main">
 
            <?php
                if(!empty($block_header )){
                    bopper_display_block_header($block_header);
                } ?> 
        

        <div class="right-sticky-content-inner"><?php
            if(!empty($content_right)){ ?>
                <div class="right-sticky-content">
                    <?php echo $content_right; ?>
                </div><?php
            } ?>
        </div>
    </div>
    <?php
            if(have_rows('content_left')){ ?>
                <div class="left-sticky-content"><?php
                    while(have_rows('content_left')){
                        the_row();
                        $label = get_sub_field('label'); 
                        $content = get_sub_field('content'); 
                        if(!empty($label) || !empty($content)){ ?>
                            <div class="sticky-content-left">
                                <span class="gradient-line"></span><?php
                                if(!empty($label)){ ?>
                                    <label class="h6"><?php echo $label; ?></label><?php
                                } 
                                if(!empty($content)){ ?>
                                    <div class="sticky-content-text">
                                        <?php echo $content; ?>
                                    </div><?php
                                } ?>
                            </div><?php
                        }
                    } ?>
                </div><?php
            } ?><?php
    bopper_close_block( $container_args['container'] );
}