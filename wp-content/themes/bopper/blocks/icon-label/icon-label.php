<?php
/**
 * Icon + Label
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');
$icon = get_field('icon');
$label = get_field('label');
if(!empty($block_header) || !empty($icon) || !empty($label)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'icon-label-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'icon-label';

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
    <div class="icon-label-main"><?php
        if(!empty($block_header )){
            bopper_display_block_header($block_header);
        } ?>
        <div class="icon-label-inner">
            <div class="icon-label-content"><?php
                if( !empty( $icon) ){ ?>
                    <div class="icon">
                        <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
                    </div><?php
                }
                if( !empty($label) ){ ?>
                    <label class="h4"><?php echo $label; ?></label><?php
                } ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}