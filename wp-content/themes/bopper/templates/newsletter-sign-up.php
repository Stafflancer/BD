<?php /* Template Name: Newsletter Sign Up */
get_header();
$intro = get_field('intro');
$form_heading = get_field('form_heading');
$form_paragraph = get_field('form_paragraph');
$form = get_field('form'); ?>
<section class="newsletter-signup">
	<div class="container">
		<div class="newsletter-signup-outer">
			<div class="left-side-row">
				<h1><?php the_title(); ?></h1>
				<span class="gradient-line"></span><?php
				if(!empty($intro)){ ?>
					<p class="large"><?php echo $intro; ?></p><?php
				} ?>
				<div class="content">
					<?php echo get_the_content(); ?>
				</div>
			</div><?php
			if(!empty($form)){ ?>
				<div class="right-side-row">
					<div class="subscribe-form"><?php
						if(!empty($form_heading)){ ?>
							<h4><?php echo $form_heading; ?></h4><?php
						} 
						if(!empty($form_paragraph)){ ?>
							<p><?php echo $form_paragraph; ?></p><?php
						} ?>
				        <?php echo do_shortcode( '[gravityform id="' . $form . '" title="false" ajax="true"]' ); ?>
				    </div>
				</div><?php
			} ?>
		</div>
	</div>
</section>
<?php
get_footer(); ?>