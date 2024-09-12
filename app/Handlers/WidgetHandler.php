<?php

namespace Nirab\WI\Handlers;

use Nirab\WI\Widgets\WeatherWidget;

/**
 * Handle plugin's widget.
 */
class WidgetHandler {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	/**
	 * Register widget.
	 *
	 * @return void
	 */
	public function register_widgets() {
		register_widget( WeatherWidget::class );
	}
}
