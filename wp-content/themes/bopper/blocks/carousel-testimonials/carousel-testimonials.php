<?php
/**
 * Carousel - Testimonials
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */


// Create id attribute allowing for custom "anchor" value.
$id = 'testimonials-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'testimonials';

if ( ! empty( $block['className'] ) ) {
	$section_class_name .= ' ' . $block['className'];
}

$label = get_field('label');

// Start a <container> with possible block options.
$container_args = [
	'container' => 'section', // Any HTML5 container: section, div, etc...
	'id'        => $id, // Container id.
	'class'     => $section_class_name, // Container class.
];

bopper_display_block_background_options( $block, $container_args );
$testimonials = get_field('testimonials');
if($testimonials)
{ ?>
	<div class="testimonials-main swiper testimonials-swiper">
        <div class="swiper-wrapper"><?php
            $videoindex = 1;
    		global $post; 
            foreach ($testimonials as $post) 
            {
    			setup_postdata( $post ); 
    			$title = get_the_title(); 
                $description = get_the_content(get_the_ID());
                $company_name = get_field('company_name', get_the_ID()); 
                $testimonial_type = get_field('testimonial_type', get_the_ID()); 
                $testimonial_image = get_field('testimonial_image', get_the_ID());
                $testimonial_video = get_field('testimonial_video_type', get_the_ID()); 
                $video_poster_image = get_field('video_poster_image', get_the_ID()); ?>
                <div class="testimonials-item swiper-slide">
                    <div class="testimonials-item-inner row"><?php
                        if ($testimonial_type == 'image-testimonial' && !empty($testimonial_image) && !empty($testimonial_image['url'])) { ?>
                            <div class="col-lg-6 ">
                                
                                 <div class="test-img-com testimonials-img">
                               <img src="<?php echo esc_url($testimonial_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($testimonial_image['alt']); ?>">
                            </div>
                            </div>
                           

                            <?php 
                        } 
                        else { 
                            if(!empty($testimonial_video) && !empty($testimonial_video['url']) && !empty($video_poster_image['url'])) {  ?>
                                
                                    <div class="col-lg-6 ">
      <div class="test-img-com testimonials-video">
                                    <a href="javascript:void(0);" class="video-play-icon" data-index="<?php echo "videoindex-".$videoindex; ?>" video-url="<?php echo esc_url($testimonial_video['url']); ?>"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/svg-icons/play.svg"></a>
                                    <img src="<?php echo esc_url($video_poster_image['url']); ?>" class="img-fluid">           
                                </div>                                        
                                    </div>
                                
                               
                              

                                <?php
                            }
                        } ?>

                        <div class="col-lg-6 ">
                        <div class="case-study-block-bottom"><?php
                            if($label){ ?>
                                <h5><?php echo $label; ?></h5><?php
                            } ?>
                            <div class="news_content"><?php
                                if($description){ 
                                    echo $description;
                                } ?>   
                                <h2 class="news_heading"><?php echo get_the_title(); ?></h2><?php
                                if($company_name){ ?>
                                    <div class="company-name">
                                        <?php echo $company_name; ?>
                                    </div><?php
                                } ?>
                            </div>
                        </div>
                         </div>
                    </div>
                </div><?php
                if(!empty($testimonial_video['url']) && $testimonial_type == 'video-testimonial'){ ?>
                    <?php
                }
                $videoindex++; 
            } wp_reset_postdata(); ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="modal-popup testimonials for-video" style="display: none;">
        <div class="video-outer">
            <div class="video-cross-icon"></div>
            <video class="bgnw-video" muted controls>
                <source src="" type="video/mp4">
                <source src="" type="video/webm">
            </video>
        </div>
    </div><?php
}
bopper_close_block( $container_args['container'] ); ?>
 

