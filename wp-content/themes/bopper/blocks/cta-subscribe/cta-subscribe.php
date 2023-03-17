<?php
/**
 * CTA - Subscribe
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$heading = get_field('heading');
$paragraph = get_field('paragraph');
$form = get_field('form');
if($heading || $paragraph || $form){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'cta-subscribe-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'cta-subscribe';

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
    <div class="cta-subscribe-main">
        <div class="cta-subscribe-content">
            <div class="text-subscribe"><?php
                if($heading){ ?>
                    <h5><?php echo $heading; ?></h5><?php
                } 
                if($paragraph){ ?>
                    <div class="paragraph">
                        <p><?php echo $paragraph; ?></p>
                    </div><?php
                } ?>
            </div>
            <div class="subscribe-form">
                <?php
                if($form){
                   echo do_shortcode( '[gravityform id="' . $form . '" title="false" ajax="true"]' );
                } ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}