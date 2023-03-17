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
<div class="case-studies-item">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="blog_img">
           <?php bopper_post_thumbnail(); ?>
        </div>
    <?php } ?>
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
        </div>
    </div>
</div><?php 