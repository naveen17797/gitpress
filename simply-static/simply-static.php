<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'SIMPLY_STATIC_PATH', plugin_dir_path( __FILE__ ) );
// Check PHP version.
if ( version_compare( PHP_VERSION, '7.2.5', '<' ) ) {
	deactivate_plugins( plugin_basename( __FILE__ ) );
	wp_die( esc_html__( 'Simply Static requires PHP 7.2.5 or higher.', 'simply-static' ), 'Plugin dependency check', array( 'back_link' => true ) );
}

// localize.
$textdomain_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
load_plugin_textdomain( 'simply-static', false, $textdomain_dir );

// run autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) && ! class_exists( 'Simply_Static\Plugin' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}


/**
 * Run plugin
 */
function get_ss_instance() {
	require_once SIMPLY_STATIC_PATH . 'src/class-ss-plugin.php';

	return Simply_Static\Plugin::instance();
}

