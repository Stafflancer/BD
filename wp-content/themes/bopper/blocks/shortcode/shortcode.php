<?php
/**
 * Shortcode
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$icon = get_field('icon');
$heading = get_field('heading');
$search_form_shortcode = get_field('search_form_shortcode');
$search_form_results = get_field('search_form_results');
if(!empty($search_form_shortcode) || !empty($search_form_results)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'shortcode-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'shortcode';

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
    <div class="shortcode-main">
        <div class="shortcode-inner">
            <div class="shortcode-content">
                <div class="shortcode-content-outer"><?php
                    if( !empty( $icon) ){ ?>
                        <div class="icon">
                            <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
                        </div><?php
                    }
                    if( !empty($heading) ){ ?>
                        <label class="h4"><?php echo $heading; ?></label><?php
                    } ?>
                    <span class="gradient-line"></span>
                </div>
            </div>
            <div class="shortcode-box-outer" id="shortcode_result"><?php
                if(!empty($search_form_shortcode)){ ?>
                    <div class="shortcode-filter">
                        <div class="shortcode-filter-inner">
                            <?php echo $search_form_shortcode; ?>
                        </div>
                    </div><?php
                } 
                if(!empty($search_form_results)){ ?>
                    <div class="shortcode-result">
                        <?php echo $search_form_results; ?>
                    </div><?php
                } ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}