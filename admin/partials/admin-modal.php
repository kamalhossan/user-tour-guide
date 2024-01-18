<?php

global $wpdb;
$table_name = $wpdb->prefix . 'user_tour_guide';
$results = $wpdb->get_results("SELECT * FROM $table_name where `group` LIKE 'User-Tour-Guide'");

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
                            <textarea class="form-control" id="step_content" rows="4" required></textarea>
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
            <div class="d-flex align-items-center justify-content-lg-between">
                <h4>Your Response</h4>
            </div>
            <div class="your_tour mt-3">
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Target</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                
                    foreach($results as $result){ ?>
                    <tr>
                        <td><?php echo $result -> order;?></td>
                        <td contenteditable ="true"><?php echo $result -> title;?></td>
                        <td><?php echo $result -> content;?></td>
                        <td><?php echo $result -> target;?></td>
                        <td class="edit_step">
                            <div class="d-flex justify-content-center gap-3">
                                <button data-bs-toggle="modal" data-bs-target="<?php echo '#staff-modal-'?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Step" id="<?php echo 'edit-';?>"><img src="<?php echo plugin_dir_url(__DIR__) . 'img/edit.svg'?>" alt="Edit"></button>
                                <button data-bs-toggle="modal" data-bs-target="<?php echo '#remove-staff-' ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove Step"><img src="<?php echo plugin_dir_url(__DIR__) . 'img/remove.svg' ?>" alt="Remove"></button>

                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

echo plugin_dir_path( __FILE__ ) . '../';
?>

<!-- Modal Body -->

<?php

// global $wpdb;

// $table_name = $wpdb->prefix . 'user_tour_guide';
// $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

// var_dump($results);

wp_enqueue_style( 'intro-style', 'https://unpkg.com/@sjmc11/tourguidejs/dist/css/tour.min.css', false );
wp_enqueue_script( 'intro-js', 'https://unpkg.com/@sjmc11/tourguidejs/dist/tour.js',[] ,'' ,false);

wp_localize_script( 'tour-js', 'tour_object',
    array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'page_name' => $page_name
    )
);