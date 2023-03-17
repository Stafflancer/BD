<?php
/**
 * Disable Anonymous Access to WordPress Rest API.
 *
 * The WordPress REST API is enabled for all users by default. To improve the security of a WordPress site, you can
 * disable the WordPress REST API for anonymous requests, to avoid exposing admin users. This action improves site
 * safety and reduces unexpected errors that can result in compromised WordPress core functionalities.
 *
 * The following function ensures that anonymous access to your site's REST API is disabled and that only authenticated
 * requests will work.
 *
 * @link https://pantheon.io/docs/wordpress-best-practices#disable-anonymous-access-to-wordpress-rest-api
 */
// Disable WP Users REST API for non-authenticated users (allows anyone to see username list at /wp-json/wp/v2/users).
add_filter( 'rest_authentication_errors', function ( $result ) {
	if ( true === $result || is_wp_error( $result ) ) {
		return $result;
	}

	if ( ! is_user_logged_in() ) {
		return new WP_Error( 'rest_not_logged_in', __( 'You are not currently logged in.' ), array( 'status' => 401 ) );
	}

	return $result;
} );