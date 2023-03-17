<?php /* Template Name: Thank You */
get_header(); 
$gated_resource = get_field('gated_resource'); 
$resourcespageurl = get_permalink( 103 ); 
if(!empty($gated_resource)){ ?>
	<section class="thank-you">
		<div class="container">
			<div class="thank-you-outer">
				<div class="first-row">
					<div class="back-section-inner">
						<a href="<?php echo $resourcespageurl; ?>" class="backbtn">
							<svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8">
								<path id="triagle_separator" data-name="triagle separator" d="M4,0,8,5H0Z" transform="translate(0 8) rotate(-90)" fill="#2e77dd"></path>
							</svg>
							BACK TO RESOURCES
						</a>
					</div><?php
					$permalink = get_permalink( $gated_resource );
		        	$title = get_the_title( $gated_resource ); ?>
					<div class="resource-post"><?php
						if(!empty($title)){ ?>
							<h1><?php echo $title; ?></h1><?php
						} ?>
						<span class="gradient-line"></span>
						<?php echo get_the_content(); ?>
						<a href="<?php echo $permalink; ?>" class="wp-block-button__link wp-element-button">Download Now</a>
					</div>
				</div>
				<div class="second-row"><?php 
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id($gated_resource) );
					if (!empty($feat_image)) { ?>
						<div class="right-side-data">
							<img src="<?php echo $feat_image; ?>" />
						</div><?php
					} ?>
				</div>
			</div>
		</div>
	</section><?php
} ?>
<?php
get_footer(); ?>