<?php
/**
 * The template for displaying all single team member posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */

get_header();
?>
<section class="rightsideicons">
	<?php echo do_shortcode('[addtoany]'); ?>
</section>
<section class="hero-banner blog-page-banner">
	<figure class="has-pattern-show" style="background-image:url(<?php echo get_stylesheet_directory_uri()?>/assets/images/svg-icons/pattern.svg);"></figure>
	<div class="inner-container">
		<div class="breadcrumbs">
	        <div class="breadcrumbs-inner">                
	        	<a href="<?php echo get_permalink(105); ?>">Company</a>
	            <span class="divider"></span><a href="<?php echo get_permalink(111); ?>">Leadership</a>
				<span class="divider"></span> BIO
	        </div>
   	 	</div>
	</div>
</section>
<main id="main" class="site-main site-content wp-block-group" role="main"><?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		get_template_part( 'template-parts/content', 'page' );
	endwhile; // End of the loop.
	?>
</main><!-- #main -->

<?php
get_footer();