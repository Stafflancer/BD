<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */

get_header(); 
$subheading = get_field('subheading');
$description = get_field('description');
$button_to_live_site = get_field('button_to_live_site');
$portfolio_image = get_field('portfolio_image');
$related_case_study = get_field('related_case_study');
$related_before_after = get_field('related_before_after');  ?>
<section class="rightsideicons">
    <?php echo do_shortcode('[addtoany]'); ?>
</section>
<section class="common-detail-page portfolio-detail">
    <div class="portfolio-detail-banner">
	   <div class="container">
    		<div class="breadcrumbs">
    			<?php bopper_display_breadcrumbs(); ?>
    		</div>
    		<h1><?php the_title(); ?></h1><?php
            if(!empty($subheading)){ ?>
               <h4><?php echo $subheading; ?></h4><?php
            } 
            if(!empty($description)){ ?>
                <div class="description">
                	<?php echo $description ?>
                </div><?php
            }
            if (!empty($portfolio_image)) { ?>
            	<div class="thumbnail-image">
            		<div class="thumbnail-image-outer"><?php echo wp_get_attachment_image($portfolio_image, $size='full'); ?></div>
            	</div><?php
            } ?>
        </div>
    </div>
    <div class="container"><?php
        if(!empty($related_case_study)){ 
            if(have_rows('stats', $related_case_study)){ ?>
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
                    <div class="case-studies-btn">
                        <a href="<?php echo get_permalink($related_case_study); ?>" class="wp-block-button__link wp-element-button">Read the case study</a>
                    </div>
                </div><?php
            } 
        } 
        if(have_rows('featured_assets')){ 
            $featured_assets_size = 'full'; ?>
            <div class="featured-assets"><?php
                while(have_rows('featured_assets')){
                    the_row(); 
                    $screenshots = get_sub_field('screenshots');
                    $featured_assets_content = get_sub_field('featured_assets_content'); 
                    if(!empty($screenshots)){
                        foreach( $screenshots as $image_id ){ ?>
                            <div class="featured-assets-item">
                                 <?php echo wp_get_attachment_image( $image_id, $featured_assets_size ); ?>
                            </div><?php
                        }
                    }
                    if(!empty($featured_assets_content)){ ?>
                        <div class="featured-assets-content">
                            <?php echo $featured_assets_content; ?>
                        </div><?php
                    } 
                } ?>
            </div><?php
        }
        if(!empty($button_to_live_site) && !empty($button_to_live_site['url'])){ ?>
            <div class="go-to-live-btn">
                <a href="<?php echo esc_url($button_to_live_site['url']); ?>" class="wp-block-button__link wp-element-button"><?php echo $button_to_live_site['title']; ?></a>
            </div><?php
        }
        if(!empty($related_before_after)){ 
            $title = get_the_title($related_before_after);
            $short_description = get_the_excerpt($related_before_after);
            $before_after_taxnomoy = get_the_terms( $related_before_after, 'industry' );
            if(!empty($before_after_taxnomoy)){ 
                $before_after_terms = join(' | ', wp_list_pluck($before_after_taxnomoy, 'name'));
            } ?>
           <div class="before-after-outer"><?php
                if(have_rows('preview_images', $related_before_after)){ ?>
                    <div class="blog_img before-after">
                        <div class="cd-image-container"><?php
                           while(have_rows('preview_images', $related_before_after)){
                                the_row();
                                $before_image = get_sub_field('before_image');
                                $after_image = get_sub_field('after_image');
                                if(!empty($before_image) && !empty($before_image['url'])) { ?>

                                    <img src="<?php echo $before_image['url']; ?>">
                                    <span class="cd-image-label" data-type="original"></span><?php
                                } 
                                if(!empty($after_image) && !empty($after_image['url'])) {  ?>
                                    <div class='cd-resize-img'>
                                        <img src="<?php echo $after_image['url']; ?>">
                                        <span class="cd-image-label" data-type="modified"></span>
                                    </div><?php
                                } 
                            } ?>
                            <span class="cd-handle"><div></div></span>
                        </div>
                    </div><?php 
                } ?>
                <div class="case-studies-contain">
                    <div class="case-studies-contain-inner">
                        <div class="title-holder">
                            <div class="title large-body-text">
                                <h3><a href="<?php echo get_permalink(); ?>"><?php echo $title; ?></a></h3><?php
                                if(!empty($before_after_terms)){ ?>
                                    <label><?php echo $before_after_terms; ?></label><?php
                                }
                                if($short_description){ ?>
                                    <p><?php echo $short_description;  ?></p><?php
                                } ?>
                                <a href="<?php echo get_permalink($related_before_after); ?>" class="learn-more">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php
        } ?>
    </div>
    <div class="navigation max-width-nav">
        <div class="pagination-set">
            <div class="pagination-bottom d-flex justify-content-center pagination">
                    <?php
                    $prev_post = get_previous_post();
                    if ( $prev_post ) {
                        $prev_title = strip_tags( str_replace( '"', '', $prev_post->post_title ) );
                        echo "\t" . '<a id="prev" rel="prev" href="' . get_permalink( $prev_post->ID ) . '" title="' . $prev_title . '" class="prev page-numbers">
                            Previous</a>' . "\n";
                    } ?><?php
                    $next_post = get_next_post();
                    if ( $next_post ) {
                        $next_title = strip_tags( str_replace( '"', '', $next_post->post_title ) );
                        echo "\t" . '<a id="next" rel="next" href="' . get_permalink( $next_post->ID ) . '" title="' . $next_title . '" class="next page-numbers">Next</a>' . "\n";
                    }
                    ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer(); ?>