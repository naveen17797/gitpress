<?php

namespace Gitpress\Pages\Config;

class CloneRepositoryStep implements Step {


	public function render_page() {

		$username = get_field( 'git_username', "user_" . get_current_user_id() );
		$password = get_field( 'git_password', "user_" . get_current_user_id() );
		$host     = get_field( 'hosting_site', "user_" . get_current_user_id() );
		$host     = $host === '' ? $host : 'github';
		$url      = "$username.$host.io";

		?>
        <h3>Cloning <?php echo $url; ?> </h3>


		<?php

		if ( ! is_dir( "/var/www/html/$url/" ) ) {
			$this->exec( "su root" );
			$repo_url = "https://github.com/$username/$url";
			$this->exec( "cd /var/www/html/ && git clone $repo_url" );
			$this->exec( "chmod 777 -R /var/www/html/$url/" );
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