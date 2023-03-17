<?php
/**
 * Single Testimonial
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$testimonial = get_field('testimonial');
if(!empty($testimonial)){ 
    // Create id attribute allowing for custom "anchor" value.
    $id = 'single-testimonial-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'single-testimonial';

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
    <div class="single-testimonial-main">
        <div class="single-testimonial-inner"><?php
            foreach( $testimonial as $post )
            {
                setup_postdata($post); 
                $description = get_the_content($post->ID);
                $company_name = get_field('company_name', $post->ID);  ?>
                <div class="case-study-block-bottom">
                    <h5>OUR CLIENTS SAY IT BEST</h5>
                    <div class="news_content"><?php
                        if($description){ 
                            echo $description;
                        } ?>   
                        <h2 class="news_heading"><?php echo get_the_title($post->ID); ?></h2><?php
                        if($company_name){ ?>
                            <div class="company-name">
                                <?php echo $company_name; ?>
                            </div><?php
                        } ?>
                     </div>
                </div><?php  
            } 
            wp_reset_postdata(); ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}
