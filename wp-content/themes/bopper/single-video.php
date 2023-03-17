<?php
/**
 * The template for displaying all single videos
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */

get_header();
$resourcespageurl   = get_permalink( 103 ); 
$video = get_field('video'); ?>
<section class="rightsideicons">
	<?php echo do_shortcode('[addtoany]'); ?>
</section>
<section class="blog-single">
	<div class="container">
		<div class="back-section">
			<div class="back-section-inner">
				<a href="<?php echo $resourcespageurl; ?>" class="backbtn"><svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8">
  <path id="triagle_separator" data-name="triagle separator" d="M4,0,8,5H0Z" transform="translate(0 8) rotate(-90)" fill="#2e77dd"/>
</svg>
 BACK TO RESOURCES</a>
			</div><?php
			if(!empty($video)){ ?>
				<div class="full-width-video-embed-inner"><?php
                    // Use preg_match to find iframe src.
                    preg_match('/src="(.+?)"/', $video, $matches);
                    $src = $matches[1];
                    // Add extra parameters to src and replace HTML.
                    $params = array(
                        'controls'  => 1,
                        'muted'        => 1,
                        'hd'        => 1,
                        'autoplay' => 0,
                        'loop' => 0,
                    );
                    $new_src = add_query_arg($params, $src);
                    $iframe = str_replace($src, $new_src, $video);

                    // Add extra attributes to iframe HTML.
                    $attributes = 'frameborder="0"';
                    $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

                    // Display customized HTML.
                    echo $iframe; ?>
                </div><?php
			} ?>
			<div class="video-module">
				<main id="main" class="site-main site-content wp-block-group" role="main"><?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						get_template_part( 'template-parts/content', 'page' );

					endwhile; // End of the loop.
					?>
				</main><!-- #main -->
			</div>
		</div>
	</div>
</section>

<?php
get_footer();