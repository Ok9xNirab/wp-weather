<?php

namespace Nirab\WI\Widgets;

use Nirab\WI\Facades\WeatherAPI;
use WPDrill\Facades\View;

class WeatherWidget extends \WP_Widget {
	public function __construct() {
		$widget_options = array(
			'classname'   => 'nirab_widget_weather_widget',
			'description' => __( 'A widget to display weather data', 'nirab-wi' ),
		);
		parent::__construct( 'nirab_wi_weather_widget', __( 'Weather', 'nirab-wi' ), $widget_options );
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

		?>
		<div class="nirab_widget_weather_widget">
			<div class="nirab_widget_weather_heading">
				<h4><?php esc_html_e( 'Current Weather', 'nirab-wi' ); ?></h4>
				<small><?php echo esc_html( $address ); ?></small>
				<h3><?php echo esc_html( $current->temp ); ?>&deg;C</h3>
				<p><?php echo esc_html( $current->conditions ); ?></p>
			</div>

			<div class="nirab_widget_forecast">
				<p>
					<small>7-Day Forecast</small>
				</p>
				<div class="nirab_widget_forecast_card">
					<?php foreach ( $forecasts as $forecast ) : ?>
						<div>
							<b><?php echo esc_html( gmdate( 'D', $forecast->datetimeEpoch ) ); ?></b>
							<p><?php echo esc_html( $forecast->tempmin . '&deg;C / ' . $forecast->tempmax . '&deg;C' ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
