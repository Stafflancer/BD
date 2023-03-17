<?php
/**
 * Hero Banner - Pillar Page
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$heading = get_field('heading');
$content = get_field('content');
$button = get_field('button');
$main_icon = get_field('main_icon');
$secondary_icon = get_field('secondary_icon');
if(!empty($heading) || !empty($content) || !empty($button) || !empty($main_icon) || !empty($secondary_icon)){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'hero-banner-pillar-page-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'hero-banner-pillar-page';

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
    bopper_display_breadcrumbs();?>
    <div class="banner-common-inner"><?php
            if($heading){ ?>
                <h1><?php echo $heading; ?></h1><?php
            } 
            if($content){ ?>
                <div class="content">
                    <?php echo $content; ?>
                </div><?php
            } 
            if($main_icon || $secondary_icon){ ?>
                <div class="icons"><?php
                    if($main_icon){ ?>
                        <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$main_icon.'.svg'; ?>"><?php
                    }?> 
                    <div class="icons-small"><?php
                    if($secondary_icon){ ?>
                        <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$secondary_icon.'.svg'; ?>"><?php
                    } ?></div>
                </div><?php
            }?>
        </div><?php
    bopper_close_block( $container_args['container'] );
}