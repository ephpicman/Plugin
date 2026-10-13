<?php
/**
 * Plugin Name:       Ephpicman Plugin Starter
 * Plugin URI:        https://github.com/ephpicman/Plugin
 * Description:       A lightweight foundation for Ephpicman WordPress plugins.
 * Version:           1.0.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Ephpicman
 * Author URI:        https://github.com/ephpicman
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ephpicman-plugin
 * Domain Path:       /languages
 *
 * @package EphpicmanPlugin
 */

defined( 'ABSPATH' ) || exit;

define( 'EPHPICMAN_PLUGIN_VERSION', '1.0.0' );
define( 'EPHPICMAN_PLUGIN_FILE', __FILE__ );
define( 'EPHPICMAN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EPHPICMAN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once EPHPICMAN_PLUGIN_DIR . 'includes/class-activator.php';
require_once EPHPICMAN_PLUGIN_DIR . 'includes/class-deactivator.php';
require_once EPHPICMAN_PLUGIN_DIR . 'includes/class-plugin.php';

register_activation_hook( __FILE__, array( 'EphpicmanPlugin\\Activator', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'EphpicmanPlugin\\Deactivator', 'deactivate' ) );

/**
 * Start the plugin.
 *
 * @return void
 */
function ephpicman_plugin_run() {
	$plugin = new EphpicmanPlugin\Plugin();
	$plugin->run();
}

ephpicman_plugin_run();
