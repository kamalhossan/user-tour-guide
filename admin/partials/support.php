<?php

if ( ! defined( 'ABSPATH' ) ) exit; 
$user_id = get_current_user_id();
$check_meta = get_user_meta( $user_id , 'utg_admin_tour', true );

if(!$check_meta){
    echo '<div class="utg-admin-tour open" role="alert">';
}

?>

<!-- Modal Body -->
<div class="modal fade" id="new-tour" tabindex="-1" aria-labelledby="tourStartLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom">
        <div class="modal-content position-relative">
            <img class="limit-alert" src="<?php echo esc_html(plugin_dir_url(__DIR__) . 'img/limit-alert.svg');?>" alt="Limit Alert Img">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title mt-3" id="tourStartLabel">
                    <?php echo esc_html('🌟 You\'ve Reached Your Limit! 🌟');?>
                </h5>
            </div>
            <div class="modal-body text-center">
                <p class="px-3 fs-5">
                    🔥 This verion included Only 2 tours - ready for more? Contact now! 🔥
                </p>
            </div>
            <div class="modal-footer">
                <button id="admin-skip" type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Not Now</button>
                <a href="https://kamalhossan.github.io/#contact" target="_blank" class="btn btn-primary">Get Support</a>
            </div>
        </div>
    </div>
</div>