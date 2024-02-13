<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://kamalhossan.github.io/
 * @since      1.0.0
 *
 * @package    User_Tour_Guide
 * @subpackage User_Tour_Guide/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    User_Tour_Guide
 * @subpackage User_Tour_Guide/admin
 * @author     Kamal Hossan <kamal.hossan35@gmail.com>
 */
class User_Tour_Guide_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The name of the DB of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $user_tour_guide_db_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $db_name ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->user_tour_guide_db_name = $db_name;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// get current page status 
		$current_screen = get_current_screen();

		// Check if user are on my plugin's page
		if ($current_screen && $current_screen->id === 'toplevel_page_user_tour_guide') {
			// Enqueue your style  here
			wp_enqueue_style( 'bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/user-tour-guide-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, 'https://unpkg.com/@sjmc11/tourguidejs/dist/css/tour.min.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register Admin Menu Page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function user_tour_guide_settings_page() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/user-tour-guide-admin.css', array(), $this->version, 'all' );

		add_menu_page( 'User Tour Guide', 'User Tour Guide', 'manage_options', 'user_tour_guide', array( $this, 'user_tour_guide_settings_page_callback' ), 'dashicons-admin-plugins', 99 );

	}

	function user_tour_guide_settings_page_callback(){
		
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	?>
	<div class="wrap">
		<h2><?php esc_html_e( 'User Tour Guide Options', 'user-tour-guide' ); ?></h2>

		<?php
		// Get the active tab from the $_GET param
		// $default_tab = 'create_tour';
		// $active_tab  = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : $default_tab; // // phpcs:ignore csrf ok, sanitization ok. 
		// ?>

		<!-- <h2 class="nav-tab-wrapper">
			<a href="?page=user_tour_guide&tab=create_tour"
				class="nav-tab create-tour <?php // echo $active_tab == 'create_tour' ? 'nav-tab-active' : ''; ?>"><?php // esc_html_e( 'Create a Tour', 'user-tour-guide' ); ?></a>
			<a href="?page=user_tour_guide&tab=tour_options"
				class="nav-tab tour-options <?php // echo $active_tab == 'tour_options' ? 'nav-tab-active' : ''; ?>"><?php // esc_html_e( 'Tour Options', 'user-tour-guide' ); ?></a>
			<a href="?page=user_tour_guide&tab=style"
				class="nav-tab tour-style <?php // echo $active_tab == 'style' ? 'nav-tab-active' : ''; ?>"><?php // esc_html_e( 'Style', 'user-tour-guide' ); ?></a>
			<a href="?page=user_tour_guide&tab=faq"
				class="nav-tab tour-faq <?php // echo $active_tab == 'style' ? 'nav-tab-active' : ''; ?>"><?php // esc_html_e( 'FAQ', 'user-tour-guide' ); ?></a>
		</h2> -->

		<?php
		// switch ( $active_tab ) :
		// 	case 'create_tour':
		// 		include_once plugin_dir_path( __FILE__ ) . 'partials/form-create.php';
		// 		break;
		// 	case 'tour_options':
		// 		include_once plugin_dir_path( __FILE__ ) . 'partials/form-general.php';
		// 		break;
		// 	case 'style':
		// 		include_once plugin_dir_path( __FILE__ ) . 'partials/form-color-picker.php';
		// 		break;
		// 	case 'faq':
		// 		include_once plugin_dir_path( __FILE__ ) . 'partials/faq.php';
		// 		break;
		// endswitch;

		// include admin modal
		include_once plugin_dir_path( __FILE__ ) . 'partials/admin-modal.php';
		
		?>
		
	</div> 
	<?php
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// get current page status 
		$current_screen = get_current_screen();

		// Check if user are on my plugin's page
		if ($current_screen && $current_screen->id === 'toplevel_page_user_tour_guide') {
			// Enqueue your script here
			wp_enqueue_script( 'bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
			', array(), $this->version, false );
			wp_enqueue_script( 'intro-script', 'https://unpkg.com/@sjmc11/tourguidejs/dist/tour.js', array(), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/user-tour-guide-admin.js', array( 'jquery', 'intro-script' ), $this->version, false );
			wp_localize_script( 'intro-script', 'utg_admin_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'utg_admin_nonce' ),
				)
			);
		}

		
	}

	public function utg_get_tour_data_from_db(){

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $wpdb;

		$table_name = $wpdb->prefix . $this-> user_tour_guide_db_name;
		$results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

		header('Content-Type: application/json');
		echo $steps = wp_json_encode($results);

		die();
	}

	public function utg_add_steps_to_db(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $wpdb;

		$step_title = sanitize_text_field($_POST['stepTitle']);
		$step_content = sanitize_text_field($_POST['stepContent']);
		$step_target = sanitize_text_field($_POST['stepTarget']);
		$step_order =sanitize_text_field($_POST['stepOrder']);

		$table_name = $wpdb->prefix . $this->user_tour_guide_db_name;

		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

			$charset_collate = $wpdb->get_charset_collate();
	
			$sql = "CREATE TABLE $table_name (
				id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
				`title` VARCHAR(100) NULL,
				`content` VARCHAR(500) NULL,
				`target` VARCHAR(100) NULL,
				`order` VARCHAR(50) NULL,
				`group` VARCHAR(50) NULL,
				PRIMARY KEY (id)
			) $charset_collate;";
	
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			$results = dbDelta($sql);

			if($results !== false){
					$this -> run_add_step_to_db($step_title, $step_content, $step_target, $step_order);
			}
		} else {
			$this -> run_add_step_to_db($step_title, $step_content, $step_target, $step_order);
		}

		echo true;

		die();
	}


	public function utg_edit_steps_to_db(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		global $wpdb;

		$db_id = sanitize_text_field($_POST['id']);
		$step_title = sanitize_text_field($_POST['stepTitle']);
		$step_content = sanitize_text_field($_POST['stepContent']);
		$step_target = sanitize_text_field($_POST['stepTarget']);
		$step_order =sanitize_text_field($_POST['stepOrder']);

		$table_name = $wpdb->prefix . $this->user_tour_guide_db_name;

		$wpdb->query(
			$wpdb->prepare(
			"UPDATE $table_name SET `title` = %s, `content` = %s,`target` = %s , `order` = %s WHERE `id` = %s",
			$step_title, $step_content , $step_target, $step_order , $db_id)
		);

		echo 'updated';

		die();
		
	}

	public function utg_remove_steps_from_db(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		global $wpdb;

		$db_id = sanitize_text_field($_POST['id']);

		$table_name = $wpdb->prefix . $this->user_tour_guide_db_name;

		$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE `id` = %s", $db_id));

		echo 'deleted' . $db_id;

		die();
		
	}

	// this function will add steps data into the database
	public function run_add_step_to_db($step_title = '', $step_content = '', $step_target = '', $step_order = ''){

		global $wpdb;

		$tour_name = 'User Tour Guide';
		$tour_name = strtolower(str_replace(' ', '-', $tour_name));

		$table_name = $wpdb->prefix . $this->user_tour_guide_db_name;

		// right wpdb query to insert data into table
		$wpdb->query(
			$wpdb->prepare(
			"INSERT INTO $table_name
			( `title`, `content`,`target` , `order` , `group` )
			VALUES ('%s' , %s , %s , %s , %s)",
			array($step_title, $step_content , $step_target, $step_order , $tour_name)
			)
		);
	}

}
