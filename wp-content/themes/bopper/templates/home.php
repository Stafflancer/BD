<?php /* Template Name: Blog */
get_header(); 
$blog_banner_heading = get_field('blog_banner_heading', 'option'); 
$blog_banner_button = get_field('blog_banner_button', 'option');
$blog_featured_post = get_field('blog_featured_post', 'option'); 
$title = get_the_title($blog_featured_post);
$permalink = get_the_permalink($blog_featured_post);
$featured_blog_image = get_the_post_thumbnail($blog_featured_post); 
$blog_date = get_the_date('F d, Y', $blog_featured_post); ?>
<section class="hero-banner blog-page-banner">
	<figure class="has-pattern-show" style="background-image:url(<?php echo get_stylesheet_directory_uri()?>/assets/images/svg-icons/pattern.svg);"></figure>
		<div class="inner-container">
			<div class="blog-banner-inner"><?php
				bopper_display_breadcrumbs(); ?>
				<div class="blog-banner-main">
					<div class="blog-banner-details"><?php
						if($blog_banner_heading){ ?>
							<div class="banner-heading">
								<h1><?php echo $blog_banner_heading; ?></h1>
							</div><?php
						}
						$blog_banner_button = get_field( 'blog_banner_button'); 
						if ( ! empty( $blog_banner_button ) && ! empty( $blog_banner_button['url'] ) ){ ?>
							<div class="banner-button blog-banner-button">
								<a href="<?php echo esc_url( $buttons['url'] ); ?>" class="wp-block-button__link wp-element-button ms-2 ms-lg-3" target="<?php echo $buttons['target']; ?>"><?php echo $buttons['title']; ?></a>
							</div><?php
						} ?>
					</div><?php
					if(!empty($blog_featured_post)){ ?>
						<div class="blog-featured-post">
							<div class="blog-list-items">
								<span class="featured-tag">FEATURED</span>
								<a href="<?php echo $permalink; ?>"><?php
                    if ( $featured_blog_image ) { ?>
                        <div class="blog_img">
                        	<div class="post-thumbnail">
                            	<?php echo $featured_blog_image; ?>			                            	
                            </div>
                        </div><?php 
                    } ?>
                    <div class="blog-block-bottom">
                    	<div class="blog_content">
		                    <label><?php echo $blog_date; ?></label>
		                    <h2 class="news_heading"><?php echo $title; ?></h2>
		                </div>
		                <div class="blog-button-bottom">
		                    <div class="reading"><?php echo do_shortcode('[rt_reading_time label="Read Time:" postfix="minutes" postfix_singular="minute" post_id="'.$blog_featured_post.'"]'); ?></div>
		                    <div class="bottom-date-btn text-right">
													<span class="common-btn sbtn-view">
														<svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
															<rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"></rect><g id="Icon" transform="translate(4.167 4.168)"><line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></line><path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></path></g>
                            </svg>
                          </span>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div><?php
					} ?>
				</div>
			</div>
		</div>
</section>
<section class="hero-banner blog-listing">	
		<div class="blog-filter">
			<div class="inner-container">
				<?php echo do_shortcode('[searchandfilter id="31698"]'); ?>
			</div>
		</div>
		<div class="inner-container"><?php
		$paged  = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
		$blog = new WP_Query( [
			'post_status'      => 'publish',
			'search_filter_id' => 31698,
			'paged'            => $paged,
		] );
		if ( $blog->have_posts() ) { ?>
			<div id="bloglist" class="blog-list-block"><?php
				while ( $blog->have_posts() ) {
					$blog->the_post();
					$post_id = get_the_ID(); 
					get_template_part( 'template-parts/card-post', 'page' );
				} 
				if ( $blog->max_num_pages > 1 ) { ?>
					<div class="pagination-set">
						<div class="pagination-bottom d-flex justify-content-center pagination"><?php
							echo paginate_links( [
								'prev_text' => "< previous",
								'next_text' => "next >",
								'base'      => site_url() . '%_%',
								'format'    => "?paged=%#%",
								'total'     => $blog->max_num_pages,
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
		else 
		{ ?>
			<div class="result-not-found">
				<h2><?php _e( 'Nothing Found', THEME_TEXT_DOMAIN ); ?>!</h2>
			</div><?php 
		} ?>
	</div>
</section>
<main id="main" class="site-main site-content wp-block-group" role="main">
	<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
</main><!-- #main -->
<?php
get_footer(); ?>