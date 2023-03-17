<?php
/**
 * Template part for displaying reusable card in blocks and archives.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bopper
 */

$title = get_the_title(); 
$description = get_the_content(get_the_ID());
$company_name = get_field('company_name', get_the_ID()); 
$testimonial_type = get_field('testimonial_type', get_the_ID()); 
$testimonial_image = get_field('testimonial_image', get_the_ID());
$testimonial_video = get_field('testimonial_video_type', get_the_ID()); 
$video_poster_image = get_field('video_poster_image', get_the_ID()); 
?>

<div class="testimonials-item <?php if($testimonial_type == 'image-testimonial' && empty($testimonial_image) || $testimonial_type == 'video-testimonial' && empty($testimonial_video)){ echo "without-image"; } ?>">
	<div class="testimonials-item-inner"><?php
	    if ($testimonial_type == 'image-testimonial' && !empty($testimonial_image) && !empty($testimonial_image['url'])) { ?>
	        <div class="test-img-com testimonials-img">
	            <img src="<?php echo esc_url($testimonial_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($testimonial_image['alt']); ?>">
	        </div><?php 
	    } 
	    else { 
	        if(!empty($testimonial_video) && !empty($testimonial_video['url']) && !empty($video_poster_image) && !empty($video_poster_image['url'])) { ?>
		        <div class="test-img-com testimonials-video">
		            <a href="javascript:void(0);" class="video-play-icon" video-url="<?php echo esc_url($testimonial_video['url']); ?>"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/svg-icons/play.svg" alt="<?php echo esc_attr($video_poster_image['alt']); ?>"></a>
		            <img src="<?php echo esc_url($video_poster_image['url']); ?>" class="img-fluid">           
		        </div><?php
			}
	    } ?>
	    <div class="case-study-block-bottom">
	        <div class="news_content"><?php
	            if(!empty($description)){
	            	echo $description; 
	            } ?>   
	            <h2 class="news_heading"><?php echo get_the_title(); ?></h2><?php
	            if(!empty($company_name)){ ?>
	                <div class="company-name">
	                    <?php echo $company_name; ?>
	                </div><?php
	            } ?>
	        </div>
	    </div>
    </div>
</div>