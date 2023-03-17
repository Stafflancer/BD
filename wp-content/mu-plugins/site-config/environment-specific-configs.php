<?php
function prefix_env_settings() {
	// If settings have already been updated, return early
	if ( 1 == get_transient( 'dev-settings-updated' ) ) {
		return;
	}

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	// List Development Plugins
	$development_plugins = [
//		'what-the-file/what-the-file.php',
//		'query-monitor/query-monitor.php'
	];

	// List Production Plugins
	$production_plugins = [
		'iubenda-cookie-law-solution/iubenda_cookie_solution.php',
	];

	//Update site to use test mode in local and development environments
	if ( ! in_array( $_ENV['PANTHEON_ENVIRONMENT'], [ 'live' ] ) ) {
		// Disable Production Plugins
		foreach ( $production_plugins as $plugin ) {
			if ( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
			}
		}

		// Enable Development Plugins
		foreach ( $development_plugins as $plugin ) {
			if ( is_plugin_inactive( $plugin ) ) {
				activate_plugins( $plugin );
			}
		}

		// Transient is set for 24 hours
		set_transient( 'dev-settings-updated', 1, ( 60 * 60 * 24 ) );
		error_log( 'dev-settings-updated' );
	}
}

add_action( 'init', 'prefix_env_settings' );