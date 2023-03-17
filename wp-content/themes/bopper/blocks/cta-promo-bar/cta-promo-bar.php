<?php
/**
 * CTA - Promo Bar
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$heading = get_field('heading'); 
$button = get_field('button');
if($heading || $button){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'cta-promo-bar-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'cta-promo-bar';

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
    <div class="cta-promo-bar-main">
        <div class="cta-promo-bar-inner"><?php
            if($heading){ ?>
                <h3><?php echo $heading; ?></h3><?php
            } 
            if(!empty($button) && !empty($button['url'])){?>
                <div class="cta-promo-bar-btn">
                    <a href="<?php echo esc_url( $button['url'] ); ?>" class="common-btn sbtn-view bop-design-arrow stretched-link">
                        <svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"></rect><g id="Icon" transform="translate(4.167 4.168)"><line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></line><path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></path></g>
                        </svg>
                    </a>
                </div><?php
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}