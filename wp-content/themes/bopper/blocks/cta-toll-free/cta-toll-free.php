<?php
/**
 * CTA - Toll Free
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$label = get_field('label');
$phone = get_field('phone');
if(!empty($label) && !empty($phone)){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'cta-toll-free-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'cta-toll-free';

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
    <div class="cta-toll-free-main">
        <div class="cta-toll-free-inner"><?php
            if(!empty($label)){ ?>
                <h5><?php echo $label; ?></h5><?php
            } 
            if(!empty($phone)){ ?>
                <h2><a href="<?php echo esc_url($phone['url']); ?>"><?php echo $phone['title']; ?></a></h2><?php
            } ?>
            <span class="gradient-line gradient-line-center"></span>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}
