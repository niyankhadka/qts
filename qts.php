<?php

/**
 * Plugin Name: Quick Theme Support
 * Plugin URI: #
 * Description: The best solution for quick support to theme and plugin users.
 * Version: 1.0.0
 * Author: niyankhadka
 * Author URI: https://github.com/niyankhadka/
 * Text Domain: qts
 * Domain Path: /languages
 * License:  GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'QTS_PLUGIN_NAME', 'Quick Theme Support' );
define( 'QTS_PLUGIN_VERSION', '1.0.0' );
define( 'QTS_PLUGIN_DIR', __DIR__);
define( 'QTS_PLUGIN_FILE', __FILE__);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-qts-activator.php
 */
function activate_qts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qts-activator.php';
	QTS_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-qts-deactivator.php
 */
function deactivate_qts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qts-deactivator.php';
	QTS_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_qts' );
register_deactivation_hook( __FILE__, 'deactivate_qts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-qts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_qts() {

	$plugin = new QTS();
	$plugin->run();
}
run_qts();