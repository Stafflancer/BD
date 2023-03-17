<?php
/**
 * The template for displaying all single before after posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */

get_header(); 
$subheading = get_field('subheading');
$description = get_field('description'); 
$related_case_study = get_field('related_case_study'); ?>
<section class="rightsideicons">
	<?php echo do_shortcode('[addtoany]'); ?>
</section>
<section class="common-detail-page before-after-detail">
    <div class="portfolio-detail-banner">
        <figure class="has-pattern-show" style="background-image:url(https://dev-bopdesign.pantheonsite.io/wp-content/uploads/2023/01/Pattern-base-1.svg);"></figure>
    	<div class="container">
    		<div class="breadcrumbs">
    			<?php bopper_display_breadcrumbs(); ?>
    		</div>
    		<h1><?php the_title(); ?></h1><?php
            if(!empty($subheading)){ ?>
               <h4><?php echo $subheading; ?></h4><?php
            } ?>
            <span class="gradient-line gradient-line-center"></span><?php
            if(!empty($description)){ ?>
                <div class="description">
                	<?php echo $description ?>
                </div><?php
            }
            if(have_rows('preview_images')){ ?>
            	<div class="blog_img before-after">
                    <div class="cd-image-container"><?php
    	        		while(have_rows('preview_images')){
    	        			the_row();
    	        			$before_image = get_sub_field('before_image');
    	        			$after_image = get_sub_field('after_image'); 
    	        			if(!empty($before_image) && !empty($before_image['url'])){ ?>
    		        			<img src="<?php echo esc_url($before_image['url']); ?>">
    		        			<span class="cd-image-label" data-type="original"></span><?php
    		        		} 
    		        		if(!empty($after_image) && !empty($after_image['url'])){ ?>
    		        			<div class='cd-resize-img'>
    			        			<img src="<?php echo esc_url($after_image['url']); ?>">
    			        			<span class="cd-image-label" data-type="modified"></span>
    			        		</div><?php
    		        		} 
    	        		} ?>
    	        		 <span class="cd-handle"><div></div></span>
            		</div>
            	</div><?php 
            } ?>
        </div>
    </div>
    <div class="container"><?php 
        if(have_rows('featured_assets')){ 
            $featured_assets_size = 'full'; ?>
            <div class="featured-assets featured-assets-before-after"><?php
                while(have_rows('featured_assets')){
                    the_row(); 
                    $asset_heading = get_sub_field('asset_heading');
                    $asset_before_image = get_sub_field('before_image'); 
                    $asset_after_image = get_sub_field('after_image'); 
                    $featured_assets_content =  get_sub_field('content'); ?>
                    <div class="featured-assets-item-inner"><?php 
                        if(!empty($asset_heading)){ ?>
    	                    <div class="asset-heading">
    	                    	<h6><?php echo $asset_heading; ?></h6>
    	                    </div><?php
    	                } ?> 
                        <div class="featured-assets-item"><?php
                        if(!empty($asset_before_image) && !empty($asset_before_image['url'])){ ?>
    	        			<div class="before-image">
    	        				<img src="<?php echo esc_url($asset_before_image['url']); ?>">
    	        			</div><?php
    	        		} 
                        if(!empty($featured_assets_content)){ ?>
                            <div class="featured-assets-content">
                                <?php echo $featured_assets_content; ?>
                            </div><?php
                        } ?>
                        </div> <?php
    	        		if(!empty($asset_after_image) && !empty($asset_after_image['url'])){ ?>
    	        			<div class="after-image featured-assets-item">
    	        				<img src="<?php echo esc_url($asset_after_image['url']); ?>">
    	        			</div><?php
    	        		} ?>
                    </div><?php                 
                } ?>
            </div><?php
        }
        if(!empty($related_case_study) && !empty($related_case_study['url'])){ ?>
            <div class="go-to-live-btn">
                <a href="<?php echo esc_url($related_case_study['url']); ?>" class="wp-block-button__link wp-element-button"><?php echo $related_case_study['title']; ?></a>
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
                    echo "\t" . '<a id="prev" rel="prev" href="' . get_permalink( $prev_post->ID ) . '" title="' . $prev_title . '" class="prev page-numbers">Previous</a>' . "\n";
                } ?>
                <?php
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
<main id="main" class="site-main site-content wp-block-group" role="main">
	<?php get_template_part( 'template-parts/content', 'page' ); ?>
</main>
<?php
get_footer(); ?>