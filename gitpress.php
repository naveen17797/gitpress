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

use Gitpress\Data\Credentials;
use Gitpress\Notification\Notification;
use Gitpress\Pages\Config\ConfigPage;

require_once __DIR__ . "/simply-static/simply-static.php";


add_action( 'init', function () {
	require_once __DIR__ . '/configuration.php';
} );


require_once __DIR__ . "/autoloader.php";


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


} );

function runCommand( $bin, $command = '', $force = true ) {
	$stream = null;
	$bin    .= $force ? ' 2>&1' : '';

	$descriptorSpec = array
	(
		0 => array( 'pipe', 'r' ),
		1 => array( 'pipe', 'w' )
	);

	$process = proc_open( $bin, $descriptorSpec, $pipes );

	if ( is_resource( $process ) ) {
		fwrite( $pipes[0], $command );
		fclose( $pipes[0] );

		$stream = stream_get_contents( $pipes[1] );
		fclose( $pipes[1] );

		proc_close( $process );
	}

	return $stream;
}


add_action( 'wp_ajax_gitpress_commit_changes', function () {
	$credentials = Credentials::get_instance();
	$username    = $credentials->username;
	$password    = $credentials->password;
	$dir         = $credentials->dir_name;
	$date        = date( 'Y-m-d h:i:s' );


	wp_send_json_success( array(
		'activity_log_html' => $dir . runCommand( "git -C $dir config user.email kmnaveen101@gmail.com" )
		                       . runCommand( "git -C $dir config user.name $username" )
		                       . runCommand( "git -C $dir config user.password $password" )
		                       . runCommand( "git -C $dir add ." )
		                       . runCommand( "cd $dir" ) . runCommand( "git -C $dir commit -am 'saving changes on $date'" )
	) );
} );


add_action( 'wp_ajax_gitpress_push', function () {
	$credentials = Credentials::get_instance();
	$username    = $credentials->username;
	$password    = $credentials->password;
	$host        = $credentials->host;
	$url         = $credentials->repo_name;
	$dir         = $credentials->dir_name;
	wp_send_json_success( array(
		'activity_log_html' =>
			runCommand( "git -C $dir remote rm origin" ) .
			runCommand( "git -C $dir remote add origin https://$password@$host.com/$username/$url" ) .
			runCommand( "git -C $dir config user.email kmnaveen101@gmail.com" )
			. runCommand( "git -C $dir config user.name $username" )
			. runCommand( "git -C $dir config user.password $password" ) .
			runCommand( "git -C $dir push origin master" )
	) );
} );

