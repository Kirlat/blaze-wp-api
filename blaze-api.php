<?php
namespace Blaze\API;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://yula.media
 * @since             1.0.0
 * @package           Blaze_Endpoints
 *
 * @wordpress-plugin
 * Plugin Name:       Blaze Endpoints
 * Plugin URI:        http://yula.media
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Kirill Latyshev
 * Author URI:        http://yula.media
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       blaze-endpoints
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Autoloader
require_once dirname(__FILE__) . '/autoloader.php';


/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_blaze_endpoints() {
	add_action( 'rest_api_init', function () {
		$list_controller = new Routes\List_Controller();
		$list_controller->register_routes();
	} );

}

run_blaze_endpoints();
