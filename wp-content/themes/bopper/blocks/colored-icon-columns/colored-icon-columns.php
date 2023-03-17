<?php
/**
 * Colored Icon Columns
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'colored-icon-columns-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$section_class_name = 'colored-icon-columns';

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
<div class="common-header-block"><?php
	$header_block = get_field('header_block');
	if($header_block){
		bopper_display_block_header_industries($header_block);
	}
	if(have_rows('columns')){ ?>
		<div class="columns col-md-6"><?php
			while(have_rows('columns')){
				the_row(); 
				$column_icon = get_sub_field('column_icon'); 
				$column_heading = get_sub_field('column_heading'); 
				$column_paragraph = get_sub_field('column_paragraph'); 
				$column_link = get_sub_field('column_link'); ?>
				<div class="columns-inner-item"><?php
					if( !empty( $column_icon) ){ ?>
						<div class="icon">
							<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$column_icon.'.svg'; ?>">
						</div><?php
					} ?>
					<div class="columns-inner-text">
						<?php
						if( !empty( $column_heading) ){ ?>
							<h5><?php echo $column_heading; ?></h5><?php
						} 
						if( !empty( $column_paragraph )){ ?>
							<p><?php echo $column_paragraph; ?></p><?php
						} 
						if ( ! empty( $column_link ) && ! empty( $column_link['url'] ) ){ ?>
							<a href="<?php echo esc_url( $column_link['url'] ); ?>" class="columns-link stretched-link" target="<?php echo $column_link['target']; ?>"><?php echo $column_link['title']; ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="7.658" height="11.322" viewBox="0 0 7.658 11.322">
                                  <path data-name="&gt;" d="M5,4.9l-.563.8L5,6.222,5.563,5.7ZM0,1.6,4.437,5.7,5.563,4.1,1.126,0ZM5.563,5.7,10,1.6,8.874,0,4.437,4.1Z" transform="translate(0.755 10.661) rotate(-90)" fill="#2f78e0" stroke="#2f78e0" stroke-width="1"/>
                                </svg>
							</a><?php
						} ?>
					</div>
				</div><?php	
			} ?>
		</div><?php
	} ?>
</div><?php
bopper_close_block( $container_args['container'] );