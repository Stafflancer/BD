<?php
/**
 * Related Case Studies
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$case_studies = get_field('case_studies');
$latest = get_field('latest');
if(!empty($case_studies) && $latest == 1)
{ 
    // Create id attribute allowing for custom "anchor" value.
    $id = 'related-case-studies-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'related-case-studies';

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
    $header_block = get_field('block_header');
    if($header_block){
    	bopper_display_block_header($header_block);
    }?>
	<div class="case-studies-main">
        <div class="case-studies-inner">
            <div class="case-studies-inner-items"><?php
        		global $post; 
                foreach ($case_studies as $post) 
                {
        			setup_postdata( $post ); 
        			$title = get_the_title();
        			$desktop_image = get_field('desktop_image', get_the_ID());
        			$mobile_image = get_field('mobile_image', get_the_ID()); 
        			$term_obj_list = get_the_terms( $post->ID, 'industry' );
                    if(!empty($term_obj_list)){
        			     $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name')); 
                    } ?>
                    <div class="case-studies-item"><?php
                        if(!empty($desktop_image) && !empty($desktop_image['url']))
                        { ?>
                            <div class="thumbnail_ava desktop-image">
                                <a href="<?php echo get_permalink(); ?>"><img src="<?php echo esc_url($desktop_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($desktop_image['alt']); ?>"></a>
                            </div><?php
                        } 
                        if(!empty($mobile_image) && !empty($mobile_image['url']))
                        { ?>
                            <div class="thumbnail_ava mobile-image" style="display: none;">
                                <a href="<?php echo get_permalink(); ?>"><img src="<?php echo esc_url($mobile_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($mobile_image['alt']); ?>"></a>
                            </div><?php
                        } ?>
                        <div class="case-studies-contain">
                            <div class="case-studies-contain-inner">
                                <div class="title-holder">
                                    <div class="title large-body-text">
                                        <h3><a href="<?php echo get_permalink(); ?>"><?php echo $title; ?></a></h3><?php
                                        if(!empty($terms_string)){ ?>
                                        	<label><?php echo $terms_string; ?></label><?php
                                        } ?>
                                        <p><?php echo bopper_get_the_excerpt();  ?></p>
                                        <a href="<?php echo get_permalink(); ?>" class="learn-more">Learn More
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7.658" height="11.322" viewBox="0 0 7.658 11.322">
                                              <path id="_" data-name="&gt;" d="M5,4.9l-.563.8L5,6.222,5.563,5.7ZM0,1.6,4.437,5.7,5.563,4.1,1.126,0ZM5.563,5.7,10,1.6,8.874,0,4.437,4.1Z" transform="translate(0.755 10.661) rotate(-90)" fill="#2f78e0" stroke="#2f78e0" stroke-width="1"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                            if(have_rows('stats', get_the_ID())){ ?>
                                <div class="stats-row"><?php
                                    while(have_rows('stats', get_the_ID()))
                                    { 
                                        the_row(); 
                                        $prefix = get_sub_field('prefix');
                                        $stat = get_sub_field('stat');
                                        $suffix = get_sub_field('suffix');
                                        $stats_content = get_sub_field('stats_content'); ?>
                                        <div class="stats-item">
                                            <div class="prefix">
                                                <h3><?php echo esc_html( $prefix ); ?><span class="stat count"><?php echo esc_html( $stat ); ?></span><?php echo esc_html( $suffix ); ?></h3><?php 
                                                if (!empty($stats_content)) 
                                                { ?>
                                                    <p><?php echo esc_html( $stats_content ); ?></p><?php
                                                } ?>
                                            </div>
                                         </div><?php
                                    } ?>
                                </div><?php
                            } ?>
                        </div>
                    </div><?php 
                } wp_reset_postdata(); ?>                 
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}