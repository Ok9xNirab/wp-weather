<?php

namespace Nirab\WI\Widgets;

use Nirab\WI\Facades\WeatherAPI;
use WPDrill\Facades\View;

/**
 * Classic Weather Widget.
 */
class WeatherWidget extends \WP_Widget {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		$widget_options = array(
			'classname'   => 'nirab_widget_weather_widget',
			'description' => __( 'A widget to display weather data', 'nirab-wi' ),
		);
		parent::__construct( 'nirab_wi_weather_widget', __( 'Weather Classic Widget', 'nirab-wi' ), $widget_options );
	}

	public function widget( $args, $instance ) {
		$location = get_option( 'nirab_wi_location' );
		if ( ! $location ) {
			View::output(
				'error-notice',
				array(
					'notice' => __( 'No Location set!', 'nirab-wi' ),
				)
			);

			return;
		}

		$data = WeatherAPI::forecast( $location );
		if ( ! $data->success ) {
			View::output(
				'error-notice',
				array(
					'notice' => $data->message,
				)
			);

			return;
		}

		array_shift( $data->data->days );
		$forecasts = $data->data->days;
		$current   = $data->data->currentConditions;
		$address   = $data->data->resolvedAddress;

		View::output(
			'widgets/weather',
			array(
				'forecasts' => $forecasts,
				'current'   => $current,
				'address'   => $address,
			)
		);
	}
}
