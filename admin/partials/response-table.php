<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wpdb;
$table_name = $wpdb->prefix . 'utg_user_tour_guide';
$results = $wpdb->get_results("SELECT * FROM $table_name where `group` LIKE 'User-Tour-Guide' ORDER BY `order`");


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