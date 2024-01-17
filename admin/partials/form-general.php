<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<form class="stg-form" method="post" action="options.php">
	<?php settings_fields( 'simple_tour_guide_additional_fields' ); ?>
	<?php $options = get_option( 'stg_settings' ); ?>
	<h3><?php esc_html_e( 'Tour Options', 'simple-tour-guide' ); ?></h3>
	<p><?php esc_html_e( 'The below settings apply for the whole tour. You can choose to display the tour until the user has completed or dismissed it or to display it on every page reload (ideal for testing purposes). You can also confirm tour cancellation when the user clicks the close button and display the tour only on specific pages.', 'simple-tour-guide' ); ?></p>
	<input name="stg_settings[show_intro]" type="checkbox" value="true" <?php checked( 'true', isset( $options['show_intro'] ) ? 'true' : '', true ); ?> />
	<label for="stg_settings[show_intro]"><?php esc_html_e('Show the tour only once. Hide it after the user finishes or dismisses it.', 'simple-tour-guide' ); ?></label>
	<br>
	<input name="stg_settings[show_confirmation]" type="hidden" value=""<?php checked( 'true', $options['show_confirmation'],  true ); ?> />
	<input name="stg_settings[show_confirmation]" type="checkbox" value="true" <?php checked( 'true', $options['show_confirmation'],  true ); ?> />
	<label for="stg_settings[show_confirmation]"><?php esc_html_e('Ask for confirmation when the user clicks the close button.', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[show_wp_editor]" type="checkbox" value="true" <?php checked( 'true', isset ($options['show_wp_editor']) ? $options['show_wp_editor'] : '',  true ); ?> />
	<label for="stg_settings[show_wp_editor]"><?php esc_html_e('Enable TinyMCE HTML editor for more customizability.', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[show_user_logged_in]" type="hidden" value=""<?php checked( 'true', isset ($options['show_user_logged_in']) ? $options['show_user_logged_in'] : '' ,  true ); ?> />
	<input name="stg_settings[show_user_logged_in]" type="checkbox" value="true" <?php checked( 'true', isset ($options['show_user_logged_in']) ? $options['show_user_logged_in'] : '',  true ); ?> />
	<label for="stg_settings[show_user_logged_in]"><?php esc_html_e('Show the tour to logged in users only', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[show_modal]" type="checkbox" value="true" <?php checked( 'true', isset ($options['show_modal']) ? $options['show_modal'] : '',  true ); ?> />
	<label for="stg_settings[show_modal]"><?php esc_html_e('Show modal background overlay when the tour is active.', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[hide_mobile]" type="checkbox" value="true" <?php checked( 'true', isset ($options['hide_mobile']) ? $options['hide_mobile'] : '',  true ); ?> />
	<label for="stg_settings[hide_mobile]"><?php esc_html_e('Hide tour on mobile.', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[skip_step]" type="checkbox" value="true" <?php checked( 'true', isset ($options['skip_step']) ? $options['skip_step'] : '',  true ); ?> />
	<label for="stg_settings[skip_step]"><?php esc_html_e('Skip a step if the step is attached to an element that is not visible. Avoids screen locking for some resolutions.', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[show_progress]" type="checkbox" value="true" <?php checked( 'true', isset( $options['show_progress'] ) ? 'true' : '', true ); ?> />
	<label for="stg_settings[show_progress]"><?php esc_html_e('Show tour progress bar', 'simple-tour-guide')?></label>
	<br>
	<input name="stg_settings[show_on_all_pages]" type="checkbox" value="true" <?php checked( 'true', isset( $options['show_on_all_pages'] ) ? 'true' : '', true ); ?> />
	<label for="stg_settings[show_on_all_pages]"><?php esc_html_e('Show the tour on all pages.', 'simple-tour-guide')?></label>
	<p><?php esc_html_e('You can also use the shortcode ', 'simple-tour-guide')?><code>[stg_kef]</code><?php esc_html_e(' to display the tour only on a specific post or page. Uncheck the above option and copy paste the shortcode on top of the post or page you want it to appear.', 'simple-tour-guide')?></p>
	<?php submit_button(); ?>
</form>