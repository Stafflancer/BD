<?php
/**
 * Cards with Animated Icons
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @package Bopper
 */

$cards_per_row = get_field('cards_per_row');
if(have_rows('cards'))
{ 
	// Create id attribute allowing for custom "anchor" value.
	$id = 'cards-with-animated-icons-' . $block['id'];

	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className".
	$section_class_name = 'cards-with-animated-icons';

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
	<div class="cards-animated-icons-main">
		<div class="cards-animated-icons-inner <?php echo "cards-per-row".$cards_per_row; ?>"><?php
            while(have_rows('cards'))
            {
                the_row();
                $icon = get_sub_field('icon');
                $heading = get_sub_field('heading');
                $paragraph = get_sub_field('paragraph'); 
                $link = get_sub_field('link');  ?>
                <div class="card"><?php
				  	if(!empty($icon))
		            { ?>
		                <div class="columns-icon">
		                    <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
		                </div><?php
		            } 
		            if(!empty($heading) || !empty($paragraph)){  ?>
					  	<div class="card-body"><?php
				            if($heading){ ?>
				               <h4 class="card-title"><?php echo $heading; ?></h4><?php
				            } 
				            if($paragraph){ 
				            	echo $paragraph;
				            } 
				            if(!empty($link) && !empty($link['url']))
		                	{ ?>
		                		<a href="<?php echo esc_url($link['url']); ?>" class="btn btn-primary" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a><?php
						    } ?>
					  	</div><?php
					} ?>
				</div><?php
			} ?>
		</div>
	</div><?php
	$buttons = get_field('button');
	if(!empty($buttons)){
		bopper_display_header_buttons($buttons);
	}
	bopper_close_block( $container_args['container'] );
}