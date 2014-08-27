<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
?>
<div class="wrap">
	<h2>
		<?php _e( 'Pimap Options', 'pimap' ); ?>
	</h2>

	<?php if( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ){ ?>
		<div id="setting-error-settings_updated" class="updated settings-error"> 
		<p><strong><?php _e( 'Saved settings', 'pimap' ); ?></strong></p></div>
	<?php } ?>

	<form method='post' action='options.php'>
		<?php
			settings_fields( 'pimap_settings' );
			do_settings_sections( 'pimap_options' );
			submit_button();
		?>
	</form>

</div>