<div class="wrap">
	<h1>Weather Settings</h1>
	<form method="post" action="options.php">
		<?php
		settings_fields( 'nirab_weather_settings' );
		do_settings_sections( 'nirab-weather-settings' );
		submit_button( 'Save Settings' );
		?>
	</form>
</div>
