<?php
/**
 * Backward-compatibility loader for installations that still have the legacy
 * plugin path stored as active.
 *
 * @package EphpicmanPlugin
 */

defined( 'ABSPATH' ) || exit;

$legacy_plugin = plugin_basename( __FILE__ );
$plugin_directory = dirname( $legacy_plugin );
$new_plugin = ( '.' === $plugin_directory ? '' : $plugin_directory . '/' ) . 'index.php';

$active_plugins = (array) get_option( 'active_plugins', array() );

if ( in_array( $legacy_plugin, $active_plugins, true ) ) {
	$active_plugins = array_diff( $active_plugins, array( $legacy_plugin ) );
	$active_plugins[] = $new_plugin;

	update_option( 'active_plugins', array_values( array_unique( $active_plugins ) ) );
}

if ( is_multisite() ) {
	$network_active_plugins = (array) get_site_option( 'active_sitewide_plugins', array() );

	if ( isset( $network_active_plugins[ $legacy_plugin ] ) ) {
		$network_active_plugins[ $new_plugin ] = $network_active_plugins[ $legacy_plugin ];
		unset( $network_active_plugins[ $legacy_plugin ] );

		update_site_option( 'active_sitewide_plugins', $network_active_plugins );
	}
}

require_once __DIR__ . '/index.php';
