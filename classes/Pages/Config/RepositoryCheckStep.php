<?php

namespace Gitpress\Pages\Config;

class RepositoryCheckStep implements Step {


	public function render_page() {
		$username = get_field( 'git_username', "user_" . get_current_user_id() );

		$host = get_field( 'git_password', "user_" . get_current_user_id() );

		$host = $host === '' ? $host : 'github';

		$url = "$username.$host.io";


		?>
        <h1>Step 1 of 3</h1>
        <h2>Checking if <?php echo $url; ?> exists</h2>
		<?php

		$response = wp_remote_get( "https://api.github.com/repos/$username/$username.github.io" );

		if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
			?>
            <h3><?php echo $url ?> repository not exists</h3>
			<?php

		} else {
			?>
            <h3>Congratulations, <?php echo  $url; ?> exists and public, click on next</h3>
            <a class='page-title-action' href="?page=gitpress-config&step=clone-step">Next</a>
			<?php
		}

	}
}