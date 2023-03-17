<?php
/**
 * Job Openings
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$block_header = get_field('block_header');
$jobs = get_field('jobs');
if(!empty($jobs)){

    // Create id attribute allowing for custom "anchor" value.
    $id = 'job-openings-' . $block['id'];

    if ( ! empty( $block['anchor'] ) ) {
    	$id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className".
    $section_class_name = 'job-openings';

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
    <div class="job-openings-main"><?php
        if(!empty($block_header )){
            bopper_display_block_header($block_header);
        } ?>
        <div class="job-openings-inner">
            <div id="accordion"><?php
                $toggleindex = 1;
                global $post; 
                foreach ($jobs as $post) 
                {  
                    setup_postdata( $post ); 
                    $city = get_field('city', $post->ID);
                    $state = get_field('state', $post->ID); 
                    $remote = get_field('remote', $post->ID); 
                    $job_type = get_field('job_type', $post->ID); 
                    $share = get_field('share', $post->ID); 
                    $see_full_role_description = get_field('see_full_role_description', $post->ID); 
                    $job_openings_button = get_field('job_openings_button', $post->ID); 
                    $description = get_the_excerpt(); ?>
                    <div class="collapsDiv pannel-tab faq-toggle">
                        <button class="accordion panel-heading <?php if($toggleindex == 1){ echo "open"; } ?>">
                            <div class="job-openings-content">
                                <h3><?php echo get_the_title(); ?></h3>
                                <div class="job-openings-location"><?php
                                    if($city || $state || $remote){ ?>
                                        <span><?php
                                            if($city){ echo $city; } if($state){ echo ' ,'.$state; } if($remote){ echo ' OR'.$remote; } ?>
                                        </span><?php
                                    } 
                                    if($job_type){ ?>
                                        <span><?php echo $job_type; ?></span><?php
                                    } ?>
                                </div>
                            </div>
                            <div class="job-openings-date">
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                        </button>
                        <div class="panel panel-content" <?php if($toggleindex == 1){ echo 'style="display: block;"'; } else { echo 'style="display: none;"'; } ?>>
                            <div class="links-share"><?php
                                if(!empty($see_full_role_description) && !empty($see_full_role_description['url'])){ ?>
                                    <a href="<?php echo esc_url( $see_full_role_description['url'] ); ?>" class="common-btn-link full-discri" target="<?php echo $see_full_role_description['target'] ; ?>"><?php echo $see_full_role_description['title'] ; ?></a><?php
                                } 
                                if(!empty($share) && !empty($share['url'])){ ?>
                                    <a href="<?php echo esc_url( $share['url'] ); ?>" class="common-btn-link share-icon" target="<?php echo $share['target'] ; ?>"><?php echo $share['title'] ; ?> <svg xmlns="http://www.w3.org/2000/svg" width="12.535" height="15.168" viewBox="0 0 12.535 15.168">
  <g id="Icon_feather-share" data-name="Icon feather-share" transform="translate(-5 -2)">
    <path id="Path_58136" data-name="Path 58136" d="M6,18v5.267a1.317,1.317,0,0,0,1.317,1.317h7.9a1.317,1.317,0,0,0,1.317-1.317V18" transform="translate(0 -8.416)" fill="none" stroke="#2e77dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
    <path id="Path_58137" data-name="Path 58137" d="M17.267,5.634,14.634,3,12,5.634" transform="translate(-3.366)" fill="none" stroke="#2e77dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
    <path id="Path_58138" data-name="Path 58138" d="M18,3v8.559" transform="translate(-6.733)" fill="none" stroke="#2e77dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
  </g>
</svg>
</a><?php
                                } ?>
                            </div>
                            <?php
                            if($description){ ?>
                                <div class="pannel-in">
                                    <p><?php echo $description; ?></p>
                                </div><?php
                            } 
                            if(!empty($job_openings_button) && !empty($job_openings_button['url'])){ ?>
                               <a href="<?php echo esc_url( $job_openings_button['url'] ); ?>" class="wp-block-button__link wp-element-button" target="<?php echo $job_openings_button['target'] ; ?>"><?php echo $job_openings_button['title'] ; ?></a><?php
                            } ?>
                        </div>
                    </div><?php
                    $toggleindex++;
                } wp_reset_postdata(); ?>
            </div>
        </div>
    </div><?php
    bopper_close_block( $container_args['container'] );
}