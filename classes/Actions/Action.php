<?php

namespace Gitpress\Actions;

abstract class Action {

	public function __construct() {
		$action = $this->get_action_slug();
		add_action( "wp_ajax_$action", array( $this, 'handle_action' ) );
	}

	/**
	 * @return string
	 */
	abstract function get_action_slug();

	/**
	 * @return ActionData
	 */
	abstract function handle_action();

}