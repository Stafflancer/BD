<?php
/**
 * CTA - Buttons
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

// Create id attribute allowing for custom "anchor" value.
$id = 'cta-buttons-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'cta-buttons';

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
<div class="cta-buttons-main">
    <div class="cta-buttons-content"><?php
        if(!empty($heading)){ ?>
            <h4><?php echo $heading; ?></h4><?php
        } 
        if($paragraph){ ?>
            <p class="large"><?php echo $paragraph; ?></p><?php
        } ?>
    </div><?php
    if(have_rows('buttons')){ ?>
        <div class="cta-buttons-outer"><?php
            while(have_rows('buttons')){
                the_row();
                $button = get_sub_field('button'); 
                if ( ! empty( $button ) && ! empty( $button['url'] ) ){ ?>
                    <a href="<?php echo esc_url($button['url']); ?>" class="wp-block-button__link wp-element-button"><?php echo $button['title']; ?></a><?php
                }
            } ?>
        </div><?php
    } ?>
</div><?php
bopper_close_block( $container_args['container'] );
