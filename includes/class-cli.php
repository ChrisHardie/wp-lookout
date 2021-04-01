<?php

/**
 * Class Wp_Lookout_Cli - handles the WP CLI commands.
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

WP_CLI::add_command( 'wplookout', 'Wp_Lookout_Cli' );

/**
 * Manage WP Lookout settings.
 */
class Wp_Lookout_Cli extends WP_CLI_Command {
	/**
	 * Sets the WP Lookout account API key to use for updates.
	 *
	 * ## OPTIONS
	 *
	 * <key>
	 * : The API key to use for communications with the WP Lookout app.
	 *
	 * ## EXAMPLES
	 *
	 *     wp wplookout set_api_key 123456ABCDEF
	 *
	 * @when after_wp_load
	 */
	public function set_api_key( $args, $assoc_args ) {
		if ( empty( $args[0] ) ) {
			WP_CLI::error( __( 'No key specified.' ) );
			return;
		}

		$wpl_options = get_option( 'wp_lookout_settings' );
		$wpl_options['wp_lookout_api_key'] = esc_attr( $args[0] );
		update_option( 'wp_lookout_settings', $wpl_options );

		WP_CLI::success( __( 'WP Lookout API Key was updated.' ) );
	}

}