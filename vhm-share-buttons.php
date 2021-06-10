<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://viktormorales.com
 * @since             1.0.0
 * @package           Vhm_Share_Buttons
 *
 * @wordpress-plugin
 * Plugin Name:       VHM Share buttons
 * Plugin URI:        https://github.com/viktormorales/VHM-Share-Buttons
 * GitHub Plugin URI: https://github.com/viktormorales/VHM-Share-Buttons
 * Description:       Add social buttons to your WordPress Theme.
 * Version:           1.0.4
 * Author:            Viktor H. Morales
 * Author URI:        https://viktormorales.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vhm-share-buttons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VHM_SHARE_BUTTONS_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vhm-share-buttons-activator.php
 */
function activate_vhm_share_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vhm-share-buttons-activator.php';
	Vhm_Share_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vhm-share-buttons-deactivator.php
 */
function deactivate_vhm_share_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vhm-share-buttons-deactivator.php';
	Vhm_Share_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vhm_share_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_vhm_share_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vhm-share-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vhm_share_buttons() {

	$plugin = new Vhm_Share_Buttons();
	$plugin->run();

}
run_vhm_share_buttons();
