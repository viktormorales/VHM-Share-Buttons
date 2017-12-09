<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/includes
 * @author     Viktor H. Morales <viktorhugomorales@gmail.com>
 */
class Vhm_Share_Buttons_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'vhm-share-buttons',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
