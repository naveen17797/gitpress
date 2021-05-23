<?php

namespace Gitpress\Actions;

abstract class Action {

	public function __construct() {
		$action = $this->get_action_slug();
		add_action( "wp_ajax_$action", array( $this, 'give_response' ) );
	}

	/**
	 * @return string
	 */
	abstract function get_action_slug();

	/**
	 * @return ActionData
	 */
	abstract function handle_action();

	function give_response() {
		return wp_send_json_success( $this->handle_action() );
	}

}