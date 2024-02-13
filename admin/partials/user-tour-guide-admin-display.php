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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

global $wpdb;
$table_name = $wpdb->prefix . 'utg_user_tour_guide';
$results = $wpdb->get_results("SELECT * FROM $table_name where `group` LIKE 'User-Tour-Guide' ORDER BY `order`");

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
            <form id="add_step" class="needs-validation" action="" method="POST">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="tour_name" class="form-label">Tour Name</label>
                            <input type="text" class="form-control" id="tour_name" placeholder="User Tour Guide" disabled>
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
                            <input type="number" class="form-control" id="step_order" placeholder="1" value="<?php echo $max_order + 1;?>" min="<?php echo $max_order + 1;?>" required>
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
                <div class="sample">
                    <button id="utg_sample" class="btn btn-primary">Begin Sample Tour</button>
                </div>
            </div>
            <div class="details">
                <h6>Create User Tour</h6>
                <p>Create a guided intro tour by adding steps to it here. Customize each step (you can add title, description, attach it to any dom element and add additional css class) to guide your visitors throughout your project. They will appreciate it.</p>

                Place use this shortcode <code>[utg-user-tour-guide]</code> on that page where you want to show the tour.
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
                            <td><?php echo $order;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $content;?></td>
                            <td><?php echo $target;?></td>
                            <td class="edit_step">
                                <div class="d-flex justify-content-center gap-3">
                                    <button data-bs-toggle="modal" data-bs-target="<?php echo '#edit-modal-' . $id;?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Step" id="<?php echo 'edit-';?>"><img src="<?php echo plugin_dir_url(__DIR__) . 'img/edit.svg'?>" alt="Edit"></button>
                                    <button id="<?= $id; ?>" data-bs-toggle="tooltip" class="delete" data-bs-placement="top" title="Remove Step"><img src="<?php echo plugin_dir_url(__DIR__) . 'img/remove.svg' ?>" alt="Remove"></button>
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


<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<?php

foreach($results as $result){ 
    $id = $result -> id;
    $order = $result -> order;
    $title = $result -> title;
    $content = $result -> content;
    $target = $result -> target;
    ?>
    <div
    class="modal fade" id="<?php echo 'edit-modal-' . $id;?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        <?= $title;?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    ></button>
                </div>
                
                <form id="<?=$id;?>" class="needs-validation edit_step" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="<?= 'tour_name_'. $id;?>" class="form-label">Tour Name</label>
                                    <input type="text" class="form-control" id="<?= 'tour_name_'. $id;?>" placeholder="User Tour Guide" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="<?= 'step_title_'. $id;?>" class="form-label">Step Title</label>
                                <input type="text" class="form-control" id="<?= 'step_title_'. $id;?>" placeholder="Welcome aboard👋" value="<?= $title;?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="<?= 'step_order_'. $id;?>" class="form-label">Order</label>
                                    <input type="number" class="form-control" id="<?= 'step_order_'. $id;?>" placeholder="1" value="<?= $order;?>" required>
                                </div> 
                                <div class="mb-3">
                                    <label for="<?= 'step_target_'. $id;?>" class="form-label">Target Element</label>
                                    <input type="text" class="form-control" id="<?= 'step_target_'. $id;?>" placeholder="HTMLElement | Element | Class | ID" value="<?= $target?>" required>
                                    <div class="valid-feedback">
                                    Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="<?= 'step_content_'. $id;?>" class="form-label">Step Content</label>
                                    <textarea class="form-control" id="<?= 'step_content_'. $id;?>"  rows="4" placeholder="Add instruction for this step" required><?= $content;?></textarea>
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
$user_id = get_current_user_id();
$check_meta = get_user_meta( $user_id , 'utg_admin_tour', true );

if(!$check_meta){
    echo '<div class="utg-admin-tour open" role="alert">';
}
?>

<!-- Modal Body -->
<div class="modal fade" id="tourStart" tabindex="-1" aria-labelledby="tourStartLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom">
        <div class="modal-content position-relative">
            <img class="limit-alert" src="<?php echo plugin_dir_url(__DIR__) . 'img/limit-alert.svg';?>" alt="Limit Alert Img">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title mt-3" id="tourStartLabel">
                    <?php echo 'Welcome to User Tour Guide. Enjoy the tour!';?>
                </h5>
            </div>
            <div class="modal-body text-center">
                <p class="px-3 fs-5">
                    You're here for the first time, which is why you're getting this tour. If you want to see how this plugin will look for your visitors, click 'Start'. Alternatively, you can skip this tour if you want.
                </p>
            </div>
            <div class="modal-footer">
                <button id="admin-skip" type="button" class="btn btn-secondary <?php echo $page_name;?>" data-bs-dismiss="modal" aria-label="Close">Skip Tour</button>
                <button id="start-tour" type="button" class="btn btn-primary <?php echo $page_name;?>" data-bs-dismiss="modal" aria-label="Close">Start</button>
            </div>
        </div>
    </div>
</div>


<?php

wp_enqueue_style( 'intro-style', 'https://unpkg.com/@sjmc11/tourguidejs/dist/css/tour.min.css', false );
wp_enqueue_script( 'intro-js', 'https://unpkg.com/@sjmc11/tourguidejs/dist/tour.js',[] ,'' ,false);

wp_localize_script( 'tour-js', 'tour_object',
    array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'page_name' => $page_name
    )
);
