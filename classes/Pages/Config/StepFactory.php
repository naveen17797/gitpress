<?php
namespace Gitpress\Pages\Config;

class StepFactory {

	/**
	 * @return Step
	 */
	public static function get_page() {
		return new RepositoryCheckStep();


	}


}