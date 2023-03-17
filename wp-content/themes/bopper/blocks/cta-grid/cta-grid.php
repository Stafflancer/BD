<?php
/**
 * CTA - Grid
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cta-grid-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'cta-grid';

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
<div class="cta-grid-main"><?php
    if(have_rows('left_side_content')){ ?>
        <div class="left_side_content"><?php
            while(have_rows('left_side_content')){
                the_row();
                $image = get_sub_field('image'); 
                if(!empty($image) && !empty($image['url']))
                { ?>
                    <img src="<?php echo esc_url($image['url']); ?>"><?php
                }
            } ?>
        </div><?php
    } 
    if(have_rows('right_side_content')){ ?>
        <div class="right_side_content">
            <div class="right_side_inner">
                <div class="right_side-main"><?php
                    while(have_rows('right_side_content')){
                        the_row();
                        $label = get_sub_field('label'); 
                        $heading = get_sub_field('heading'); 
                        $content = get_sub_field('content'); 
                        $button = get_sub_field('button'); 
                        if(!empty($label)){ ?>
                            <label class="h5"><?php echo $label; ?></label><?php
                        } 
                        if(!empty($heading)){ ?>
                            <h2><?php echo $heading; ?></h2>
                            <span class="gradient-line"></span>
                            <?php
                        } 
                        if(!empty($content)){ ?>
                            <p class="large"><?php echo $content; ?></p><?php
                        }
                        if(!empty($button) && !empty($button['url'])){ ?>
                            <a href="<?php echo esc_url($button['url']); ?>" class="wp-block-button__link wp-element-button  has-outline-white-color outline-color  has-white-color has-text-color" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a><?php
                        }
                    } ?>
                </div>
            </div>
        </div><?php
    } ?>
</div><?php
bopper_close_block( $container_args['container'] );
