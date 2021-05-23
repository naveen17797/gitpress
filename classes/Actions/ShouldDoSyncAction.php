<?php

namespace Gitpress\Actions;

use Gitpress\Data\Credentials;

class ShouldDoSyncAction extends Action {

	function get_action_slug() {
		return "gitpress_should_do_sync";
	}

	function handle_action() {

		$credentials = Credentials::get_instance();
		$response    = wp_remote_get( "https://api.github.com/repos/$credentials->username/$credentials->username.github.io" );
		$repo_exists = wp_remote_retrieve_response_code( $response ) === 200;
		$message     = $repo_exists ? "Repository $credentials->repo_name is available and public" : "Repository $credentials->repo_name doesnt exist";

		return new ActionData( $repo_exists, $message );
	}
}