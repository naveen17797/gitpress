<?php

namespace Gitpress\Pages\Config;

class SyncStep implements Step {


	public function render_page() {

		$username = get_field( 'git_username', "user_" . get_current_user_id() );
		$host     = get_field( 'hosting_site', "user_" . get_current_user_id() );
		$host     = $host === '' ? $host : 'github';
		$url      = "$username.$host.io";

		?>
        <h3>Syncing site to  <?php echo $url; ?> </h3>

        <div id="gitpress_log"></div>
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

}