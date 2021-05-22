<?php
/*
Plugin Name: Gitpress
Plugin URI: https://github.com/naveen17797/gitpress
Description: Run your wordpress site on github or gitlab
Version: 1.0
Author: Naveen Muthusamy
Author URI: http://github.com/naveen17797/
License: GPL2
*/

use Gitpress\AdminBar\AdminBar;

use Gitpress\Notification\Notification;
use Gitpress\Pages\Config\ConfigPage;



add_action( 'init', function () {
	require_once __DIR__ . '/configuration.php';
} );


spl_autoload_register( function ( $class ) {
	//change this to your root namespace
	$prefix = 'Gitpress\\';

	// Dont autoload other classes.
	if ( strpos( $class, "Gitpress\\", 0 ) === false ) {
		return;
	}

	//make sure this is the directory with your classes
	$base_dir = __DIR__ . '/classes/';
	$len      = strlen( $prefix );
	if ( strncmp( $prefix, $class, $len ) !== 0 ) {
		return;
	}
	$relative_class = substr( $class, $len );
	$file           = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';
	if ( file_exists( $file ) ) {
		require $file;
	}

} );




add_action( 'init', function () {
	$username = get_field( 'git_username', "user_" . get_current_user_id() );
	$host     = get_field( 'hosting_site', "user_" . get_current_user_id() );
	$host     = $host === '' ? $host : 'github';
	$url      = "$username.$host.io";

	add_filter( 'ss_local_dir', function () use ( $url ) {
		return "/var/www/html/$url/";
	} );

	add_filter( 'gitpress_config_ss_delivery_method', function () use ( $url ) {
		return "local";
	} );

	new Notification();
	new AdminBar();
	new ConfigPage();

	require_once __DIR__ . "/simply-static/simply-static.php";

} );




