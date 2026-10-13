<?php
/**
 * Deactivation routines.
 *
 * @package EphpicmanPlugin
 */

namespace EphpicmanPlugin;

defined( 'ABSPATH' ) || exit;

/**
 * Runs when the plugin is deactivated.
 */
final class Deactivator {

	/**
	 * Perform temporary cleanup on deactivation.
	 *
	 * Do not delete persistent user data here; reserve that for uninstall.php.
	 *
	 * @return void
	 */
	public static function deactivate() {
		// Add cleanup only when the plugin introduces temporary state.
	}
}
