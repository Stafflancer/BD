<?php
/*
Plugin Name: Environment Specific Configurations
Plugin URI: https://www.bopdesign.com/
Description: Activates and deactivates plugins based on environment.
Version: 0.1
Author: Bop Design
Author URI: https://www.bopdesign.com/
License: MIT License
License URI: http://opensource.org/licenses/MIT

Programmatically update settings in development. The code checks which environment we're in. If it's one of the development environments and the update script hasn't been run already, it runs it.
This plugin is greatly inspired by Devin (https://twitter.com/devinsays), who wrote an article about it:
https://wptheming.com/2015/08/programmatically-update-staging-settings/

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// Ensuring that this is on Pantheon
if ( isset( $_ENV['PANTHEON_ENVIRONMENT'] ) ) :
	// Security Headers.
	require( 'site-config/security-headers.php' );

	// Disable Anonymous Access to WordPress Rest API.
	require( 'site-config/rest-api-disable-anonymous-access.php' );

	// Symlink to the environment configuration files.
	require( 'site-config/environment-specific-configs.php' );
endif;