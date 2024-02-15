<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="modal fade" id="new-tour" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitleId">
					<?php echo 'Create a new tour';?>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
				></button>
			</div>
			
			<form id="<?php echo 'add_new_tour';?>" class="needs-validation edit_step" action="">
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<div class="mb-3">
								<label for="<?php echo esc_html('new_tour_name');?>" class="form-label">Tour Name</label>
								<input type="text" class="form-control" id="<?php echo esc_html('new_tour_name');?>" placeholder="Product Tour Guide">
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<label for="<?php echo esc_html('new_step_title'. $id);?>" class="form-label">Step Title</label>
							<input type="text" class="form-control" id="<?php echo esc_html('new_step_title');?>" placeholder="Welcome aboard👋" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="mb-3">
								<label for="<?php echo esc_html('new_step_order');?>" class="form-label">Order</label>
								<input type="number" class="form-control" id="<?php echo esc_html('new_step_order');?>" placeholder="1" value="<?php echo '1';?>" required>
							</div> 
							<div class="mb-3">
								<label for="<?php echo esc_html('new_step_target')?>" class="form-label">Target Element</label>
								<input type="text" class="form-control" id="<?php echo esc_html('new_step_target');?>" placeholder="HTMLElement | Element | Class | ID" required>
								<div class="valid-feedback">
								Looks good!
								</div>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<label for="<?php echo esc_html('new_step_content');?>" class="form-label">Step Content</label>
								<textarea class="form-control" id="<?php echo esc_html('new_step_content');?>"  rows="4" placeholder="Add instruction for this step" required></textarea>
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
					<button type="submit" class="btn btn-primary"> + Create New Tour</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
