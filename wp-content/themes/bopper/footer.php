<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bopper
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row"><?php
				if ( has_nav_menu( 'footer' ) ) { ?>
					<div id="site-footer-navigation-1" class="footer-navigation menu-services-footer-menu-new col-lg-6" aria-label="<?php esc_attr_e( 'Footer Navigation', THEME_TEXT_DOMAIN ); ?>"><?php
							wp_nav_menu( array(
									'menu'           => 'Services Footer Menu',
									'theme_location' => 'footer',
									'menu_class'     => 'footer-menu menu',
									'container'      => 'ul',
									'before'         => '',
									'after'          => '',
									'depth'          => 3,
									'link_before'    => '',
									'link_after'     => '',
							) );?>
					</div>
					<div class="col-lg-6">
						<div class="footer-navigation-2">
							<div class="row">
						<div class="col-md-4 col-sm-4 ">
								<div id="site-footer-navigation-2" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', THEME_TEXT_DOMAIN ); ?>"><?php
									wp_nav_menu( array(
											'menu'           => 'Industries Footer Menu',
											'theme_location' => 'footer',
											'menu_class'     => 'footer-menu menu',
											'container'      => 'ul',
											'before'         => '',
											'after'          => '',
											'depth'          => 3,
											'link_before'    => '',
											'link_after'     => '',
									) );?>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
								<div id="site-footer-navigation-2" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', THEME_TEXT_DOMAIN ); ?>"><?php
									wp_nav_menu( array(
											'menu'           => 'Resources Footer Menu',
											'theme_location' => 'footer',
											'menu_class'     => 'footer-menu menu',
											'container'      => 'ul',
											'before'         => '',
											'after'          => '',
											'depth'          => 3,
											'link_before'    => '',
											'link_after'     => '',
									) );?>
							</div>
						</div>
							<div class="col-md-4 col-sm-4">
								<div id="site-footer-navigation-2" class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', THEME_TEXT_DOMAIN ); ?>"><?php
									wp_nav_menu( array(
											'menu'           => 'Company Footer Menu',
											'theme_location' => 'footer',
											'menu_class'     => 'footer-menu menu',
											'container'      => 'ul',
											'before'         => '',
											'after'          => '',
											'depth'          => 3,
											'link_before'    => '',
											'link_after'     => '',
									) );?>
							</div>
							</div>
						</div>
							</div>
					</div><?php
				} ?>
			</div>
		</div>
		<div class="container">
			<div class="row mb-4">
				<div class="footer-navigation col-md-12 col-sm-12">
					<div class="offices-list">
						<?php bopper_display_offices(); ?>
						<div class="footer-contact-btn"><?php
						
							$contact_button = get_field('contact_button', 'option');
							if ( ! empty( $contact_button ) && ! empty( $contact_button['url'] ) ): ?>
								<div class="footer-button">
									<a href="<?php echo esc_url( $contact_button['url'] ); ?>" class="wp-block-button__link wp-element-button ms-2 ms-lg-3 " target="<?php echo $contact_button['target']; ?>"><?php echo $contact_button['title']; ?></a>
								</div><?php
							endif; 
							$phone = get_field('phone', 'option');
							if ( ! empty( $phone ) && ! empty( $phone['url'] ) ): ?>
								<div class="footer-phone-number">
					            	<a href="<?php echo esc_url( $phone['url'] ); ?>" class="footer-phone-number" target="<?php echo $phone['target']; ?>"><?php echo $phone['title']; ?></a>
					            </div><?php
					        endif; ?>
					    </div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="social-menu col-md-12 col-sm-12">
					<?php bopper_display_social_network_links(); ?>
				</div>
			</div>
		</div>
				<div class="footer-logo">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="footer-logo-outer">
									<?php bopper_display_footer_logo(); ?>
									<div class="footer-other-logo">
										<?php bopper_display_footer_badges(); ?>
									</div>
								</div>
								<div class="site-info">
									<?php bopper_display_copyright_section(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

	<?php bopper_display_mobile_menu(); ?>
	<?php wp_footer(); ?>
	<?php
	if ( function_exists( 'bopper_load_inline_svg' ) ) {
		echo bopper_load_inline_svg( 'svg-icons-defs.svg' );
	}
	?>
</body>
</html>