<?php

namespace Gitpress\AdminBar;

class AdminBar {

	public function __construct() {

		add_action( 'admin_bar_menu', array( $this, 'admin_bar_item' ), 500 );
	}

	public function admin_bar_item( $admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}


		$title = "<p class='gitpress-sync'>Gitpress Sync Stats : No changes detected</p>";
		$href  = admin_url( 'admin.php?page=gitpress-config' );
		if ( ! get_field( 'git_username', "user_" . get_current_user_id() )
		     || ! get_field( 'git_password', "user_" . get_current_user_id() ) ) {
			$title = "<p class='gitpress-sync gitpress-sync-warning'>Gitpress Sync Stats : Configuration required</p>";
			$href  = get_edit_profile_url();
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
	}

}
