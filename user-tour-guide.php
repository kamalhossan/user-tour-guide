<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://kamalhossan.github.io/
 * @since             1.0.0
 * @package           User_Tour_Guide
 *
 * @wordpress-plugin
 * Plugin Name:       User Tour Guide
 * Plugin URI:        https://kamalhossan.github.io/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Kamal Hossan
 * Author URI:        https://kamalhossan.github.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       user-tour-guide
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// define file path declare anywhere
define( 'USER_TOUR_GUIDE_PLUGIN_FILE', __FILE__ );

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
// define( 'USER_TOUR_GUIDE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-user-tour-guide-activator.php
 */
function activate_user_tour_guide() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-tour-guide-activator.php';
	User_Tour_Guide_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-user-tour-guide-deactivator.php
 */
function deactivate_user_tour_guide() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-tour-guide-deactivator.php';
	User_Tour_Guide_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_user_tour_guide' );
register_deactivation_hook( __FILE__, 'deactivate_user_tour_guide' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-user-tour-guide.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_user_tour_guide() {

	$plugin = new User_Tour_Guide();
	$plugin->run();

}
run_user_tour_guide();