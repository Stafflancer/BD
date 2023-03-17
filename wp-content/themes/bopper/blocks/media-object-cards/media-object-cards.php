<?php
/**
 * Media Object Cards
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

if(have_rows('cards')){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'media-object-cards-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'media-object-cards';

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
    <div class="media-object-cards-main">
        <div class="media-object-cards-inner"><?php
            $i = 1;
            while(have_rows('cards')){
                the_row();
                $heading = get_sub_field('heading');
                $content = get_sub_field('content');
                $media = get_sub_field('media'); ?>
                <div class="media-object-cards-item <?php if(empty($media)){ echo ' image-added '; } if($i % 2 == 0){   echo "leftside";  } else{ echo "rightside"; } ?>"><?php
                    if(!empty($heading) && !empty($content)){ ?>
                        <div class="object-content"><?php
                            if(!empty($heading)){ ?><h4><?php echo $heading; ?></h4><?php } 
                            if(!empty($content)){ ?>
                                <div class="media-object-cards-content">
                                    <?php echo $content; ?>
                                </div><?php
                            } ?>
                        </div><?php
                    }
                    if(!empty($media)){ ?>
                        <div class="object-image">
                            <?php echo wp_get_attachment_image($media, $size = 'large'); ?>
                        </div><?php
                    } ?>
                </div><?php
                $i++;
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}