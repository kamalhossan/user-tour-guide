<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://kamalhossan.github.io/
 * @since      1.0.0
 *
 * @package    User_Tour_Guide
 * @subpackage User_Tour_Guide/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) exit; 
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

$utg_query = new User_Tour_Guide_Query();
$results = $utg_query->get_tour_data_by_group_slug('user-tour-guide');

$orders = [];

foreach($results as $result){
    $orders[] = $result -> order;
}

if(empty($orders)){
    $max_order = 0;
} else {
    $max_order = max($orders);
}
$page_name = '';
?>

<div class="row">
    <div class="col-md-8">
        <div class="border border-1 rounded-2 shadow-sm p-3 mt-3 align-content-center items-center ">
            <form id="<?php echo 'user-tour-guide';?>" class="add_step needs-validation" action="" method="POST">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="tour_name" class="form-label">Tour Name</label>
                            <input type="text" class="form-control" id="tour_name" placeholder="User Tour Guide" value="<?php echo 'User Tour Guide';?>" disabled>
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
                    <button type="submit" class="btn btn-primary mb-3 submit">Add Step</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="border border-1 rounded-2 shadow-sm p-3 mt-3 tour-response">
            <button id="utg_sample" class="btn btn-primary">Begin Sample Tour</button>
            <div class="details">
                <h6>Create User Tour</h6>
                <p class="fs-6">Begin by creating a guided introductory tour for your project. Add steps to the tour with customizations such as titles, descriptions, attachments to specific DOM elements, and additional CSS classes to effectively guide your visitors through your project. Your visitors will value this interactive guidance.</p>
                
                <p class="fs-6">To display the tour on a specific page, insert the shortcode <code>[utgk-guide]</code> into that page.</p>
            </div>
        </div>
    </div>
</div>

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
                    foreach($results as $result){ 
                        $id = $result -> id;
                        $order = $result -> order;
                        $title = $result -> title;
                        $content = $result -> content;
                        $target = $result -> target;
                        ?>
                    <tr>
                        <td><?php echo esc_html($order);?></td>
                        <td><?php echo esc_html($title);?></td>
                        <td><?php echo esc_html($content);?></td>
                        <td><?php echo esc_html($target);?></td>
                        <td class="edit_step">
                            <div class="d-flex justify-content-center gap-3">
                                <button data-bs-toggle="modal" data-bs-target="<?php echo esc_html('#edit-modal-' . $id);?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Step"><img src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'img/edit.svg')?>" alt="Edit"></button>
                                <button id="<?php echo esc_html($id); ?>" data-bs-toggle="tooltip" class="delete" data-bs-placement="top" title="Remove Step"><img src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'img/remove.svg') ?>" alt="Remove"></button>
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