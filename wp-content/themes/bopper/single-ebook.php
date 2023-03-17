<?php
/**
 * The template for displaying all single ebook posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bopper
 */
get_header(); 
$resourcespageurl = get_permalink( 103 ); 
$form = get_field('gravity_form');
?>
<section class="rightsideicons">
	<?php echo do_shortcode('[addtoany]'); ?>
</section>
<section class="ebook-single">
	<div class="container">
		<div class="thank-you-outer">
			<div class="first-row">
				<div class="back-section-inner">
					<a href="<?php echo $resourcespageurl; ?>" class="backbtn">
						<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8">
							<path id="triagle_separator" data-name="triagle separator" d="M4,0,8,5H0Z" transform="translate(0 8) rotate(-90)" fill="#2e77dd"></path>
						</svg> BACK TO RESOURCES
					</a>
				</div>
				<h1><?php echo get_the_title(); ?></h1>
				<div class="left-side-data">
					<?php echo get_the_content(); ?>
				</div>
			</div>
			<div class="second-row"><?php 
				if ( has_post_thumbnail() ) { ?>
					<div class="right-side-data">
						<?php bopper_post_thumbnail(); ?>
					</div><?php
				} 
				if($form){ ?>
			        <div class="ebook-form-content">
			            <div class="subscribe-form">
			            	<?php echo do_shortcode( '[gravityform id="' . $form . '" title="false" ajax="true"]' ); ?>
			            </div>
			        </div><?php
		        } ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer(); ?>