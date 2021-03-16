<?php

/**
 * Fired during plugin activation
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/includes
 * @author     Viktor H. Morales <viktorhugomorales@gmail.com>
 */
class Vhm_Share_Buttons_Activator {
	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private static $option_name = 'vhm_share_buttons';
	
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	private static $plugin_name = 'vhm-share-buttons';

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
        
		// Add default options
		update_option(self::$option_name . '_active', 'on');
		update_option(self::$option_name . '_applications', array('facebook','twitter','whatsapp','telegram','link'));
		update_option(self::$option_name . '_source', array('post','page'));
		update_option(self::$option_name . '_display', 'after_content');
	}

}
