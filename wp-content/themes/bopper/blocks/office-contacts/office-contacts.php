<?php
/**
 * Office Contacts
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
$heading = get_field('heading');
$content = get_field('content');
$button = get_field('button');
$google_maps_photo = get_field('google_maps_photo');
$virtual_tour_embed = get_field('virtual_tour_embed');
$form = get_field('form');
if(!empty($icon) && !empty($label) && !empty($heading) && !empty($content) && !empty($button) && !empty($google_maps_photo) && !empty($virtual_tour_embed) && !empty($form)){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'office-contacts-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'office-contacts';

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
    <div class="office-contacts-main">
        <div class="office-contacts-inner">
            <div class="container">
                <div class="office-contacts-top">
                    <div class="left-side-content"><?php
                        if(!empty($icon)){ ?>
                           <div class="icon"> <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>"></div><?php
                        } 
                        if(!empty($label)){ ?>
                            <label class="h4"><?php echo $label; ?></label><?php
                        } 
                        if(!empty($heading)){ ?>
                            <h2><?php echo $heading; ?></h2>
                            <span class="gradient-line"></span>
                            <?php
                        } 
                        if(!empty($content)){ ?>
                            <div class="intro_text">
                            <p><?php echo $content; ?></p></div><?php
                        } 
                        if ( ! empty( $button ) && ! empty( $button['url'] ) ){ ?>
                            <a href="<?php echo esc_url( $button['url'] ); ?>" class="wp-block-button__link wp-element-button office-contacts-btn" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a><?php
                        } ?>
                    </div>
                    <div class="right-side-content"><?php
                        if(!empty($google_maps_photo) && !empty($google_maps_photo['url'])){ ?>
                            <div class="google-maps-photo">
                                <img src="<?php echo $google_maps_photo['url']; ?>">
                            </div><?php
                        } ?>
                    </div>
                </div>
            </div><?php
            if(!empty($virtual_tour_embed)){ ?>
                <div class="virtual-tour-embed-bg">
                    <div class="container">
                        <div class="virtual-tour-embed">
                            <?php echo $virtual_tour_embed; ?>
                        </div>
                    </div>
                </div><?php
            } 
            if($form){ ?>
                <div class="form-content page-contact">
                    <div class="office-contacts-form">
                        <?php echo do_shortcode( '[gravityform id="' . $form . '" title="false" ajax="true"]' ); ?>
                    </div>
                </div><?php
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}
