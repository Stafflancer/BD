<?php
/**
 * Latest posts
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'latest-posts-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'latest-posts';

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
}
$posts = get_field('posts');
if($posts)
{ ?><div class="latest-posts-main">
        <div class="latest-posts-container">
        	<div class="latest-posts-main-slider swiper mySwiper">
                <div class="swiper-wrapper"><?php
            		global $post; 
                    foreach ($posts as $post) 
                    {
            			setup_postdata( $post ); 
            			$title = get_the_title(); 
                        $term_obj_list = get_the_terms( $post->ID, 'category' );
                        $terms_string = join(' | ', wp_list_pluck($term_obj_list, 'name')); ?>
                        <a href="<?php the_permalink(); ?>" class="swiper-slide">
                            <div class="latest-posts-item"><?php
                                    if ( has_post_thumbnail() ) { ?>
                                        <div class="thumbnail_ava">
                                           <?php bopper_post_thumbnail(); ?>
                                        </div><?php 
                                    } ?>
                                    <div class="case-study-block-bottom">
                                        <div class="news_content"><?php
                                            if($terms_string){ ?>
                                                <label><?php echo $terms_string; ?></label><?php
                                            }  ?>                    
                                            <h2 class="news_heading"><?php echo get_the_title(); ?></h2>
                                        </div>
                                         <div class="bottom-date-btn text-right">
                                            <span class="common-btn sbtn-view"><svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                              <rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"/>
                                              <g id="Icon" transform="translate(4.167 4.168)">
                                                <line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"/>
                                                <path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"/>
                                              </g>
                                            </svg></span>
                                        </div>
                                    </div>
                            </div>
                        </a><?php 
                    } wp_reset_postdata(); ?>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="d-flex justify-content-center">
                <?php
                $button = get_field( 'button');
                if(!empty($button) && !empty($button['url'])){ ?>
                   <a href="<?php echo esc_url( $button['url'] ); ?>" class="wp-block-button__link wp-element-button" target="<?php echo $button['target'] ; ?>"><?php echo $button['title'] ; ?></a><?php
                }?>
            </div>
        </div>
    </div><?php
}
bopper_close_block( $container_args['container'] ); ?>