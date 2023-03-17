<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */

get_header();
$blogpageurl   = get_permalink( 101 ); 
$exclude = get_the_ID();
$categories = get_the_terms( get_the_ID(), 'category' );
if($categories){
	$category_id = array();
	foreach( $categories as $category ) {
	    $category_id[] = $category->term_id;
	} 
} ?>
<section class="rightsideicons">
	<?php echo do_shortcode('[addtoany]'); ?>
</section>
<section class="blog-single">
	<div class="blog-single-outer">
		<div class="back-section">
			<div class="back-section-inner">
				<a href="<?php echo $blogpageurl; ?>" class="backbtn">
					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8">
					  <path id="triagle_separator" data-name="triagle separator" d="M4,0,8,5H0Z" transform="translate(0 8) rotate(-90)" fill="#2e77dd"></path>
					</svg>
				BACK TO BLOG</a>
			</div>
			<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
		</div>
		<?php get_template_part( 'template-parts/content', 'page' ); ?>
	</div>
</section>
<?php
if(!empty($categories)){
	related_blog( $exclude, $category_id); 
} ?>
<?php
get_footer();