<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bopper
 */

get_header();
$search_shortcode = get_field( 'search_shortcode', 'option' );
preg_match_all('!\d+!', $search_shortcode, $matches);
$search_filter_id = implode(" ",$matches[0]); ?>
	<main id="primary" class="site-main">
		<div class="search-result-main">
			<header class="page-header">
				<h1 class="page-title">
					<?php _e( 'Search results for: ', THEME_TEXT_DOMAIN ); ?>
					<span class="page-description"><?php echo get_search_query(); ?></span>
				</h1>
			</header><!-- .page-header -->
			<div class="main-con-div">
				<?php
				$paged        = ! empty( $_GET['sf_paged'] ) ? $_GET['sf_paged'] : 1;
				$globalsearch = new WP_Query( [
					'post_status'      => 'publish',
					'search_filter_id' => $search_filter_id,
					'paged'            => $paged,
				] );

				if ( $globalsearch->have_posts() ) {
					?>
					<div id="searchlist" class="globalsearch-list-block">
						<?php
						while ( $globalsearch->have_posts() ) {
							$globalsearch->the_post();
							$post_id = get_the_ID();
							?>
							<div class="globalsearch-list-items">
								<a href="<?php the_permalink( $post_id ); ?>">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="globalsearch_img">
											<?php the_post_thumbnail( 'full' ); ?>
										</div>
									<?php } ?>
									<div class="globalsearch-block-bottom">
										<div class="globalsearch_content">
											<h2 class="globalsearch_heading"><?php echo get_the_title( $post_id ); ?></h2>
											<div class="globalsearch-para-block">
												<?php the_excerpt(); ?>
											</div>
										</div>
										<div class="bottom-date-btn text-right">
											<span class="common-btn sbtn-view"><?php _e( 'View', THEME_TEXT_DOMAIN ); ?></span>
										</div>
									</div>
								</a>
							</div>
						<?php } ?>
					<?php if ( $globalsearch->max_num_pages > 1 ) { ?>
						<div class="pagination-set">
							<div class="pagination-bottom d-flex justify-content-center pagination">
								<?php
								echo paginate_links( [
									'prev_text' => "",
									'next_text' => "",
									'base'      => site_url() . '%_%',
									'format'    => "?paged=%#%",
									'total'     => $globalsearch->max_num_pages,
									'current'   => $paged,
									'mid_size'  => 1,
									'end_size'  => 0,
								] );
								?>
							</div>
						</div>
					<?php } ?>
					<?php wp_reset_postdata(); ?>
					</div>
				<?php } else { ?>
					<div class="result-not-found">
						<h2><?php _e( 'Nothing Found', THEME_TEXT_DOMAIN ); ?>!</h2>
					</div>
				<?php } ?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();