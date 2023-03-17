<?php
/**
 * Content + Media
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

if(have_rows('content_rows')){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'content-media-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'content-media';

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
    <div class="content-media-main">
        <div class="content-media-inner">
            <div class="content-media-content"><?php
                $i = 1;
                while(have_rows('content_rows'))
                {
                    the_row();
                    $heading = get_sub_field('heading');
                    $content = get_sub_field('content');
                    $media = get_sub_field('media'); ?>
                    <div class="content-media-item <?php if($i % 2 == 0){   echo "leftside";  } else{ echo "rightside"; } ?>"><?php
                        if(!empty($heading) && !empty($content)){ ?>
                            <div class="media-content"><?php
                                if(!empty($heading)){ ?><h4><?php echo $heading; ?></h4><?php }
                                if(!empty($content)){ ?>
                                    <div class="content">
                                        <?php echo $content; ?>
                                    </div><?php
                                } ?>
                            </div><?php
                        } ?>
                        <div class="thumbnail_ava"> <?php
                        if(!empty($media)){
                            echo wp_get_attachment_image( $media, $size = 'full' );
                        } ?></div>
                    </div><?php
                    $i++;
                } ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}