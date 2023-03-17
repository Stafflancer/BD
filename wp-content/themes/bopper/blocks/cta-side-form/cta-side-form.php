<?php
/**
 * CTA - Side Form
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');
$form = get_field('form');
if($block_header || $form){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'cta-side-form-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'cta-side-form';

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
    <div class="cta-side-form-main">
        <div class="cta-form-b2b-op">
            <span class="normal-text">
                <img decoding="async" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/1.png" alt="b2p">
            </span>
            <span class="hover-text">
                <img decoding="async" src="<?php echo get_stylesheet_directory_uri()?>/assets/images/2.png" alt="bop">
            </span>
        </div><?php
        if(!empty($block_header )){
            bopper_display_block_header($block_header);
        } 
        if($form){ ?>
	        <div class="cta-side-form-content">
	            <div class="subscribe-form">
	            	<?php echo do_shortcode( '[gravityform id="' . $form . '" title="false" ajax="true"]' ); ?>
	            </div>
	        </div><?php
        } ?>
    </div><?php
    bopper_close_block( $container_args['container'] );
}