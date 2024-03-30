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
if ( ! defined( 'ABSPATH' ) ) exit; 
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
		$this->load_dependencies();

	}

	private function load_dependencies(){
		/**
		 * The class responsible for defining doing all queries.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-user-tour-guide-query.php';

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
			wp_enqueue_style( 'bootstrap-style', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/user-tour-guide-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'tour-css', plugin_dir_url(USER_TOUR_GUIDE_PLUGIN_FILE) . 'public/css/tour.min.css', array(), $this->version, 'all' );
		}
		if ($current_screen && $current_screen->id === 'user-tour-guide_page_user_tour_guide_settings') {
			wp_enqueue_style( 'setting-css', plugin_dir_url( __FILE__ ) . 'css/user-tour-guide-setting.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register Admin Menu Page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function utgk_user_tour_guide_settings_page() {

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

		add_menu_page( 'User Tour Guide', 'User Tour Guide', 'manage_options', 'user_tour_guide', array( $this, 'utgk_user_tour_guide_settings_page_callback' ), 'dashicons-schedule', 99 );

		add_submenu_page(
			'user_tour_guide', // Parent slug
			'User Tour Guide Settings', // Page title
			'Settings', // Menu title
			'manage_options', // Capability
			'user_tour_guide_settings', // Menu slug
			array($this, 'utgk_user_tour_guide_options_page'), // Callback function
		);


	}

	public function utgk_user_tour_guide_register_settings() {
		// Register a setting for your plugin
		register_setting( 'user_tour_guide_options', 'utg_tour_option' );
		register_setting( 'user_tour_guide_options', 'start_immidiately', array(
			'type' => 'string',
			'default' => '1',
		));
		register_setting( 'user_tour_guide_options', 'auto_start_for_new_user');
		register_setting( 'user_tour_guide_options', 'show_begin_tour', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '0', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'show_dots', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'show_close_button', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'show_prev_button', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'show_next_button', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'show_step_progress', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'enable_keyboard_control', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'exit_on_escape', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '1', // Set your default value here
			)
		);
		register_setting( 'user_tour_guide_options', 'exit_on_click_outside', array(
			'type' => 'string', // Data type (string, boolean, integer, etc.)
			'default' => '0', // Set your default value here
			)
		);
	}

	public function utgk_user_tour_guide_options_page() {
		?>
		<div class="wrap">
			<h2>User Tour Guide Options Global</h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'user_tour_guide_options' ); ?>
				<?php do_settings_sections( 'user_tour_guide_options' ); ?>
				<table class="form-table">
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="utg_tour_option" value="1" <?php checked( get_option( 'utg_tour_option' ), 1 ); ?> /></td>
						<td scope="row">Disabled User Tour Guide</th>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="start_immidiately" value="1" <?php checked( get_option( 'start_immidiately' ), 1 ); ?> /></td>
						<td scope="row">Start tour on every page loads for all user</td>
					</tr>
					<tr valign="top">
						<?php if(get_option( 'start_immidiately')){
							$disable_new_user_options = true;
						} else {
							$disable_new_user_options = false;
						}
						?>
						<td class="checkbox"><input type="checkbox" name="auto_start_for_new_user" value="1" <?php echo ($disable_new_user_options) ? 'disabled' : checked( get_option( 'auto_start_for_new_user' ), 1 ); ?> /></td>
						<td scope="row">Auto start tour if user is new</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="show_begin_tour" value="1" <?php checked( get_option( 'show_begin_tour' ), 1 ); ?> /></td>
						<td scope="row">Show Begin Tour Button</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="show_dots" value="1" <?php checked( get_option( 'show_dots' ), 1 ); ?> /></td>
						<td scope="row">Show Dots</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="show_close_button" value="1" <?php checked( get_option( 'show_close_button' ), 1 ); ?> /></td>
						<td scope="row">Show Close Button</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="show_prev_button" value="1" <?php checked( get_option( 'show_prev_button' ), 1 ); ?> /></td>
						<td scope="row">Show Previous Button</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="show_next_button" value="1" <?php checked( get_option( 'show_next_button' ), 1 ); ?> /></td>
						<td scope="row">Show Next Button</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="show_step_progress" value="1" <?php checked( get_option( 'show_step_progress' ), 1 ); ?> /></td>
						<td scope="row">Show Step Progress</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="enable_keyboard_control" value="1" <?php checked( get_option( 'enable_keyboard_control' ), 1 ); ?> /></td>
						<td scope="row">Enable Keyboard Control</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="exit_on_escape" value="1" <?php checked( get_option( 'exit_on_escape' ), 1 ); ?> /></td>
						<td scope="row">Exit On Escape</td>
					</tr>
					<tr valign="top">
						<td class="checkbox"><input type="checkbox" name="exit_on_click_outside" value="1" <?php checked( get_option( 'exit_on_click_outside' ), 1 ); ?> /></td>
						<td scope="row">Exit On Click Outside</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register the display page for user tour guide plugin.
	 *
	 * @since    1.0.0
	 */

	public function utgk_user_tour_guide_settings_page_callback(){
			
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		include_once plugin_dir_path( __FILE__ ) . 'partials/user-tour-guide-admin-display.php';
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
			wp_enqueue_script( 'bootstrap-script', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array(), '5.3.2', false );

			wp_enqueue_script( 'tour-ks', plugin_dir_url(USER_TOUR_GUIDE_PLUGIN_FILE) . 'public/js/tourguide.min.js', array(), $this->version, false );

			wp_enqueue_script( 'admin', plugin_dir_url( __FILE__ ) . 'js/user-tour-guide-admin.js', array(), $this->version, false );

			wp_localize_script( 'admin', 'utg_admin_object', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'utg_admin_nonce' ),
			));
			
		}

	}

	/**
	 * This function is for adding step to the database
	 * @since 1.0.0
	 * @param $step_title
	 * @param $step_content
	 * @param $step_target
	 * @param $step_order
	 * @param $tour_name
	 * */

	public function utgk_add_steps_to_db(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		$step_title = sanitize_text_field($_POST['stepTitle']);
		$step_content = sanitize_text_field($_POST['stepContent']);
		$step_target = sanitize_text_field($_POST['stepTarget']);
		$step_order =sanitize_text_field($_POST['stepOrder']);
		$tour_name =sanitize_text_field($_POST['tourName']);
		$tour_name = strtolower(str_replace(' ', '-', $tour_name));

		$utg_query = new User_Tour_Guide_Query();
		$insert_data = $utg_query -> insert_steps_to_db($step_title, $step_content, $step_target, $step_order, $tour_name);

		echo esc_html($insert_data);

		die();
	}

	/**
	 * This function is for edit step to the database
	 * @since 1.0.0
	 * @param $db_id
	 * @param $step_content
	 * @param $step_target
	 * @param $step_order
	 * @param $step_title
	 * */


	public function utgk_edit_steps_to_db(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		$db_id = sanitize_text_field($_POST['id']);
		$step_title = sanitize_text_field($_POST['stepTitle']);
		$step_content = sanitize_text_field($_POST['stepContent']);
		$step_target = sanitize_text_field($_POST['stepTarget']);
		$step_order =sanitize_text_field($_POST['stepOrder']);

		$utg_query = new User_Tour_Guide_Query();
		$insert_data =  $utg_query -> edit_step_in_db($db_id, $step_title, $step_content, $step_target, $step_order);

		echo esc_html($insert_data) ;

		die();
		
	}

	/**
	 * This function is for delete step to the database
	 * @since 1.0.0
	 * @param $db_id
	 * 
	 * */

	public function utgk_remove_steps_from_db(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		$db_id = sanitize_text_field($_POST['id']);

		$utg_query = new User_Tour_Guide_Query();
		$deleted = $utg_query -> delete_step_from_db($db_id);
		
		echo esc_html($deleted . ' '.$db_id);

		die();
		
	}

	/**
	 * This function is for adding support menu to the plugin page
	 * @since 1.0.0
	 * @param array($links)
	 * 
	 * */

	public function utgk_add_settings_link_to_plugin_list(array $links){
		// Add a new settings link
		$url = get_admin_url() . 'admin.php?page=user_tour_guide';
		$settings_link = '<a href="' . esc_url( $url ) . '">' . __( 'Settings', 'user-tour-guide' ) . '</a>';
		$links[]    = $settings_link;
		$support 	= '<a href="https://kamalhossan.github.io/" target="_blank">' . __( 'support', 'user-tour-guide' ) . '</a>';
		$links[]    = $support;
		return $links;
	}

	/**
	 * This function is for handle tour meta for admin
	 * @since 1.0.0
	 * 
	 * */

	public function utgk_admin_tour_skip(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		$user_id = get_current_user_id();
		update_user_meta( $user_id, 'utg_admin_tour' , true);
		echo esc_js(true);
		die();
	}

	/**
	 * This function is for handle to add new step to db
	 * @since 1.0.0
	 * @param $group_slug/ tour_name
	 * */

	public function utgk_render_tour_guide_add_response_form($group_slug = 'user-tour-guide'){
		
		$group_name = ucwords(str_replace('-', ' ', $group_slug));
		$utg_query = new User_Tour_Guide_Query();
		$max_order = $utg_query -> get_max_count_for_group($group_slug);

		?>
		<div class="row">
			<div class="col-md-8">
				<div class="border border-1 rounded-2 shadow-sm p-3 mt-3 align-content-center items-center ">
					<form id="<?php echo esc_html($group_name);?>" class="add_step needs-validation" action="" method="POST">
						<div class="row">
							<div class="col">
								<div class="mb-3">
									<label for="tour_name" class="form-label">Tour Name</label>
									<input type="text" class="form-control" id="tour_name" placeholder="<?php echo esc_html($group_name);?>" value="<?php echo esc_html($group_name);?>" disabled>
								</div>
							</div>
							<div class="col">
								<div class="mb-3">
									<label for="step_title" class="form-label">Step Title</label>
								<input type="text" class="form-control" id="step_title" placeholder="Welcome aboard👋" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="mb-3">
									<label for="step_order" class="form-label">Order</label>
									<input type="number" class="form-control" id="step_order" placeholder="1" value="<?php echo esc_html($max_order + 1);?>" min="<?php echo esc_html($max_order + 1);?>" required>
								</div> 
								<div class="mb-3">
									<label for="step_target" class="form-label">Target Element</label>
									<input type="text" class="form-control" id="step_target" placeholder="HTMLElement | Element | Class | ID" required>
									<div class="valid-feedback">
									Looks good!
									</div>
								</div>
							</div>
							<div class="col">
								<div class="mb-3">
									<label for="step_content" class="form-label">Step Content</label>
									<textarea class="form-control" id="step_content" rows="4" placeholder="Add instruction for this step" required></textarea>
								</div>
							</div>
						</div>                
						<div class="col-auto">
							<button type="step_submit" class="btn btn-primary mb-3 submit">Add Step</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				<div class="border border-1 rounded-2 shadow-sm p-3 mt-3 tour-response">
					<div class="d-flex align-items-center justify-content-lg-between">
						<h4>Details</h4>
						<?php
							if($group_slug == 'user-tour-guide'){
								echo '<button id="utg_sample" class="btn btn-primary">Begin Sample Tour</button>';
							}
						?>
					</div>
					<div class="details">
						<h6>Create User Tour</h6>
						<p class="fs-6">Begin by creating a guided introductory tour for your project. Add steps to the tour with customizations such as titles, descriptions, attachments to specific DOM elements, and additional CSS classes to effectively guide your visitors through your project. Your visitors will value this interactive guidance.</p>
						
						<p class="fs-6">To display the tour on a specific page, insert the shortcode <code>[utgk-guide tour="<?php echo esc_html($group_slug);?>"]</code> into that page.</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * This function is for handle to display response from database
	 * @since 1.0.0
	 * @param $group_slug/ tour_name
	 * */

	public function utgk_render_tour_guide_response_table($group_slug = 'user-tour-guide'){

		$utg_query = new User_Tour_Guide_Query();
		$results = $utg_query->get_tour_data_by_group_slug($group_slug);

		?>
		<div class="row">
				<div class="col">
					<div class="border border-1 rounded-2 shadow-sm p-3 mt-3 your-steps">
					<?php
					if($results || count($results) > 0){?>
						<div class="d-flex align-items-center justify-content-lg-between">
							<h4>Your Response</h4>
						</div>
						<div class="your_tour mt-3">
							<table class="table">
							<thead>
								<tr>
									<th scope="col" class="order">Order</th>
									<th scope="col" class="title">Title</th>
									<th scope="col" class="content">Content</th>
									<th scope="col" class="target">Target</th>
									<th scope="col" class="edit">Edit</th>
								</tr>
							</thead>
							<tbody>

							<?php
								// arsort($results);
								$counter = 0;
								foreach($results as $result){ 
									$id = $result -> id;
									$order = $result -> order;
									$title = $result -> title;
									$content = $result -> content;
									$target = $result -> target;
									$counter++;
									?>
								<tr>
									<td><?php echo esc_html($order);?></td>
									<td><?php echo esc_html($title);?></td>
									<td><?php echo esc_html($content);?></td>
									<td><?php echo esc_html($target);?></td>
									<td class="edit_step">
										<div class="d-flex justify-content-center gap-3">
											<button data-bs-toggle="modal" data-bs-target="<?php echo esc_html('#edit-modal-' . $id);?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Step"><img src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'admin/img/edit.svg')?>" alt="Edit"></button>
											<?php
											if($group_slug == 'user-tour-guide' && $counter == 1){ ?>
												<button class="delete" data-bs-placement="top" title="Can't Delete" disabled><img src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'admin/img/remove.svg')?>" alt="Remove"></button>
											<?php
											} else{ ?>
												<button id="<?php echo esc_html($id);?>" data-bs-toggle="tooltip" class="delete" data-bs-placement="top" title="Remove Step"><img src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'admin/img/remove.svg')?>" alt="Remove"></button>
											<?php
											}
											?>
										</div>
									</td>
								</tr>
								<?php
								}
							?>
							</tbody>
						</table>
					</div>
				<?php } else {
					echo '<div class="d-flex align-items-center justify-content-lg-between">';
					echo '<h4>No steps found</h4>';
					echo '</div>';
				}
				?>
				</div>
			</div>
		</div>
		<?php
			foreach($results as $result){ 
				$id = $result -> id;
				$order = $result -> order;
				$title = $result -> title;
				$content = $result -> content;
				$target = $result -> target;
				?>
				<div class="modal fade" id="<?php echo esc_html('edit-modal-' . $id);?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
					<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalTitleId">
									<?php echo esc_html($title);?>
								</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
								></button>
							</div>
							
							<form id="<?php echo esc_html($id);?>" class="needs-validation edit_step" action="">
								<div class="modal-body">
									<div class="row">
										<div class="col">
											<div class="mb-3">
												<label for="<?php echo esc_html('tour_name_'. $id);?>" class="form-label">Tour Name</label>
												<input type="text" class="form-control" id="<?php echo esc_html('tour_name_'. $id);?>" placeholder="User Tour Guide" disabled>
											</div>
										</div>
										<div class="col">
											<div class="mb-3">
												<label for="<?php echo esc_html('step_title_'. $id);?>" class="form-label">Step Title</label>
											<input type="text" class="form-control" id="<?php echo esc_html('step_title_'. $id);?>" placeholder="Welcome aboard👋" value="<?php echo esc_html($title);?>" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="mb-3">
												<label for="<?php echo esc_html('step_order_'. $id);?>" class="form-label">Order</label>
												<input type="number" class="form-control" id="<?php echo esc_html('step_order_'. $id);?>" placeholder="1" value="<?php echo esc_html($order);?>" required>
											</div> 
											<div class="mb-3">
												<label for="<?php echo esc_html('step_target_'. $id);?>" class="form-label">Target Element</label>
												<input type="text" class="form-control" id="<?php echo esc_html('step_target_'. $id);?>" placeholder="HTMLElement | Element | Class | ID" value="<?php echo esc_html($target)?>" required>
												<div class="valid-feedback">
												Looks good!
												</div>
											</div>
										</div>
										<div class="col">
											<div class="mb-3">
												<label for="<?php echo esc_html('step_content_'. $id);?>" class="form-label">Step Content</label>
												<textarea class="form-control" id="<?php echo esc_html('step_content_'. $id);?>"  rows="4" placeholder="Add instruction for this step" required><?php echo esc_html($content);?></textarea>
											</div>
										</div>
									</div>                
								</div>
								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-secondary"
										data-bs-dismiss="modal"
									>
										Cancel
									</button>
									<button type="submit" class="btn btn-primary">Update Step</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php }
		?>
		<?php
	}

	public function utgk_registering_session_for_tabs(){
		if (!session_id()) {
			session_start();
		}
	}

	public function utgk_save_active_tab_with_session(){

		check_ajax_referer( 'utg_admin_nonce', 'nonce' );

		$tab_name = sanitize_text_field($_POST['activeTab']);
		$_SESSION['active-tab'] = strtolower(str_replace(' ', '-', $tab_name));
		echo esc_js(true);
		die();
		
	}
}
