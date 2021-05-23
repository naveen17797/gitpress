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

use Gitpress\Actions\CommitAction;
use Gitpress\Actions\PushAction;
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
	new Notification();
	new AdminBar();
	new ConfigPage();
} );

function gitPressExecCommand( $bin, $command = '', $force = true ) {
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

/**
 * Following is the sequence of actions which the client should call
 *
 * 1. Call ShouldDoSyncAction and verify if we have all credentials to do a sync, can_proceed_next_action.
 * 2. Clone the repo and start the procedure.
 * 3. Once the procedure ends then commit the changes
 * 4. Call push action and end the sync.
 */



new CommitAction();

new PushAction();

