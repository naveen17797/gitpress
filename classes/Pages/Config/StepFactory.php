<?php
namespace Gitpress\Pages\Config;

class StepFactory {

	/**
	 * @return Step
	 */
	public static function get_page() {
		if ( $_GET['step'] === 'clone-step') {
			return new CloneRepositoryStep();
		}
		else if ( $_GET['step'] === 'sync-step') {
			return new SyncStep();
		}
		return new RepositoryCheckStep();
	}


}