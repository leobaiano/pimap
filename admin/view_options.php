<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
?>
<div class="wrap">
	<h2>
		<?php _e( 'Pimap Options', 'pimap' ); ?>
	</h2>
	<form method='post' action='options.php'>
		<?php
			settings_fields( 'pimap_settings' );
			do_settings_sections( 'pimap_options' );
			submit_button();
		?>
	</form>

</div>