<?php

namespace Nirab\WI\Handlers;

use Nirab\WI\Widgets\WeatherWidget;

class WidgetHandler {
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	public function register_widgets() {
		register_widget( WeatherWidget::class );
	}
}
