<?php
/**
 * Activation routines.
 *
 * @package EphpicmanPlugin
 */

namespace EphpicmanPlugin;

defined( 'ABSPATH' ) || exit;

/**
 * Runs when the plugin is activated.
 */
final class Activator {

	/**
	 * Perform activation tasks.
	 *
	 * Add option creation or migrations here only when the plugin needs them.
	 *
	 * @return void
	 */
	public static function activate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
	}
}
