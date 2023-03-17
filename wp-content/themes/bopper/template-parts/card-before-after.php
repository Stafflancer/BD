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
$term_obj_list = get_the_terms( get_the_ID(), 'industry' );
if(!empty($term_obj_list)){ 
	$terms_string = join(' | ', wp_list_pluck($term_obj_list, 'name'));
}  ?>
<div class="case-studies-item before-after-outer"><?php
    if(have_rows('preview_images')){ ?>
        <div class="blog_img before-after">
            <div class="cd-image-container"><?php
               while(have_rows('preview_images')){
                the_row();
                    $before_image = get_sub_field('before_image');
                    $after_image = get_sub_field('after_image');
                    if(!empty($before_image) && !empty($before_image['url'])) { ?>

                        <img src="<?php echo $before_image['url']; ?>" alt="Original Image">
                        <span class="cd-image-label" data-type="original"></span><?php
                    } 
                    if(!empty($after_image) && !empty($after_image['url'])) {  ?>
                        <div class='cd-resize-img'>
                            <img src="<?php echo $after_image['url']; ?>">
                            <span class="cd-image-label" data-type="modified"></span>
                        </div><?php
                    } 
                } ?>
                <span class="cd-handle"><div></div></span>
            </div>
        </div><?php 
    } ?>
    <div class="case-studies-contain">
        <div class="case-studies-contain-inner">
            <div class="title-holder">
                <div class="title large-body-text">
                    <h3><a href="<?php echo get_permalink(); ?>"><?php echo $title; ?></a></h3><?php
                    if(!empty($terms_string)){ ?>
                        <label><?php echo $terms_string; ?></label><?php
                    }
                    if($short_description){ ?>
                        <p><?php echo $short_description;  ?></p><?php
                    } ?>
                    <a href="<?php echo get_permalink(); ?>" class="learn-more">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div><?php 