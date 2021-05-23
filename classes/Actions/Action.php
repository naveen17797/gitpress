<?php

namespace Gitpress\Actions;

abstract class Action {

	public function __construct() {
		$action = $this->get_action_slug();
		add_action( "wp_ajax_$action", array( $this, 'get_action_slug' ) );
	}

	/**
	 * @return string
	 */
	abstract function get_action_slug();

}