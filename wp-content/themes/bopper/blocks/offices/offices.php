<?php
/**
 * Offices
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

if(have_rows('offices')){
    // Create id attribute allowing for custom "anchor" value.
    $id = 'offices-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'offices';

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
    <div class="offices-main">
        <div class="offices-inner">
            <ul><?php
                while(have_rows('offices')){
                    the_row();
                    $office = get_sub_field('office');
                    if(!empty($office )){ ?>
                        <li><?php
                            $permalink = get_permalink( $office );
                            $title = get_the_title( $office );
                            $address = get_field( 'address', $office );
                            $phone_number = get_field( 'phone_number', $office );  ?>
                            
                                <a href="<?php echo $permalink; ?>"><h5><?php echo $title; ?></h5></a><?php
                                if($address){ ?>
                                    <span><?php echo $address; ?></span><?php
                                } 
                                if ( ! empty( $phone_number ) && ! empty( $phone_number['url'] ) ){ ?>
                                    <a href="<?php echo esc_url( $phone_number['url'] ); ?>" class="link-office phone-number-link" target="<?php echo $phone_number['target']; ?>"><?php echo $phone_number['title']; ?></a><?php
                                } ?>
                                <a href="<?php echo get_permalink($office); ?>" class="link-office common-link">Learn more</a>
                            </li>
                        <?php 
                    }
                } ?>
            </ul>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}
