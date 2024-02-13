<?php
$page_name = '';
?>
<button id="utg_sample" class="">Show Sample Tour</button>

<!-- Modal Body -->
<div class="modal fade" id="tourStart" tabindex="-1" aria-labelledby="tourStartLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom">
        <div class="modal-content">
            <div class="modal-header">
                <img class="limit-alert" src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/limit-alert.svg';?>" alt="Limit Alert Img">
                <h5 class="modal-title" id="tourStartLabel">
                    <?php
                    if(is_page('dashboard')){
                        echo 'Welcome to My School Box. Enjoy the tour!';
						 $page_name =  'dashboard';
                    } elseif(is_page('resources')){
                        echo 'Welcome to the GGSA Product Range. Let us show you how you can find the most useful resources for your teaching!';
						$page_name =  'resources';
                    } elseif(is_page('my-library')){
                        echo 'Welcome to My Library. Let’s explore how you can access your selected resources.';
						$page_name =  'myLibrary';
                    }                 
                    ?>
                </h5>
            </div>
            <div class="modal-body">
                <!-- <h4 class="px-3 fw-bold"></h4> -->
            </div>
            <div class="modal-footer">
                <button id="skip-tour" type="button" class="btn btn-secondary <?php echo $page_name;?>" data-bs-dismiss="modal" aria-label="Close">Skip tour</button>
                <button id="start-tour" type="button" class="btn btn-primary <?php echo $page_name;?>" data-bs-dismiss="modal" aria-label="Close">Next</button>
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