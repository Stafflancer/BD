<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bopper
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'site-wrapper no-js' ); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', THEME_TEXT_DOMAIN ); ?></a>

	<?php
	$site_logo        = get_field( 'site_logo', 'option' );
	$wrapper_classes  = 'site-header w-100';
	$wrapper_classes .= $site_logo ? ' has-logo' : '';
	$wrapper_classes .= has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' ) ? ' has-menu' : '';
	?>
	<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">
		<div class="container position-relative">
			<div class="row align-items-center">
				<div class="col-6 col-lg-2">
					<div class="site-branding header-logo">
						<?php if ( $site_logo ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo wp_get_attachment_image_url( $site_logo, 'medium' ); ?>" class="logo" width="177" height="51" alt="Bopper Logo"/>
							</a>
						<?php else: ?>
							<p class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</p>
						<?php endif; ?>
					</div><!-- .site-branding -->
				</div>

				<div class="col-6 col-lg-10">
					<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' ) ) : ?>
						<button type="button" class="off-canvas-open mobile-menu-hamburger d-block d-lg-none p-0 position-absolute top-50 translate-middle-y bottom-0" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open Menu', THEME_TEXT_DOMAIN ); ?>">
							<?php
							bopper_display_svg( [
								'icon'   => 'hamburger',
								'width'  => '24',
								'height' => '24',
							] );
							?>
						</button>
					<?php endif; ?>
					<div class="header-navigation-outer">
						<nav id="site-navigation fddfd" class="main-navigation navigation-menu d-none d-lg-flex justify-content-end" aria-label="<?php esc_attr_e( 'Main Navigation', THEME_TEXT_DOMAIN ); ?>"><?php
							wp_nav_menu(
								[
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'menu dropdown d-flex justify-content-end',
									'container'      => false,
									'fallback_cb'    => false,
								]
							);
							?>
							<?php 
							$buttons = get_field( 'navigation_buttons', 'option' );
							bopper_display_header_buttons($buttons); ?>
						</nav><!-- #site-navigation -->
						<div class="collapse mobile-menu" id="mobilemenucontent" style="display: none;"><?php
							wp_nav_menu(
								[
									'menu' => 'Primary Mobile Menu',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'menu dropdown d-flex justify-content-end',
									'container'      => false,
									'fallback_cb'    => false,
								]
							);
							?>
						</div><?php
						$search_shortcode = get_field( 'search_shortcode', 'option' );
						if ( $search_shortcode ) { ?>
							<div class="search-icon">
								<div class="header-search-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="17.012" height="17.012" viewBox="0 0 17.012 17.012">
									  <g id="Icon" transform="translate(-2.667 -2.667)">
									    <circle id="Path" cx="6.667" cy="6.667" r="6.667" transform="translate(3.5 3.5)" fill="none" stroke="#ffe800" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"/>
									    <line id="Line" x1="3.625" y1="3.625" transform="translate(14.875 14.875)" fill="none" stroke="#ffe800" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.667"/>
									  </g>
									</svg>
								</div>
								<div class="search-form" style="display: none;">
									<?php echo do_shortcode( $search_shortcode ); ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div><!-- .container -->
	</header><!-- #masthead -->