<?php

namespace Gitpress\Pages\Config;

class ConfigPage {

	public function __construct() {

		add_action( 'admin_menu', function () {
			add_menu_page( 'Gitpress Configuration', 'Gitpress', 'manage_options', 'gitpress-config', array(
				$this,
				'gitpress_configuration_page'
			) );
		} );


	}


	public function gitpress_configuration_page() {
		$step = StepFactory::get_page();
		$step->render_page();
	}

}