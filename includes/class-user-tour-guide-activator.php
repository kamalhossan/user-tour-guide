<?php

/**
 * Fired during plugin activation
 *
 * @link       https://kamalhossan.github.io/
 * @since      1.0.0
 *
 * @package    User_Tour_Guide
 * @subpackage User_Tour_Guide/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    User_Tour_Guide
 * @subpackage User_Tour_Guide/includes
 * @author     Kamal Kamal <kamal.hossan35@gmail.com>
 */
class User_Tour_Guide_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// wp_redirect( admin_url( 'admin.php?page=user-tour-guide' ), 301 );

		global $wpdb;

		$table_name = $wpdb->prefix . 'user_tour_guide'; // Replace 'your_table_name' with the desired table name
	
		// Check if the table already exists
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			// Table does not exist, so create it
	
			$charset_collate = $wpdb->get_charset_collate();
	
			$sql = "CREATE TABLE $table_name (
				id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
				step_title VARCHAR(100) NULL,
				step_content VARCHAR(500) NULL,
				target_element VARCHAR(100) NULL,
				steps_order VARCHAR(50) NULL,
				group_name VARCHAR(50) NULL,
				PRIMARY KEY (id)
			) $charset_collate;";
	
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);

		}
	}

}
