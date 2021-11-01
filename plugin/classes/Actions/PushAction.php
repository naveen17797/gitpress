<?php

namespace Gitpress\Actions;

use Gitpress\Data\Credentials;

class PushAction extends Action {


	function get_action_slug() {
		return "gitpress_push";
	}

	function handle_action() {
		$credentials = Credentials::get_instance();
		$username    = $credentials->username;
		$password    = $credentials->password;
		$host        = $credentials->host;
		$url         = $credentials->repo_name;
		$dir         = $credentials->dir_name;

		return new ActionData(
			true,
			gitPressExecCommand( "git -C $dir remote rm origin" ) .
			gitPressExecCommand( "git -C $dir remote add origin https://$password@$host.com/$username/$url" ) .
			gitPressExecCommand( "git -C $dir config user.email gitpress@gmail.com" )
			. gitPressExecCommand( "git -C $dir config user.name $username" )
			. gitPressExecCommand( "git -C $dir config user.password $password" ) .
			gitPressExecCommand( "git -C $dir push origin master" )
		);
	}
}