<?php

namespace Gitpress\Data;

class Credentials {

	private static $instance = null;

	public $username;

	public $password;

	public $host;

	public $repo_name;

	public $dir_name;

	public function __construct( $username, $password, $host ) {
		$this->username  = $username;
		$this->password  = $password;
		$this->host      = $host;
		$this->repo_name = "$username.$host.io";
		$this->dir_name  = "/var/www/html/$this->repo_name/";
	}


	public static function get_instance() {
		if ( self::$instance ) {
			return self::$instance;
		}
		/**
		 * @todo: this is a hack, should stop depending on acf and migrate
		 * to wordpress options.
		 */
		$username = get_field( 'git_username', "user_1" );
		$password = get_field( 'git_password', "user_1" );
		$host     = get_field( 'hosting_site', "user_1" );
		$host     = $host === '' ? $host : 'github';

		self::$instance = new Credentials(
			$username,
			$password,
			$host
		);

		return self::$instance;
	}


}