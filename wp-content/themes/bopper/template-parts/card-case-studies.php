<?php
/**
 * Template part for displaying reusable card in blocks and archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bopper
 */

$title = get_the_title();
$short_description = bopper_get_the_excerpt();
$desktop_image = get_field('desktop_image');
$mobile_image = get_field('mobile_image'); 
$term_obj_list = get_the_terms( get_the_ID(), 'industry' );
if(!empty($term_obj_list)){ 
	$terms_string = join(' | ', wp_list_pluck($term_obj_list, 'name'));
}  ?>
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
                        <label><?php echo "B2B WEBSITE REDESIGN FOR ".$terms_string; ?></label><?php
                    }
                    if($short_description){ ?>
                        <p><?php echo $short_description;  ?></p><?php
                    } ?>
                    <a href="<?php echo get_permalink(); ?>" class="learn-more">Learn More</a>
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
                            if ($stats_content) 
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