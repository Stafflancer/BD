<?php
if ( ! function_exists( 'bopper_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 */
	function bopper_scripts() {
		/**
		 * Enqueue 3rd party required styles.
		 */
		wp_enqueue_style( 'bootstrap-grid', get_theme_file_uri( '/assets/css/vendor/bootstrap-grid.min.css' ), [], null );
		wp_enqueue_style( 'bootstrap-utilities', get_theme_file_uri( '/assets/css/vendor/bootstrap-utilities.min.css' ), [], null );
		wp_enqueue_style( 'animate-style', get_theme_file_uri( '/assets/css/vendor/animate.min.css' ), [], null );

		wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/assets/css/main.min.css' );

		/**
		 * Enqueue theme required styles.
		 */
		wp_enqueue_style( 'bopper-menus-style', get_theme_file_uri( '/assets/css/menus.css' ), [], null );
		wp_enqueue_style( 'bopper-mobile-menu-style', get_theme_file_uri( '/assets/css/mobile-menu.css' ), [], null, '(max-width: 1023px)' );
		wp_enqueue_style( 'bopper-off-canvas-style', get_theme_file_uri( '/assets/css/off-canvas.css' ), [], null, '(max-width: 1023px)' );
		wp_enqueue_style( 'bopper-style', get_stylesheet_uri(), [], null );


		/**
		 * Enqueue required scripts.
		 */
		wp_enqueue_script( 'wow-script', get_theme_file_uri( '/assets/js/vendor/wow/wow.min.js' ), [], null, true );
		wp_enqueue_script( 'bopper-script', get_theme_file_uri( '/assets/js/main.js' ), [ 'wow-script' ], null, true );

		wp_enqueue_script( 'custom-script-js', get_theme_file_uri( '/assets/js/custom-script.js' ), [], null, true );

		if ( is_user_logged_in() ) {
			wp_enqueue_style( 'bopper-wp-admin-style', get_theme_file_uri( '/assets/css/wp-admin.css' ), [], null );
		}
		if ( is_page( 'testimonials' ) ) {
			wp_enqueue_script( 'theme-carousel-testimonials-script', get_stylesheet_directory_uri() . '/blocks/carousel-testimonials/carousel-testimonials.js', array(), '', true );
		}
		if ( is_page( 'resources' ) ) {
			wp_enqueue_script( 'masonry-js', get_theme_file_uri( '/assets/js/masonry.pkgd.js' ), [], null, true );
			wp_enqueue_script( 'resources-script', get_stylesheet_directory_uri() . '/assets/js/resources.js', array(), '', true );
		}
		if ( is_single() && 'portfolio' == get_post_type() || is_single() && 'case_study' == get_post_type()) {
			wp_enqueue_style( 'before-after-global', get_stylesheet_directory_uri() . '/assets/css/before-after-global.css' );
			wp_enqueue_style( 'odometer-theme-defaul-style', get_theme_file_uri( '/assets/css/odometer-theme-default.css' ), [], null );
			wp_enqueue_script( 'odometer-script', get_theme_file_uri( '/assets/js/vendor/odometer.js' ), [], null, true );
			wp_enqueue_script( 'stats-counter-script', get_stylesheet_directory_uri() . '/assets/js/stats-counter.js', array(), '', true  );
		}
		if ( is_single() && 'before_after' == get_post_type() ) {
			wp_enqueue_style( 'before-after-global', get_stylesheet_directory_uri() . '/assets/css/before-after-global.css' );
			wp_enqueue_script( 'theme-shortcode-script', get_template_directory_uri() . '/blocks/shortcode/shortcode.js', array(), '', true  );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'bopper_scripts' );

/**
 * Register block script
 */
function bopper_register_block_script() {
	
	wp_register_style( 'swiperjs-style', get_template_directory_uri() . '/assets/css/vendor/swiper-bundle.min.css');

	wp_register_script( 'swiperjs-script', get_template_directory_uri() . '/assets/js/vendor/swiperjs/swiper-bundle.min.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'tweenMax-script', get_template_directory_uri() . '/assets/js/scrollmagic/TweenMax.min.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'scrollmagic-script', get_template_directory_uri() . '/assets/js/scrollmagic/ScrollMagic.min.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'animation-gsap-script', get_template_directory_uri() . '/assets/js/scrollmagic/animation.gsap.min.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'hero-banner-home-script', get_template_directory_uri() . '/blocks/hero-banner-home/hero-banner-home.js', [ 'jquery', 'acf' ] );

	wp_register_style( 'odometer-style',  get_theme_file_uri( '/assets/css/vendor/odometer-theme-default.css' ), [], null );

	wp_register_script( 'odometer-script', get_stylesheet_directory_uri() . '/assets/js/vendor/odometer.js', array(), '', true );

	wp_register_script( 'carousel-testimonials-script', get_template_directory_uri() . '/blocks/carousel-testimonials/carousel-testimonials.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'latest-posts-script', get_template_directory_uri() . '/blocks/latest-posts/latest-posts.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'featured-resources-script', get_template_directory_uri() . '/blocks/featured-resources/featured-resources.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'job-openings-script', get_template_directory_uri() . '/blocks/job-openings/job-openings.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'featured-case-studies-script', get_template_directory_uri() . '/blocks/featured-case-studies/featured-case-studies.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'faqs-script', get_template_directory_uri() . '/blocks/faqs/faqs.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'shortcode-script', get_template_directory_uri() . '/blocks/shortcode/shortcode.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'carousel-logos-script', get_template_directory_uri() . '/blocks/carousel-logos/carousel-logos.js', [ 'jquery', 'acf' ] );

	wp_register_script( 'clutch-widget-script', get_stylesheet_directory_uri() . '/assets/js/widget.js', [ 'jquery', 'acf' ] );
	
}
add_action( 'wp_enqueue_scripts', 'bopper_register_block_script' );


if ( ! function_exists( 'bopper_preload_assets' ) ) {
	/**
	 * Preload styles and scripts.
	 *
	 * @return void
	 */
	function bopper_preload_assets() {
		?>
		<link rel="preload" href="https://use.typekit.net/wbo7fug.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
		<noscript><link rel="stylesheet" href="https://use.typekit.net/wbo7fug.css"></noscript>
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/css/vendor/bootstrap-grid.min.css' ) ); ?>" as="style">
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/css/vendor/bootstrap-utilities.min.css' ) ); ?>" as="style">
		<link rel="preload" href="<?php echo esc_url( get_stylesheet_uri() ); ?>" as="style">
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/css/vendor/animate.min.css' ) ); ?>" as="style">
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/js/vendor/wow/wow.min.js' ) ); ?>" as="script">
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( '/assets/js/main.js' ) ); ?>" as="script">
		<?php
	}
}

add_action( 'wp_head', 'bopper_preload_assets', 1 );