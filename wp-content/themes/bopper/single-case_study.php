<?php
/**
 * The template for displaying all single case studies posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */

get_header(); 
$subheading = get_field('subheading');
$homepage_screenshot = get_field('homepage_screenshot');
$related_case_study = get_field('related_case_study');
$challenge = get_field('challenge');
$solution = get_field('solution');  ?>
<div class="rightsideicons">
    <?php echo do_shortcode('[addtoany]'); ?>
</div>
<div class="portfolio-detail case-studies-retrain">
    <div class="portfolio-detail-banner">
       <div class="container">
    	  <h1><?php the_title(); ?></h1><?php
            if(!empty($subheading)){ ?>
                <h5><?php echo $subheading; ?></h5><?php
            } 
            if(!empty($homepage_screenshot) && !empty($homepage_screenshot['url'])){ ?>
                <div class="thumbnail-image">
                    <div class="thumbnail-image-outer">
                        <img src="<?php echo esc_url($homepage_screenshot['url']); ?>">
                    </div>
                </div><?php
            } ?>
        </div>
    </div>
            <?php
        if(!empty($related_case_study)){ 
            if(have_rows('stats', $related_case_study)){ ?>
                <div class="case-studies-stats-sec">
                    <div class="container">
                        <div class="case-studies-detail">
                            <div class="stats-row"><?php
                                while(have_rows('stats', $related_case_study)){ 
                                    the_row(); 
                                    $prefix = get_sub_field('prefix');
                                    $stat = get_sub_field('stat');
                                    $suffix = get_sub_field('suffix');
                                    $stats_content = get_sub_field('stats_content'); ?>
                                    <div class="stats-item">
                                        <div class="prefix"><?php 
                                            if (!empty($stats_content)) 
                                            { ?>
                                                <p><?php echo esc_html( $stats_content ); ?></p><?php
                                            } ?>
                                            <h3><?php echo esc_html( $prefix ); ?><span class="stat count"><?php echo esc_html( $stat ); ?></span><?php echo esc_html( $suffix ); ?></h3>
                                        </div>
                                    </div><?php
                                } ?>
                            </div>
                            <div class="case-studies-bttom">
                              <p>*Comparing 3 months after site launch to year prior (4/4/22 - 7/4/22 vs. 4/4/21 - 7/4/21)</p>
                            </div>
                        </div>
                    </div>
                </div><?php
            } 
        } 
        if(!empty($challenge)){ ?>
            <div class="challenge-sec">
                <div class="container">
                    <div class="challenge">
                        <?php echo $challenge; ?>
                    </div>
                </div>
            </div><?php
        } 
        if(!empty($solution)){ ?>
            <div class="solution-sec">
                <div class="container">
                    <div class="solution">
                        <?php echo $solution; ?>
                    </div>
                </div>
            </div><?php
        } 
        if(have_rows('results')){
            while(have_rows('results')){
                the_row(); 
                $result_content = get_sub_field('result_content');
                $result_link = get_sub_field('result_link');
                $what_we_did_heading = get_sub_field('what_we_did_heading'); ?>
                <div class="results">
                    <div class="container">
                        <div class="results-retrain"><?php
                            if(!empty($result_content)){ ?>
                                <div class="left-side-content">
                                    <?php echo $result_content; ?>
                                </div><?php
                            } 
                            if(have_rows('what_we_did')){ ?>
                                <div class="right-side-content"><?php
                                    if(!empty($what_we_did_heading)){ ?>
                                        <h5><?php echo $what_we_did_heading; ?></h5><?php
                                    }
                                    while(have_rows('what_we_did')){
                                        the_row();
                                        $list_item = get_sub_field('list_item'); 
                                        if(!empty($list_item) && !empty($list_item['url'])){ ?>
                                            <div class="right-side-links">
                                                <a href="<?php echo esc_url($list_item['url']); ?>" target="<?php echo $list_item['target']; ?>"><?php echo $list_item['title']; ?></a>
                                            </div><?php
                                        }
                                    } 
                                    if(!empty($result_link) && !empty($result_link['url'])){ ?>
                                        <div class="right-side-links">
                                            <a href="<?php echo esc_url($result_link['url']); ?>" class="common-link live-site-btn" target="<?php echo $result_link['target']; ?>"><?php echo $result_link['title']; ?></a>
                                        </div><?php                 
                                    } ?>

                                </div><?php
                            } ?>         
                        </div>               
                    </div>
                </div><?php
            }
        } ?>
        <main id="main" class="site-main site-content wp-block-group" role="main"><?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );

                get_template_part( 'template-parts/content', 'page' );

            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
</div>
<?php
get_footer(); ?>