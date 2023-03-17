<?php
/**
 * Search & Filter Pro
 *
 * Sample Results Template
 *
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 *
 * Note: these templates are not full page templates, rather
 * just an encapsulation of the results loop which should
 * be inserted in to other pages by using a shortcode - think
 * of it as a template part
 *
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs
 * and using template tags -
 *
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$paged = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
if ($query->have_posts()) { ?>
	<div class="filter-list-block">
		<div class="latest-post-main" id="result_list"><?php
			if(is_page('resources')){ ?><div class="row" data-masonry='{"percentPosition": true }'><?php }
				while ($query->have_posts()) {
					$query->the_post(); 
					if(get_post_type( get_the_ID() ) == 'testimonial'){ 
						get_template_part( 'template-parts/card-testimonial', 'page' );
					}
					if(get_post_type( get_the_ID() ) == 'news_post'){ 
						get_template_part( 'template-parts/card-news', 'page' );
					}
					if(get_post_type( get_the_ID() ) == 'resource' || get_post_type( get_the_ID() ) == 'ebook' || get_post_type( get_the_ID() ) == 'video'){ 
						get_template_part( 'template-parts/card-resource', 'page' );
					}
					if(get_post_type( get_the_ID() ) == 'portfolio'){ 
						get_template_part( 'template-parts/card-portfolio', 'page' );
					}
					if(get_post_type( get_the_ID() ) == 'before_after'){ 
						get_template_part( 'template-parts/card-before-after', 'page' );
					}
					if(get_post_type( get_the_ID() ) == 'case_study'){ 
						get_template_part( 'template-parts/card-case-studies', 'page' );
					}
				} 
			if(is_page('resources')){ ?></div><?php }  ?>
		</div><?php
		if($query->max_num_pages > 1)
		{ ?>	
			<div class="pagination-set">
				<div class="pagination-bottom d-flex justify-content-center pagination"><?php
					echo paginate_links( [
						'prev_text' => "previous",
						'next_text' => "next",
						'base'      => site_url() . '%_%',
						'format'    => "?paged=%#%",
						'total'     => $query->max_num_pages,
						'current'   => $paged,
						'mid_size'  => 1,
						'end_size'  => 0,
					] ); ?>
				</div>
			</div><?php
		} ?>
		<?php wp_reset_postdata(); ?>
	</div><?php 
}
else { ?>
	<div class="nothing-found">
		<h2>Nothing Found!</h2>
	</div><?php
} 
if ( is_page( 'testimonials' ) ) { ?>
	<div class="modal-popup testimonials for-video" style="display: none;">
        <div class="video-outer">
            <div class="video-cross-icon"></div>
            <video class="bgnw-video" muted controls>
                <source src="" type="video/mp4">
                <source src="" type="video/webm">
            </video>
        </div>
    </div><?php
} ?>