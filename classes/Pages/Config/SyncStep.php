<?php

namespace Gitpress\Pages\Config;

class SyncStep implements Step {


	public function render_page() {

		$username = get_field( 'git_username', "user_" . get_current_user_id() );
		$password = get_field( 'git_password', "user_" . get_current_user_id() );
		$host     = get_field( 'hosting_site', "user_" . get_current_user_id() );
		$host     = $host === '' ? $host : 'github';
		$url      = "$username.$host.io";
		wp_enqueue_script( 'gitpress-sync', plugin_dir_url( __FILE__ ) . "/../../../../assets/gitpress.js" );
		?>
        <h3>Syncing site to  <?php echo $url; ?> </h3>


		<?php
		if ( is_dir( "/var/www/html/$url/" ) ) {
		}
		else {
		    echo  "Failed";
		}

		?>
        <h4>Clone complete for <?php echo $url; ?>, click on next to continue </h4>
        <a class='page-title-action' href="?page=gitpress-config&step=sync-step">Next</a>
		<?php

	}

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


	public function exec( $command ) {
		echo "<h4>Executing command: <code>$command</code></h4>";
		echo $this->runCommand( $command );

	}
}