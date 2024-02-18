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

    $utg_query = new User_Tour_Guide_Query();
	$groups =  $utg_query->get_groups();
	
	?>
	<div class="wrap">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php esc_html_e( 'User Tour Guide Options', 'user-tour-guide' ); ?></h2>	
			<div class="action">
				<?php
				if($groups && count($groups) > 0){
					?>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-tour" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Step" id="<?php echo 'edit-';?>">+ Create a new Tour</button>
					<a href ="https://www.buymeacoffee.com/kamalhossan" target="_blank" class="btn btn-secondary text-black " data-bs-toggle="tooltip" data-bs-placement="top" title="☕ Buy me a Coffe">☕ Buy Me a Coffe</a>
					<?php
				}
				?>
			</div>
		</div>
	
		<?php

		?>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="myTab" role="tablist">
	
		<?php

			if(!isset($_SESSION['active-tab'])){
				$_SESSION['active-tab'] = 'user-tour-guide';
				$active_tab = $_SESSION['active-tab'];
			} else {
				$active_tab = $_SESSION['active-tab'];
			}
	
			foreach ($groups as $group){
				$group_slug = $group['group'];
				$group_name = ucwords(str_replace('-', ' ', $group_slug));
				?>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo ($active_tab == $group_slug) ? 'active': '';?>" id="<?php echo esc_html($group_slug) . '-tab'?>" data-bs-toggle="tab" data-bs-target="<?php echo '#'. esc_html($group_slug);?>"
					type="button" role="tab" aria-controls="home" aria-selected="true"><?php echo esc_html($group_name);?></button>
				</li>
				<?php
			}
		?>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		<?php

			foreach ($groups as $group){
				$group_slug = $group['group'];
				$group_name = str_replace('-', ' ', $group_slug);
				?>
				<div class="tab-pane <?php echo ($active_tab == $group_slug) ? 'active': '';?>" id="<?php echo esc_html($group_slug)?>" role="tabpanel" aria-labelledby="<?php echo esc_html($group_slug) . '-tab'?>">
					<?php $this -> render_tour_guide_add_response_form($group_slug); ?>
					<?php $this -> render_tour_guide_response_table($group_slug); ?>
				</div>
			<?php }
		?>
		</div>
		<?php

		if(empty($groups)){
			// include blank from
			include_once plugin_dir_path( __FILE__ ) . 'initial-tour.php';
		}elseif (count($groups) !== 2){
            include_once plugin_dir_path( __FILE__ ) . 'new-tour.php';
        }else {
            include_once plugin_dir_path( __FILE__ ) . 'support.php';
        }

		include_once plugin_dir_path( __FILE__ ) . 'admin-modal.php';
		
		?>
		
	</div> 
	
	<?php