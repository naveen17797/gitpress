<?php

namespace Gitpress\Actions;

use Gitpress\Data\Credentials;

class CloneRepoAction extends Action {

	function get_action_slug() {
		return "gitpress_clone_repo_action";
	}

	function handle_action() {
		$credentials = Credentials::get_instance();
		$username    = $credentials->username;
		$url         = $credentials->repo_name;
		$repo_url    = "https://github.com/$username/$url";

		if ( ! is_dir($credentials->dir_name)) {
			$output = gitPressExecCommand( "cd /var/www/html/ && git clone $repo_url" )
			          . "\n" . gitPressExecCommand( "chmod 777 -R /var/www/html/$url/" );
		}
		else {
			$output = "Repo already cloned, proceeding to file generation";
		}
		return new ActionData(true, $output);
	}
}