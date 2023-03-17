<?php
/**
 * Columns with Top Icon
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$icon = get_field('icon');
$label = get_field('label');
$callout_card = get_field('callout_card');
// Create id attribute allowing for custom "anchor" value.
$id = 'columns-with-top-icon-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'columns-with-top-icon';

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
<div class="columns-with-top-icon-main">
    <div class="icon-label-content"><?php
        if( !empty( $icon) ){ ?>
            <div class="icon">
                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
            </div><?php
        }
        if( !empty($label) ){ ?>
            <label class="h4"><?php echo $label; ?></label><?php
        } ?>
    </div>
    <div class="columns-with-top-icon-inner">
        <div class="columns"><?php
            if(have_rows('columns')){
                while(have_rows('columns')){ 
                    the_row();
                    $icon = get_sub_field('icon');
                    $heading = get_sub_field('heading');
                    $content = get_sub_field('content'); ?>
                    <div class="columns-item"><?php
                        if( !empty( $icon) ){ ?>
                            <div class="icon">
                                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
                            </div><?php
                        }
                        if( !empty($heading) ){ ?>
                            <h4><?php echo $heading; ?></h4><?php
                        } 
                        if(!empty($content)){ ?>
                            <div class="content">
                                <?php echo $content; ?>
                            </div><?php
                        } ?>
                    </div><?php
                } 
            }
            if(!empty($callout_card)){ ?>
                <div class="callout-card"><?php
                    foreach( $callout_card as $post )
                    {
                        setup_postdata($post); 
                        $callout_label = get_field('label', $post->ID);
                        $page_link = get_field('page_link', $post->ID); ?>
                        <div class="card">
                                <div class="callout-card-item"><?php
                                    if(!empty($callout_label)){ ?>
                                        <label class="h4"><?php echo $callout_label; ?></label><?php
                                    } ?>
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                </div><?php
                                if ( ! empty( $page_link ) && ! empty( $page_link['url'] ) ){ ?>
                                    <div class="bottom-date-btn text-right">
                                        <a href="<?php echo esc_url( $page_link['url'] ); ?>" class="common-btn sbtn-view stretched-link" target="<?php echo $page_link['target']; ?>">
                                            <svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"/>
                                                <g id="Icon" transform="translate(4.167 4.168)">
                                                    <line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"/>
                                                    <path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div><?php
                                } ?>
                        </div><?php
                    } 
                    wp_reset_postdata(); ?>
                </div><?php
            } ?>
        </div>
    </div>
</div><?php
bopper_close_block( $container_args['container'] );
