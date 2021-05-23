<?php

namespace Gitpress\AdminBar;

use Gitpress\Data\Credentials;

class AdminBar {

	public function __construct() {

		add_action( 'admin_bar_menu', array( $this, 'admin_bar_item' ), 500 );
	}

	public function admin_bar_item( $admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$credentials = Credentials::get_instance();


		$href = admin_url( 'admin.php?page=gitpress-config' );

		if ( ! $credentials->username
		     || ! $credentials->password ) {
			$title = "<p class='gitpress-sync gitpress-sync-warning' id='gitpress_sync_button'>Gitpress Sync Stats : Configuration required</p>";
			$href  = get_edit_profile_url();
		} else {
			$repo_name = $credentials->repo_name;
			$title     = "<p class='gitpress-sync' id='gitpress_sync_button' >Gitpress : Sync $repo_name</p>";
			$href      = "#";
		}

		$admin_bar->add_menu( array(
			'id'     => 'gitpress-sync-stats',
			'parent' => null,
			'group'  => null,
			'title'  => $title, //you can use img tag with image link. it will show the image icon Instead of the title.
			'href'   => $href,
			'meta'   => [
				'title' => __( 'Gitpress Sync Stats', 'gitpress' ), //This title will show on hover
			]
		) );


		wp_enqueue_style( 'gitpress-sync', plugin_dir_url( __FILE__ ) . "/../../../assets/gitpress.css" );
		wp_enqueue_script( 'gitpress-sync', plugin_dir_url( __FILE__ ) . "/../../../assets/gitpress.js" );

	}

}
