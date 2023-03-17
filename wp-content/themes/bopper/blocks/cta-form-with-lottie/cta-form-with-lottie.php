<?php
/**
 * CTA - Form with Lottie
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$heading = get_field('heading');
$paragraph = get_field('content');
$form = get_field('form');
$label = get_field('label');
if($heading || $paragraph || $form){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'cta-form-with-lottie-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'cta-form-with-lottie';

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
    <div class="cta-form-with-lottie-main">
        <div class="cta-form-b2b-op">
            <span class="normal-text">
                <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/1.png" alt="b2p">
            </span>
            <span class="hover-text">
                <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/2.png" alt="bop">
            </span>
        </div>
        <div class="cta-form-with-lottie-content">
            <div class="cta-form-content"><?php
                if($label){ ?>
                    <label><?php echo $label; ?></label><?php
                }
                if($heading){ ?>
                    <h2><?php echo $heading; ?></h2><?php
                } ?>
                <span class="gradient-line gradient-line-center"></span>
                <?php
                if($paragraph){ ?>
                    <div class="paragraph">
                        <p><?php echo $paragraph; ?></p>
                    </div><?php
                } ?>
            </div>
            <div class="cta-form-main">
                <?php
                    if($form){
                       echo do_shortcode( '[gravityform id="' . $form . '" title="false" ajax="true"]' );
                } ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}