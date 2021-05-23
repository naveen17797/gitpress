<?php
namespace Gitpress\Actions;

use Gitpress\Data\Credentials;

class CommitAction extends Action {

	function get_action_slug() {
		return "gitpress_commit_changes";
	}

	function handle_action() {

		$credentials = Credentials::get_instance();
		$username    = $credentials->username;
		$password    = $credentials->password;
		$dir         = $credentials->dir_name;
		$date        = date( 'Y-m-d h:i:s' );


		wp_send_json_success( array(
			'activity_log_html' =>
				gitPressExecCommand( "git -C $dir config user.email kmnaveen101@gmail.com" )
				. gitPressExecCommand( "git -C $dir config user.name $username" )
				. gitPressExecCommand( "git -C $dir config user.password $password" )
				. gitPressExecCommand( "git -C $dir add ." )
				. gitPressExecCommand( "cd $dir" ) . gitPressExecCommand( "git -C $dir commit -am 'saving changes on $date'" )
		) );
	}
}