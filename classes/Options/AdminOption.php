<?php

namespace Gitpress\Options;

class AdminOption {

	const OPTION_GROUP = 'gitpress-option-group';

	public function __construct() {
		add_action( 'admin_init', array( $this, 'add_settings' ) );

	}

	public function add_settings() {
		register_setting( self::OPTION_GROUP, 'gitpress_username' );
		register_setting( self::OPTION_GROUP, 'gitpress_password' );
		register_setting( self::OPTION_GROUP, 'gitpress_host' );

		add_settings_field( 'gitpress_username',
			__( 'Github/Gitlab username', 'gitpress' ),
			function () {
				$value = esc_html( get_option('gitpress_username', '') );
				echo "<input type='text' placeholder='Enter your github username' value='$value' name='gitpress_username'>";
			},
			'writing' );
		add_settings_field( 'gitpress_password',
			__( 'Github/Gitlab (password or token)', 'gitpress' ),
			function () {
				$value = esc_html( get_option('gitpress_password', '') );
				echo "<input type='password' placeholder='Enter your github password' value='$value' name='gitpress_password'>";
			},
			'writing' );
		add_settings_field( 'gitpress_host',
			__( 'Choose your hosting site', 'gitpress' ),
			function () {
				$value = esc_html( get_option('gitpress_username', '') );
				echo "<input type='text' placeholder='Enter your github username'>";
			},
			'writing' );


	}
}