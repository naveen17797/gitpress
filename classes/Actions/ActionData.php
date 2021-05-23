<?php

namespace Gitpress\Actions;

class ActionData {

	public $can_run_next_action = false;

	public $message = "";

	public function __construct( $can_run_next_action, $message) {
		$this->can_run_next_action = $can_run_next_action;
		$this->message = $message;
	}


}