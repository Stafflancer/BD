<?php
/**
 * Full Width Video Embed
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$iframe = get_field('video');
$block_header = get_field('block_header');

if(!empty($video) || !empty($block_header)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'full-width-video-embed-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'full-width-video-embed';

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
    <div class="full-width-video-embed-main">
        <div class="common-header-block"><?php
            if(!empty($block_header)){
                bopper_display_block_header($block_header);
            } 
            if(!empty($iframe)){ ?>
                <div class="full-width-video-embed-inner"><?php
                    // Use preg_match to find iframe src.
                    preg_match('/src="(.+?)"/', $iframe, $matches);
                    $src = $matches[1];
                    // Add extra parameters to src and replace HTML.
                    $params = array(
                        'controls'  => 0,
                        'muted'        => 1,
                        'hd'        => 1,
                        'autoplay' => 1,
                        'loop' => 1,
                    );
                    $new_src = add_query_arg($params, $src);
                    $iframe = str_replace($src, $new_src, $iframe);

                    // Add extra attributes to iframe HTML.
                    $attributes = 'frameborder="0"';
                    $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

                    // Display customized HTML.
                    echo $iframe; ?>
                </div><?php
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}