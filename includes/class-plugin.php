<?php
/**
 * Main plugin class.
 *
 * @package EphpicmanPlugin
 */

namespace EphpicmanPlugin;

defined( 'ABSPATH' ) || exit;

/**
 * Registers the plugin's runtime hooks.
 */
final class Plugin {

	/**
	 * Register hooks and initialize plugin functionality.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Load translations.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'ephpicman-plugin',
			false,
			dirname( plugin_basename( EPHPICMAN_PLUGIN_FILE ) ) . '/languages'
		);
	}
}
