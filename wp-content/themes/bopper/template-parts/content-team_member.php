<?php
/**
 * Template part for displaying team member content in single-team_member.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bopper
 */

$banner_image = get_field('banner_image'); 
$member_role = get_field('member_role');
$member_email = get_field('member_email');
$linkedin = get_field('linkedin');
$phone_number = get_field('phone_number'); ?>
<article id="post-<?php the_ID(); ?>">
	<div class="before-info">
		<div class="container">
			<div class="before-info-inner"><?php
				if(!empty($banner_image) && !empty($banner_image['url'])){ ?>
					<div class="member-banner-image" style="background-image: url(<?php echo esc_url($banner_image['url']); ?>);">
						<!-- <img src="<?php echo esc_url($banner_image['url']); ?>"> -->
					</div><?php
				} ?>
				<div class="before-info-text"><?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif; 
					if(!empty($member_role)){ ?>
						<div class="member-role">
							<h4><?php esc_html_e( $member_role, THEME_TEXT_DOMAIN ); ?></h4>
						</div><?php
					} ?>
				</div>
			</div>
		</div>
	</div>
	<div class="member-info-social">
		<ul><?php 
			if ( $linkedin ){ ?>
				<li>
					<a href="<?php echo esc_url( $linkedin ); ?>" class="social-icon" target="_blank"><?php
						bopper_display_svg( [
							'icon'   => 'linkedin',
							'width'  => '24',
							'height' => '24',
						] ); ?>
						<span class="screen-reader-text"><?php
							/* translators: the social network name */
							printf( esc_attr__( 'Link to %s', THEME_TEXT_DOMAIN ), ucwords( esc_html( 'linkedin' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK. ?>
						</span>
					</a>
				</li><?php
			} 
			if ( $member_email ){ ?>
				<li>
					<a href="mailto:<?php echo $member_email; ?>" class="social-icon">
						<span>Email</span> <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/svg-icons/email.svg">
						<span class="screen-reader-text"><?php
							/* translators: the social network name */
							printf( esc_attr__( 'Link to %s', THEME_TEXT_DOMAIN ), ucwords( esc_html( 'email' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK. ?>
						</span>
					</a>
				</li><?php
			} 
			if ( $phone_number ){ ?>
				<li>
					<a href="tel:<?php echo $phone_number; ?>" class="social-icon">
						<span>Call </span><img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/svg-icons/phone.svg">
						<span class="screen-reader-text"><?php
							/* translators: the social network name */
							printf( esc_attr__( 'Link to %s', THEME_TEXT_DOMAIN ), ucwords( esc_html( 'phone' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK. ?>
						</span>
					</a>
				</li><?php
			} ?>
		</ul>
	</div>

</article>