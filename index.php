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

define( 'EPHPICMAN_PLUGIN_FILE', __FILE__ );

require_once __DIR__ . '/epm/bootstrap.php';
require_once __DIR__ . '/src/Plugin.php';

EpmLoader::register(
	'1.4.0',
	'EphpicmanPlugin\\',
	__DIR__
);

$plugin = EphpicmanPlugin\Plugin::get_instance();

register_activation_hook( __FILE__, array( $plugin, 'activate' ) );
register_deactivation_hook( __FILE__, array( $plugin, 'deactivate' ) );

add_action( 'init', array( $plugin, 'init' ) );
