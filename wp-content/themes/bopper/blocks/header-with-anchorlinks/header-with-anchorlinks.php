<?php
/**
 * Header with Anchorlinks
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');
if(have_rows('anchorlinks')){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'header-with-anchorlinks-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'header-with-anchorlinks';

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
    <div class="header-with-anchorlinks-main"><?php
        if(!empty($block_header )){
            bopper_display_block_header($block_header);
        } ?>
        <div class="header-with-anchorlinks-inner"><?php
            while(have_rows('anchorlinks')){  
                the_row();
                $anchorlink = get_sub_field('anchorlink'); 
                if ( ! empty( $anchorlink ) && ! empty( $anchorlink['url'] ) ) { ?>
                    <div class="anchorlinks">
                        <a href="<?php echo esc_url( $anchorlink['url'] ); ?>" target="<?php echo $anchorlink['target'] ; ?>"><?php echo $anchorlink['title'] ; ?> <svg xmlns="http://www.w3.org/2000/svg" width="11.322" height="14.792" viewBox="0 0 11.322 14.792">
                          <g id="Pointing_arrow" data-name="Pointing arrow" transform="translate(0.661)">
                            <path id="_" data-name="&gt;" d="M5,4.9l-.563.8L5,6.222,5.563,5.7ZM0,1.6,4.437,5.7,5.563,4.1,1.126,0ZM5.563,5.7,10,1.6,8.874,0,4.437,4.1Z" transform="translate(0 7.889)" fill="#2f78e0" stroke="#2f78e0" stroke-width="1"/>
                            <line id="Line_778" data-name="Line 778" y1="11" transform="translate(5)" fill="none" stroke="#2f78e0" stroke-width="3"/>
                          </g>
                        </svg>
                        </a>
                    </div><?php
                }
            } ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}