<?php
namespace Gitpress\Actions;

use Gitpress\Data\Credentials;

class ShouldDoSyncAction extends Action {

	function get_action_slug() {
		return "gitpress_should_do_sync";
	}

	function handle_action() {

		$credentials = Credentials::get_instance();
		$response = wp_remote_get( "https://api.github.com/repos/$credentials->username/$credentials->username.github.io" );
		wp_send_json_success(array(


		));

	}
}