<?php

/**
 * Handles database queries for the User Tour Guide plugin.
 *
 * @link       https://kamalhossan.github.io/
 * @since      1.0.0
 *
 * @package    User_Tour_Guide
 * @subpackage User_Tour_Guide/admin
 */
class User_Tour_Guide_Query {

    /**
     * The name of the database table for this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $table_name    The name of the database table.
     */
    private $table_name;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'utg_user_tour_guide';
    }

    /**
     * Retrieves distinct tour groups from the database.
     *
     * @since    1.0.0
     * @return   array     Array of distinct tour groups.
     */
    public function get_groups() {
        $cache_key = 'utg_tour_groups';
        $groups = wp_cache_get($cache_key);
        if (false === $groups) {
            global $wpdb;
            $query = $wpdb->prepare(
                "SELECT DISTINCT `group` FROM {$this->table_name}"
            );
            $groups = $wpdb->get_results($query, ARRAY_A);
            wp_cache_set($cache_key, $groups);
        }
        return $groups;
    }
    

    /**
     * Retrieves tour data by tour group slug.
     *
     * @since    1.0.0
     * @param    string    $group_slug    Tour group slug.
     * @return   array     Tour data for the specified group.
     */
    public function get_tour_data_by_group_slug($group_slug = 'user-tour-guide') {
        global $wpdb;
        $tour_data = $wpdb->get_results(
            $wpdb->prepare("SELECT * FROM {$this->table_name} WHERE `group` = %s ORDER BY `order`", $group_slug)
        );
        return $tour_data;
    }

    /**
     * Retrieves the maximum count for a tour group.
     *
     * @since    1.0.0
     * @param    string    $group_slug    Tour group slug.
     * @return   int       Maximum count for the specified group.
     */
    public function get_max_count_for_group($group_slug = 'user-tour-guide') {
        $cache_key = 'count' . $group_slug;
        $max_count = wp_cache_get($cache_key);

        global $wpdb;
        $count = $wpdb->get_var(
            $wpdb->prepare("SELECT COUNT(*) FROM {$this->table_name} WHERE `group` = %s", $group_slug)
        );

        if($max_count !== $count ){
            wp_cache_delete($cache_key);
            $max_count = $count;
            wp_cache_set($cache_key, $max_count, '', 3600);
        }

        return $max_count;
    }

    /**
     * Inserts tour steps into the database.
     *
     * @since    1.0.0
     * @param    string    $step_title    Title of the step.
     * @param    string    $step_content  Content of the step.
     * @param    string    $step_target   Target of the step.
     * @param    int       $step_order    Order of the step.
     * @param    string    $tour_name     Name of the tour.
     * @return   string    Success message.
     */
    public function insert_steps_to_db($step_title, $step_content, $step_target, $step_order, $tour_name) {
        global $wpdb;
        if ($wpdb->get_var("SHOW TABLES LIKE '{$this->table_name}'") != $this->table_name) {
            $this->create_table();
        }
        $this->add_step($step_title, $step_content, $step_target, $step_order, $tour_name);
        return 'success';
    }

    /**
     * Adds a step to the database.
     *
     * @since    1.0.0
     * @param    string    $step_title    Title of the step.
     * @param    string    $step_content  Content of the step.
     * @param    string    $step_target   Target of the step.
     * @param    int       $step_order    Order of the step.
     * @param    string    $tour_name     Name of the tour.
     */
    private function add_step($step_title, $step_content, $step_target, $step_order, $tour_name) {
        global $wpdb;
        $wpdb->insert(
            $this->table_name,
            array(
                'title'   => $step_title,
                'content' => $step_content,
                'target'  => $step_target,
                'order'   => $step_order,
                'group'   => $tour_name
            )
        );
    }

    /**
     * Creates the database table if it doesn't exist.
     *
     * @since    1.0.0
     */
    private function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE {$this->table_name} (
            id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(100) NULL,
            `content` VARCHAR(500) NULL,
            `target` VARCHAR(100) NULL,
            `order` VARCHAR(50) NULL,
            `group` VARCHAR(50) NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Updates a step in the database.
     *
     * @since    1.0.0
     * @param    int       $db_id         ID of the step in the database.
     * @param    string    $step_title    Title of the step.
     * @param    string    $step_content  Content of the step.
     * @param    string    $step_target   Target of the step.
     * @param    int       $step_order    Order of the step.
     * @return   string    Success message.
     */
    public function edit_step_in_db($db_id, $step_title, $step_content, $step_target, $step_order) {
        global $wpdb;
        $wpdb->update(
            $this->table_name,
            array(
                'title'   => $step_title,
                'content' => $step_content,
                'target'  => $step_target,
                'order'   => $step_order
            ),
            array('id' => $db_id)
        );
        // Invalidate cache for the updated row
        wp_cache_delete($db_id, 'step_data');
        return 'updated';
    }

    /**
     * Deletes a step from the database.
     *
     * @since    1.0.0
     * @param    int       $db_id    ID of the step in the database.
     * @return   string    Success message.
     */
    public function delete_step_from_db($db_id) {
        global $wpdb;
        $wpdb->delete($this->table_name, array('id' => $db_id));
    
        wp_cache_delete($db_id, 'step_data');
    
        return 'deleted';
    }
    
}
?>
