<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
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
            <img class="limit-alert" src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'img/limit-alert.svg');?>" alt="Limit Alert Img">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title mt-3" id="tourStartLabel">
                    <?php echo esc_html('Welcome to User Tour Guide. Enjoy the tour!');?>
                </h5>
            </div>
            <div class="modal-body text-center">
                <p class="px-3 fs-5">
                    You're here for the first time, which is why you're getting this tour. If you want to see how this plugin will look for your visitors, click 'Start'. Alternatively, you can skip this tour if you want.
                </p>
            </div>
            <div class="modal-footer">
                <button id="admin-skip" type="button" class="btn btn-secondary <?php echo esc_html($page_name);?>" data-bs-dismiss="modal" aria-label="Close">Skip Tour</button>
                <button id="start-tour" type="button" class="btn btn-primary <?php echo esc_html($page_name);?>" data-bs-dismiss="modal" aria-label="Close">Start</button>
            </div>
        </div>
    </div>
</div>