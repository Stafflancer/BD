<?php
/**
 * Hero Banner - Home Block Template.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-home-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'hero-banner-home';

if ( ! empty( $block['className'] ) ) {
	$section_class_name .= ' ' . $block['className'];
}

$heading = get_field('heading');
$button = get_field('button');

// Start a <container> with possible block options.
$container_args = [
	'container' => 'section', // Any HTML5 container: section, div, etc...
	'id'        => $id, // Container id.
	'class'     => $section_class_name, // Container class.
];

bopper_display_block_background_options( $block, $container_args );
if($heading){ ?>
	<div class="banner-heading">
		<h1><?php echo $heading; ?></h1>
	</div><?php
}
if(have_rows('taglines')){ ?>
	<div class="tag-lines"><?php
	$index = 1;
	while(have_rows('taglines')){
		the_row(); 
		$tagline = get_sub_field('tagline'); 
		if($tagline){ ?>
			<span class="taglines <?php echo 'indextagline-'.$index; ?>"><?php echo $tagline; ?></span><?php
		} 
		$index++;
	} ?>
	</div><?php
}?>
<div class="b2b-op">
    <span class="normal-text">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/b2p-1.png" alt="b2p">
    </span>
    <span class="hover-text">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/bop-1.png" alt="bop">
    </span>
</div>
<div class="hero-banner-button-arrow"><?php
	if($button){ ?>
		<div class="hero-banner-button"><?php
			if ( ! empty( $button ) && ! empty( $button['url'] ) ){ ?>
			    <a href="<?php echo esc_url( $button['url'] ); ?>" class="button-hero-banner wp-block-button__link wp-element-button" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a><?php
			} ?>
		</div><?php
		$down_arrow = get_field('down_arrow'); ?>
		<div class="hero-banner-down-arrow">
			<a href="<?php echo esc_url($down_arrow['url']); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="32.613" height="17.014" viewBox="0 0 32.613 17.014">
				  <path id="V" d="M-420.5-12894.521l15.953,15.953,15.953-15.953" transform="translate(420.854 12894.874)" fill="none" stroke="#fff" stroke-width="1"/>
				</svg>
			</a>
		</div>
	</div><?php
}
bopper_close_block( $container_args['container'] );