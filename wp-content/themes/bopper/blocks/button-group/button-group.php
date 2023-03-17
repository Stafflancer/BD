<?php
/**
 * Button Group
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');

if(have_rows('buttons')){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'button-group-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'button-group-sec';

    if ( ! empty( $block['className'] ) ) {
    	$section_class_name .= ' ' . $block['className'];
    }


    // Start a <container> with possible block options.
    $container_args = [
    	'container' => 'section', // Any HTML5 container: section, div, etc...
    	'id'        => $id, // Container id.
    	'class'     => $section_class_name, // Container class.
    ];

    bopper_display_block_background_options( $block, $container_args ); 
    if(!empty($block_header)){
        bopper_display_block_header($block_header);
    } ?>
        <span class="gradient-line"></span>

    <div class="button-group-main">
        <div class="button-group-inner"><?php
            while(have_rows('buttons')){
                the_row();
                $button = get_sub_field('button'); 
                if(!empty($button) && !empty($button['url'])){ ?>
                    <a href="<?php echo esc_url( $button['url'] ); ?>" class="button-group" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a><?php
                }
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}