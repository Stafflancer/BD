<?php
function additional_security_headers( $headers ) {
	if ( ! is_admin() ) {
		$headers['Referrer-Policy']         = "no-referrer-when-downgrade"; //This is the default value, the same as if it were not set.
		$headers['X-Frame-Options']         = "SAMEORIGIN";
		$headers['X-Content-Type-Options']  = "nosniff";
		$headers['X-XSS-Protection']        = "1; mode=block";
		$headers['Permissions-Policy']      = "geolocation=(), microphone=(), camera=(), fullscreen=(self), midi=(), sync-xhr=(), magnetometer=(), gyroscope=(), payment=()";
		$headers['Content-Security-Policy'] = "default-src * data:; script-src https: 'unsafe-inline' 'unsafe-eval'; style-src https: 'unsafe-inline'";
		$headers['Server']                  = "Off";
	}

	return $headers;
}

add_filter( 'wp_headers', 'additional_security_headers' );