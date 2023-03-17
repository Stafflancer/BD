<?php
/**
 * List with Icons
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'list-with-icons-' . $block['id'];

$list_type = get_field('list_type');

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'list-with-icons';

if ( ! empty( $block['className'] ) ) {
	$section_class_name .= ' ' . $block['className'];
}


// Start a <container> with possible block options.
$container_args = [
	'container' => 'section', // Any HTML5 container: section, div, etc...
	'id'        => $id, // Container id.
	'class'     => $section_class_name, // Container class.
];

bopper_display_block_background_options( $block, $container_args ); ?>
<div class="colored-icon-columns-main common-header-block"><?php
	$header_block = get_field('header_block');
	if($header_block){
		bopper_display_block_header_industries($header_block);
	}
	if(have_rows('list')){ 
		$list_type = get_field('list_type'); ?>
		<div class="list"><?php
			while(have_rows('list')){
				the_row(); 
				$list_icon = get_sub_field('list_icon'); 
				$list_heading = get_sub_field('list_heading'); 
				$list_link = get_sub_field('list_link'); ?>
				<div class="list-inner-item <?php echo "type-".$list_type; ?>"><?php
					if($list_type == 'links'){ 
						if( !empty( $list_icon) ){ ?>
							<div class="icon"><?php
							if ( ! empty( $list_link ) && ! empty( $list_link['url'] ) ){ ?>
								<a href="<?php echo esc_url( $list_link['url'] ); ?>" class="list-link" target="<?php echo $list_link['target']; ?>"><?php } ?>
								<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$list_icon.'.svg'; ?>"><?php
									if ( ! empty( $list_link ) && ! empty( $list_link['url'] ) ){ ?></a><?php } ?>
							</div><?php
						}
						if ( ! empty( $list_link ) && ! empty( $list_link['url'] ) ){ ?>
							<a href="<?php echo esc_url( $list_link['url'] ); ?>" class="list-link" target="<?php echo $list_link['target']; ?>"><?php echo $list_link['title']; ?></a><?php
						}
					} 
					else{ 
						if( !empty( $list_icon) ){ ?>
							<div class="icon">
								<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$list_icon.'.svg'; ?>">
							</div><?php
						}
						if($list_heading){ ?>
							<h5><?php echo $list_heading; ?></h5><?php
						}
					} ?>
				</div><?php	
			} ?>
		</div><?php
	} ?>
</div><?php
bopper_close_block( $container_args['container'] );