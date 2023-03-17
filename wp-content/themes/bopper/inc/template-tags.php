<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some functionality here could be replaced by core features.
 *
 * @package Bopper
 */

if ( ! function_exists( 'bopper_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function bopper_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( DATE_W3C ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( /* translators: %s the date the post was published. */ esc_html_x( 'Posted on %s', 'post date', THEME_TEXT_DOMAIN ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'bopper_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function bopper_posted_by() {
		$byline = sprintf( /* translators: %s: post author. */ esc_html_x( 'by %s', 'post author', THEME_TEXT_DOMAIN ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' );

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'bopper_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bopper_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', THEME_TEXT_DOMAIN ) );
			if ( $categories_list && bopper_categorized_blog() ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', THEME_TEXT_DOMAIN ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', THEME_TEXT_DOMAIN ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', THEME_TEXT_DOMAIN ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_attr__( 'Leave a comment', THEME_TEXT_DOMAIN ), esc_attr__( '1 Comment', THEME_TEXT_DOMAIN ), esc_attr__( '% Comments', THEME_TEXT_DOMAIN ) );
			echo '</span>';
		}

		edit_post_link( sprintf( /* translators: %s: Name of current post */ esc_html__( 'Edit %s', THEME_TEXT_DOMAIN ), wp_kses_post( get_the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) ), '<span class="edit-link">', '</span>' );
	}
endif;

if ( ! function_exists( 'bopper_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function bopper_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail', array(
						'alt' => the_title_attribute( array(
								'echo' => false,
							) ),
					) );
				?>
			</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Load an inline SVG.
 *
 * @param string $filename The filename of the SVG you want to load.
 *
 * @return string The content of the SVG you want to load.
 */
function bopper_load_inline_svg( $filename ) {
	// Add the path to your SVG directory inside your theme.
	$svg_path = '/assets/images/svg-icons/';

	// Check the SVG file exists
	if ( file_exists( get_stylesheet_directory() . $svg_path . $filename ) ) {
		// Load and return the contents of the file
		return file_get_contents( get_stylesheet_directory_uri() . $svg_path . $filename );
	}

	// Return a blank string if we can't find the file.
	return '';
}

/**
 * Display SVG Markup.
 *
 * @param array $args The parameters needed to get the SVG.
 *
 * @author WebDevStudios
 *
 */
function bopper_display_svg( $args = [] ) {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = [
		'svg'   => [
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
			'color'           => true,
			'stroke-width'    => true,
		],
		'g'     => [ 'color' => true ],
		'title' => [
			'title' => true,
			'id'    => true,
		],
		'path'  => [
			'd'     => true,
			'color' => true,
		],
		'use'   => [
			'xlink:href' => true,
		],
	];

	$allowed_tags = array_merge( $kses_defaults, $svg_args );

	echo wp_kses( bopper_get_svg( $args ), $allowed_tags );
}

/**
 * Return SVG markup.
 *
 * @param array $args The parameters needed to display the SVG.
 *
 * @return string Error string or SVG markup.
 * @author Bop Design
 *
 */
function bopper_get_svg( $args = [] ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_attr__( 'Please define default parameters in the form of an array.', THEME_TEXT_DOMAIN );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_attr__( 'Please define an SVG icon filename.', THEME_TEXT_DOMAIN );
	}

	// Set defaults.
	$defaults = [
		'color'        => '',
		'icon'         => '',
		'title'        => '',
		'desc'         => '',
		'stroke-width' => '',
		'height'       => '',
		'width'        => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Figure out which title to use.
	$block_title = $args['title'] ? : $args['icon'];

	// Generate random IDs for the title and description.
	$random_number  = wp_rand( 0, 99999 );
	$block_title_id = 'title-' . sanitize_title( $block_title ) . '-' . $random_number;
	$desc_id        = 'desc-' . sanitize_title( $block_title ) . '-' . $random_number;

	// Set ARIA.
	$aria_hidden     = ' aria-hidden="true"';
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="' . $block_title_id . ' ' . $desc_id . '"';
		$aria_hidden     = '';
	}

	// Set SVG parameters.
	$color        = ( $args['color'] ) ? ' color="' . $args['color'] . '"' : '';
	$stroke_width = ( $args['stroke-width'] ) ? ' stroke-width="' . $args['stroke-width'] . '"' : '';
	$height       = ( $args['height'] ) ? ' height="' . $args['height'] . '"' : '';
	$width        = ( $args['width'] ) ? ' width="' . $args['width'] . '"' : '';

	// Start a buffer...
	ob_start();

	if($args['icon'] == 'pinterest'){ ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="9.825" height="13.186" viewBox="0 0 9.825 13.186">
		  <path id="Icon_awesome-yelp" data-name="Icon awesome-yelp" d="M1.15,6.19,3.715,7.441a.588.588,0,0,1-.116,1.1L.83,9.232a.587.587,0,0,1-.727-.5,5.078,5.078,0,0,1,.232-2.2.587.587,0,0,1,.814-.34Zm1.133,6.162a5.137,5.137,0,0,0,2.045.827.587.587,0,0,0,.686-.558l.1-2.854a.589.589,0,0,0-1.025-.415L2.178,11.473a.588.588,0,0,0,.105.878ZM6.026,9.52l1.515,2.421a.591.591,0,0,0,.876.142,5.109,5.109,0,0,0,1.358-1.741.592.592,0,0,0-.35-.812L6.709,8.647a.59.59,0,0,0-.683.873Zm3.82-3.405a5.085,5.085,0,0,0-1.3-1.785.588.588,0,0,0-.876.113L6.075,6.81a.588.588,0,0,0,.649.894l2.746-.786a.592.592,0,0,0,.376-.8ZM1.644.778a.589.589,0,0,0-.255.824L4.071,6.249a.588.588,0,0,0,1.1-.294V.59A.584.584,0,0,0,4.537,0,8.251,8.251,0,0,0,1.644.778Z" transform="translate(-0.071 0)"/>
		</svg><?php
	}
	else{ ?>
		<svg
			<?php
			echo bopper_get_the_content( $height ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
			echo bopper_get_the_content( $width ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
			echo bopper_get_the_content( $color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
			echo bopper_get_the_content( $stroke_width ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
			?>
			class="icon svg-icon <?php echo esc_attr( $args['icon'] ); ?>"
			<?php
			echo bopper_get_the_content( $aria_hidden ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
			echo bopper_get_the_content( $aria_labelledby ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
			?>
			role="img">
			<title id="<?php echo esc_attr( $block_title_id ); ?>">
				<?php echo esc_html( $block_title ); ?>
			</title>

			<?php
			// Display description if available.
			if ( $args['desc'] ) :
				?>
				<desc id="<?php echo esc_attr( $desc_id ); ?>">
					<?php echo esc_html( $args['desc'] ); ?>
				</desc>
			<?php endif; ?>

			<?php
			// Use absolute path in the Customizer so that icons show up in there.
			if ( is_customize_preview() ) :
				?>
				<use xlink:href="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/svg-icons/svg-icons-defs.svg#icon-' . esc_html( $args['icon'] ) ) ); ?>"></use>
			<?php else : ?>
				<use xlink:href="#icon-<?php echo esc_html( $args['icon'] ); ?>"></use>
			<?php endif; ?>
		</svg><?php
	} ?>

	<?php
	// Get the buffer and return.
	return ob_get_clean();
}

/**
 * Echo the copyright text saved in the Theme Settings -> Footer.
 */
function bopper_display_copyright_section() {
	// Grab our copyright group from the theme settings.
	$copyright_data = get_field( 'copyright', 'option' );

	if ( $copyright_data ) :
		$copyright_text = '';

		if ( ! empty( $copyright_data['copyright_text'] ) ) {
			$copyright_text = ' ' . $copyright_data['copyright_text'];
		}

		$copyright_links = $copyright_data['copyright_links'];
		?>
		<section class="font-size-small">
			&copy; <?php echo gmdate( 'Y' ); ?><?php echo esc_html( $copyright_text ); ?>
			<?php
			if ( $copyright_links ):
				foreach ( $copyright_links as $link ) {
					$link_url   = $link['link']['url'];
					$link_title = $link['link']['title'];

					echo '<span>&nbsp;|&nbsp;</span><a href="' . $link_url . '">' . $link_title . '</a>';
				}
				?>
			<?php endif; ?>
		</section>
	<?php else: ?>
		<section class="font-size-small">&copy; <?php echo gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ); ?></section>
	<?php endif; ?>
	<?php
}

/**
 * Display the social links saved in the Theme Settings -> Footer.
 */
function bopper_display_social_network_links() {
	// Create an array of our social links for ease of setup.
	// Change the order of the networks in this array to change the output order.
	$social_networks = get_field( 'social_media', 'option' );

	if ( $social_networks ) :
		$count = count( $social_networks );
		?>
		<ul class="d-flex social-icons menu">
			<?php
			$i = 1;
			// Loop through our network array.
			foreach ( $social_networks as $network => $network_url ) :
				// Only display the list item if a URL is set.
				if ( ! empty( $network_url ) ) :
					$icon_wrapper_class = 'social-li';

					if ( $count === $i ) {
						$icon_wrapper_class = '';
					}
					?>
					<li class="<?php echo esc_attr( $icon_wrapper_class ); ?>">
						<a href="<?php echo esc_url( $network_url ); ?>" target="_blank" class="social-icon d-flex align-items-center justify-content-center rounded-circle <?php echo esc_attr( $network ); ?>">
							<?php
							bopper_display_svg( [
								'icon'   => $network,
								'width'  => '24',
								'height' => '24',
							] );
							?>
							<span class="screen-reader-text">
								<?php
								/* translators: the social network name */
								printf( esc_attr__( 'Link to %s', THEME_TEXT_DOMAIN ), ucwords( esc_html( $network ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
								?>
							</span>
						</a><!-- .social-icon -->
					</li>
				<?php
				$i++;
				endif;
			endforeach;
			?>
		</ul><!-- .social-icons -->
	<?php endif;
}


/**
 * Display the offices saved in the Theme Settings -> Footer.
 */
function bopper_display_offices() {
	$offices = get_field('offices', 'option');
	if( $offices ): ?>
		<h4>Contact</h4>
	    <ul>
		    <?php foreach( $offices as $post ): 
		    	$permalink = get_permalink( $post );
		       	$title = get_the_title( $post );
		       	$address = get_field( 'address', $post );
		       	$phone_number = get_field( 'phone_number', $post );  ?>
		        <li class="contact-column">
		            <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a><?php
		            if($address){ ?>
		            	<span><?php echo $address; ?></span><?php
		            } 
		          	if ( ! empty( $phone_number ) && ! empty( $phone_number['url'] ) ): ?>
		            	<a href="<?php echo esc_url( $phone_number['url'] ); ?>" class="phone-number-link" target="<?php echo $phone_number['target']; ?>"><?php echo $phone_number['title']; ?></a><?php
		            endif; ?>
		        </li>
		    <?php endforeach; ?>
	    </ul><?php 
    endif;
}

/**
 * Display the footer logo saved in the Theme Settings -> Footer.
 */
function bopper_display_footer_logo() {
	$footer_logo = get_field('footer_logo', 'option');
	if (!empty($footer_logo)) : ?>
			<div class="footer-logo-main">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo wp_get_attachment_image_url( $footer_logo, 'medium' ); ?>" class="logo" width="177" height="51" alt="Bopper Logo"/>
				</a>
			</div>
		<?php else: ?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</p>
	<?php endif; 
}

/**
 * Display the footer badges saved in the Theme Settings -> Footer.
 */
function bopper_display_footer_badges() {
	if(have_rows('footer_badges', 'option')) :  ?>
		<ul><?php
			while(have_rows('footer_badges', 'option')):
				the_row(); 
				$footer_badge_title = get_sub_field('footer_badge_title');
				$footer_badge_image = get_sub_field('footer_badge_image');
				$footer_badge_url = get_sub_field('footer_badge_url'); ?>
				<li>
					<?php if ( ! empty( $footer_badge_url ) ): ?>
					<a href="<?php echo $footer_badge_url; ?>" target="_blank">
						<img src="<?php echo wp_get_attachment_image_url( $footer_badge_image, 'medium' ); ?>" >
					</a>
					<?php else: ?>
						<img src="<?php echo wp_get_attachment_image_url( $footer_badge_image, 'medium' ); ?>" >
					<?php endif; ?>
					<?php if ( ! empty( $footer_badge_title ) ): ?>
						<span><?php echo $footer_badge_title; ?></span>
					<?php endif; ?>
				</li><?php
					
			endwhile; ?>
		</ul><?php
	endif;
}

/**
 * Display the breadcrumbs.
 */
function bopper_display_breadcrumbs() { 
	if ( is_single() && 'portfolio' == get_post_type() ) { ?>
		<div class="breadcrumbs">
	        <div class="breadcrumbs-inner">
	        	<a href="<?php echo get_permalink(93); ?>">OUR WORK</a><span class="divider">| </span>
	        	<a href="<?php echo get_permalink(97); ?>">BEFORE AND AFTER</a><span class="divider">| </span>
				<span><?php the_title(); ?></span>
	        </div>
	    </div><?php
	}
	else if ( is_single() && 'before_after' == get_post_type() ) { ?>
		<div class="breadcrumbs">
	        <div class="breadcrumbs-inner">
	        	<a href="<?php echo get_permalink(93); ?>">OUR WORK</a><span class="divider">| </span>
	        	<a href="<?php echo get_permalink(99); ?>">PORTFOLIO</a><span class="divider">| </span>
				<span><?php the_title(); ?></span>
	        </div>
	    </div><?php
	}
	else{ ?>
		<div class="breadcrumbs">
	        <div class="breadcrumbs-inner"><?php
	            $parent_post = get_post()->post_parent;
	            if (!empty($parent_post)) 
	            { ?>
	                <a href="<?php echo get_permalink($parent_post); ?>">
	                    <?php echo get_the_title($parent_post); ?>
	                </a>
	                <span class="divider">| </span><?php 
	        	} ?>
				<span><?php the_title(); ?></span>
				<span class="divider"></span>
	        </div>
	    </div><?php
	}
}


/**
 * Display header navigation buttons saved in the Theme Settings -> Header.
 */
function bopper_display_header_buttons($buttons) {
	if ( $buttons ) :
		?>
		<div class="d-flex is-layout-flex wp-block-buttons">
		<?php
		// Loop through our buttons array.
		foreach ( $buttons as $button ) :

			// Only display the button item if a URL is set.
			if ( ! empty( $button ) && ! empty( $button['button']['url'] ) ) :
				$button_class  = '';
				$button_target = '';
				$button_text_color_class = '';
				$button_style  = $button['button_style'];
				$button_color_style  = $button['button_color_style'];
				$button_text_color_theme  = $button['button_text_color_theme']['color_picker'];
				if($button_color_style == 'color'){
					$button_color  = $button['button_color']['color_picker'];
					$button_class = ' has-' . esc_attr( $button_color ) . '-background-color has-background';
				}
				else{
					$button_color  = $button['gradient'];
					$button_class = ' has-' . esc_attr( $button_color ) . '-gradient-background';
				}
				if ( ! empty( $button['button']['target'] ) ) {
					$button_target = ' target="' . esc_attr( $button['button']['target'] ) . '"';
				}
				if ( ! empty( $button_text_color_theme ) ) {
					$button_text_color_class = ' has-' . esc_attr( $button_text_color_theme ) . '-color has-text-color';
				}
				if ( ! empty( $button_color ) ) {
					switch ( $button_style ) {
						case 'outline':
							$button_class = ' has-outline-' . esc_attr( $button_color ) . '-color outline-color';
							break;
						case 'fill':
						default:
							$button_class;
							break;
					}
				}
				?>
					<div class="wp-block-button is-style-<?php echo esc_attr( $button_style ); ?>">
						<a class="wp-block-button__link wp-element-button <?php echo esc_attr( $button_class ); ?> <?php echo esc_attr( $button_text_color_class ); ?>"
						   href="<?php echo esc_url( $button['button']['url'] ); ?>"<?php echo $button_target; ?>>
							<?php esc_html_e( $button['button']['title'], THEME_TEXT_DOMAIN ); ?>
						</a>
					</div>
				<?php
			endif;
		endforeach;
		?>
		</div>
	<?php endif;
}

/**
 * Display block header make a global reusable module to clone where needed.
 */
function bopper_display_block_header($header_block) {
	if ( ! empty( $header_block ) ){
		$header_style = $header_block['header_style_new']; 
		$icon = $header_block['icon']; 
		$label = $header_block['label'];      
		$heading = $header_block['heading']; 
		$intro_text = $header_block['intro_text']; 
		$gradient_line = $header_block['gradient_line']; 

		$buttons = $header_block['header_block_button']; ?>
		<div class="header-block col-md-12 <?php echo 'header-style-'.$header_style; ?>"><?php
			if( !empty( $icon) ){ ?>
				<div class="icon">
					<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
				</div><?php
			}
			if( !empty($label) ){ ?>
				<label class="h4"><?php echo $label; ?></label><?php
			} 
			if( $gradient_line == 1){ ?>
				<h2><?php echo $heading; ?></h2>
				<span class="gradient-line"></span><?php
			} 
			if( !empty($intro_text) ){ ?>
				<div class="intro_text"><?php echo $intro_text; ?></div><?php
					
			}  
			bopper_display_header_buttons($buttons); ?>
		</div><?php
	}
}

/**
 * Display block header make a global reusable module to clone where needed.
 */
function bopper_display_block_header_industries($header_block) {
	if ( ! empty( $header_block ) ){
		$header_style = $header_block['header_style_new']; 
		$icon = $header_block['icon']; 
		$label = $header_block['label'];      
		$heading = $header_block['heading']; 
		$intro_text = $header_block['intro_text']; 
		$gradient_line = $header_block['gradient_line']; 

		$buttons = $header_block['header_block_button']; ?>
		<div class="header-block <?php echo 'header-style-'.$header_style; ?>"><?php
			if( !empty( $icon) ){ ?>
				<div class="icon">
					<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/acf-icons/'.$icon.'.svg'; ?>">
				</div><?php
			}
			if( !empty($label) ){ ?>
				<label class="h4"><?php echo $label; ?></label><?php
			} 
			if( $gradient_line == 1){ ?>
				<h2><?php echo $heading; ?></h2>
				<span class="gradient-line"></span><?php
			} 
			if( !empty($intro_text) ){ ?>
				<div class="intro_text"><?php echo $intro_text; ?></div><?php
					
			}  
			bopper_display_header_buttons($buttons); ?>
		</div><?php
	}
}


/**
 * Trim the title length.
 *
 * @param array $args Parameters include length and more.
 *
 * @return string The title.
 */
function bopper_get_the_title( $args = [] ) {
	// Set defaults.
	$defaults = [
		'length' => 12,
		'more'   => '...',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the title.
	return wp_kses_post( wp_trim_words( get_the_title( get_the_ID() ), $args['length'], $args['more'] ) );
}

/**
 * Limit the excerpt length.
 *
 * @param array $args Parameters include length and more.
 *
 * @return string The excerpt.
 */
function bopper_get_the_excerpt( $args = [] ) {
	// Set defaults.
	$defaults = [
		'length' => 40,
		'more'   => '.',
		'post'   => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the excerpt.
	return wp_trim_words( get_the_excerpt( $args['post'] ), absint( $args['length'] ), esc_html( $args['more'] ) );
}

/**
 * Displays numeric pagination on archive pages.
 *
 * @param array    $args  Array of params to customize output.
 * @param WP_Query $query The Query object; only passed if a custom WP_Query is used.
 */
function bopper_display_numeric_pagination( $args = [], $query = null ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Make the pagination work on custom query loops.
	$total_pages = isset( $query->max_num_pages ) ? $query->max_num_pages : 1;

	// Set defaults.
	$defaults = [
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'mid_size'  => 4,
		'total'     => $total_pages,
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	if ( null === paginate_links( $args ) ) {
		return;
	}
	?>

	<nav class="container pagination-container" aria-label="<?php esc_attr_e( 'numeric pagination', THEME_TEXT_DOMAIN ); ?>">
		<?php echo paginate_links( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK. ?>
	</nav>

	<?php
}

/**
 * Displays the mobile menu with off-canvas background layer.
 *
 * @return void|string An empty string if no menus are found at all.
 */
function bopper_display_mobile_menu() {
	// Bail if no mobile or primary menus are set.
	if ( ! has_nav_menu( 'mobile' ) && ! has_nav_menu( 'primary' ) ) {
		return '';
	}

	// Set a default menu location.
	$menu_location = 'primary';

	// If we have a mobile menu explicitly set, use it.
	if ( has_nav_menu( 'mobile' ) ) {
		$menu_location = 'mobile';
	}
	?>
	<div class="off-canvas-screen d-block d-lg-none position-fixed top-0 end-0 bottom-0 start-0 visually-hidden"></div>
	<nav class="off-canvas-container d-block d-lg-none position-fixed top-0 bottom-0 h-100 overflow-y-auto" aria-label="<?php esc_attr_e( 'Mobile Menu', THEME_TEXT_DOMAIN ); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' ) ) : ?>
			<button type="button" class="off-canvas-close d-block d-lg-none position-absolute" aria-expanded="false" aria-label="<?php esc_attr_e( 'Close Menu', THEME_TEXT_DOMAIN ); ?>">
				<?php
				bopper_display_svg( [
					'icon'   => 'close',
					'width'  => '24',
					'height' => '24',
				] );
				?>
			</button>
		<?php endif; ?>
		<?php
		// Mobile menu args.
		$mobile_args = [
			'theme_location'  => $menu_location,
			'container'       => 'div',
			'container_class' => 'off-canvas-content',
			'container_id'    => '',
			'menu_id'         => 'site-mobile-menu',
			'menu_class'      => 'mobile-menu',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'fallback_cb'     => false,
		];

		// Display the mobile menu.
		wp_nav_menu( $mobile_args );
		?>
	</nav>
	<?php
}

// Display the related blog
function related_blog( $exclude, $category_id) {
	wp_enqueue_style( 'post-related-post', get_stylesheet_directory_uri() . '/blocks/related-post/related-post.css' );
	$args = array(
		'category__in' => $category_id,
		'posts_per_page' => 3,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows' => true,
		'post__not_in' => array($exclude),
	);
	$recent_posts = new WP_Query( $args ); 
	if ( $recent_posts->have_posts() ) 
	{  ?>
		<div class="related-post ">
			<div class="related-post-main">
				<div class="header-block col-md-6">
					<div class="icon"><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/acf-icons/pixels-resources.svg"></div>
					<label class="h4">RELATED POSTS</label>
				</div>
				<div class="related-post-inner">
		            <div class="related-post-container">
		                <div class="related-post-inner-main"><?php
							while ( $recent_posts->have_posts() ) {
								$recent_posts->the_post(); 
								$categories = get_the_terms( get_the_ID(), 'category' );
								$category_name = array();
								foreach( $categories as $category ) {
								    $category_name[] = $category->name;
								} ?>
								<div class="blog-list-items">
									<a href="<?php the_permalink(); ?>">
										<div class="related-post-item">
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="blog_img">
													<?php the_post_thumbnail( 'full' ); ?>
												</div>
											<?php } ?>
											<div class="blog-block-bottom">
												<div class="blog_content">
													<label><?php echo implode(" | ",$category_name); ?></label>
													<h2 class="blog_heading"><?php echo get_the_title(); ?></h2>
												</div>
												<div class="bottom-date-btn text-right">
		                                            <span class="common-btn sbtn-view">
		                                                <svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
		                                                  <rect id="Area_ICON:feather_twitter_SIZE:MEDIUM_STATE:DEFAULT_STYLE:STYLE2_" data-name="Area [ICON:feather/twitter][SIZE:MEDIUM][STATE:DEFAULT][STYLE:STYLE2]" width="20" height="20" fill="rgba(253,73,198,0.35)" opacity="0"></rect>
		                                                  <g id="Icon" transform="translate(4.167 4.168)">
		                                                    <line id="Line" x2="11.667" transform="translate(0 5.833)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></line>
		                                                    <path id="Path" d="M4.167,15.833,10,10,4.167,4.167" transform="translate(1.666 -4.167)" fill="none" stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"></path>
		                                                  </g>
		                                                </svg>
		                                            </span>
		                                        </div>
											</div>
										</div>
									</a>
								</div><?php
							}
							wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	} 
}

/**
 * Display the comments if comments are open or the count is more than 0.
 */
function bopper_display_comments() {
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

/**
 * Log Error Message to the debug.log file.
 * Useful when getting a white screen of death or an error in general.
 *
 * @param $var
 *
 * @return false|void
 */
function bopper_log_error_to_debug_file( $var ) {
	if ( empty( $var ) ) {
		return false;
	}

	ob_start();
	var_dump( $var );
	$contents = ob_get_contents();
	ob_end_clean();
	error_log( $contents );
}

