<?php
/**
 * Meet the Team
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$label = get_field('label');
$heading = get_field('heading');
$content = get_field('content'); 
$team = get_field('team');
if(!empty($team)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'meet-the-team-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'meet-the-team';

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
    <div class="meet-the-team-main">
        <div class="meet-the-team-first"><?php
                if(!empty($label)){ ?>
                    <label><?php echo $label; ?></label><?php
                }
                if(!empty($heading)){ ?>
                    <h2><?php echo $heading; ?></h2><?php
                }
                if(!empty($content)){ ?>
                    <div class="paragraph">
                        <?php echo $content; ?>
                    </div><?php
                } ?>
            </div>
        <div class="meet-the-team-inner">
            <?php
            global $post; 
            foreach ($team as $post) 
            {
                setup_postdata( $post ); 
                $member_role = get_field('member_role', get_the_ID()); ?>
                <a href="<?php echo get_the_permalink(); ?>" class="team-link">
                    <div class="our-teams">
                        <div class="latest-posts-item-inner"><?php
                            if ( has_post_thumbnail() ) { ?>
                                <div class="thumbnail_ava">
                                    <span class="line-animation"></span>
                                    <span class="line-animation-1"></span>
                                    <?php bopper_post_thumbnail(); ?>
                                </div><?php 
                            } ?>
                            <div class="teams-bottom">
                                <h3 class="teams_heading"><?php echo get_the_title(); ?></h3><?php
                                if($member_role){ ?>
                                    <label><?php echo $member_role; ?></label><?php
                                }  ?> 
                            </div>
                        </div>
                    </div>
                </a><?php
            } 
            wp_reset_postdata(); ?>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}