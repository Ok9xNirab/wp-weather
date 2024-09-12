<?php

use WPDrill\Facades\Menu;
use WPDrill\Plugin;

return function ( Plugin $plugin ) {
	Menu::add(
		__( 'Weather Settings', 'nirab-wi' ),
		array( \Nirab\WI\Handlers\WeatherSettingsHandler::class, 'render' ),
		'manage_options'
	)->parentSlug( 'options-general.php' )
	->slug( 'nirab-weather-settings' );
};
