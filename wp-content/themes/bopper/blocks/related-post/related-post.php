<?php
/**
 * Related Post
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$header_block = get_field('header_block');
$related_post = get_field('related_post');
if(!empty($related_post)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'related-post-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'related-post';

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
    <div class="related-post-main"><?php
        if( !empty( $header_block)){ 
             bopper_display_block_header($header_block);
        } ?>
        <div class="related-post-inner">
            <div class="related-post-container">
                <div class="related-post-inner-main">
                    <?php
                    global $post; 
                    foreach ($related_post as $post) 
                    { 
                        setup_postdata( $post ); 
                        $categories = get_the_terms( get_the_ID(), 'category' );
                        $category_name = array();
                        if(!empty($categories)){
                            foreach( $categories as $category ) {
                                $category_name[] = $category->name;
                            } 
                        } ?>
                        <div class="blog-list-items">
                            <a href="<?php the_permalink(); ?>">
                                <div class="related-post-item">
                                    <?php 
                                    if ( has_post_thumbnail() ) { ?>
                                        <div class="blog_img">
                                            <?php bopper_post_thumbnail(); ?>
                                        </div><?php 
                                    } ?>
                                    <div class="blog-block-bottom">
                                        <div class="blog_content"><?php
                                            if(!empty($categories)){ ?>
                                                <label><?php echo implode(" | ",$category_name); ?></label><?php
                                            } ?>
                                            <h2 class="blog_heading"><?php echo get_the_title(); ?></h2>
                                        </div>                                
                                        <div class="bottom-date-btn text-right">
                                            <span class="common-btn sbtn-view">
                                                <svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                  <rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"></rect>
                                                  <g id="Icon" transform="translate(4.167 4.168)">
                                                    <line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></line>
                                                    <path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></path>
                                                  </g>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div><?php 
                    } wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}