<?php
/*
Plugin Name: Gitpress
Plugin URI: https://github.com/naveen17797/gitpress
Description: Run your wordpress site on github
Version: 1.0
Author: Naveen Muthusamy
Author URI: http://github.com/naveen17797/
License: GPL2
*/

register_activation_hook( __FILE__, function () {
	wp_redirect( admin_url( "admin.php?page=gitpress-options" ) );
} );

add_action( 'init', function () {
	require_once __DIR__ . '/configuration.php';
} );


add_action( 'admin_notices', function () {

	if ( ! function_exists( 'get_field' ) ) {
		?>
        <div class="notice notice-error">
            <p><?php echo "ACF needs to be installed for gitpress to work" ?></p>
        </div>
		<?php
		// Dont do next checks if field is not defined.
		return;
	}

	if ( ! get_field( 'git_username', "user_" . get_current_user_id() ) ) {
		?>
        <div class="notice notice-error">
            <p><?php echo "Gitpress configuration failed : Please set your github / gitlab username " ?> <a
                        href="<?php echo get_edit_profile_url() ?>">here</a></p>
        </div>
		<?php
	}

	if ( ! get_field( 'git_password', "user_" . get_current_user_id() ) ) {
		?>
        <div class="notice notice-error">
            <p><?php echo "Gitpress configuration failed : Please set your github / gitlab password " ?> <a
                        href="<?php echo get_edit_profile_url() ?>">here</a></p>
        </div>
		<?php
	}


} );


add_action( 'admin_init', function () {
	wp_enqueue_style( 'dashicons' );
} );

add_action( 'admin_bar_menu', 'admin_bar_item', 500 );


function admin_bar_item( WP_Admin_Bar $admin_bar ) {
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


	wp_enqueue_style( 'gitpress-sync', plugin_dir_url( __FILE__ ) . "/assets/gitpress.css" );
}
