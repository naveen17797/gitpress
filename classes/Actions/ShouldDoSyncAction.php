<?php
namespace Gitpress\Actions;

class ShouldDoSyncAction extends Action {

	function get_action_slug() {
		return "gitpress_should_do_sync";
	}

	function handle_action() {

		wp_send_json_success();

	}
}