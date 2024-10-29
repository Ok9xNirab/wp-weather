<?php

namespace Nirab\WI\Handlers;

use Nirab\WI\Facades\WeatherAPI;
use WPDrill\Facades\View;

/**
 * Handle cron tasks.
 */
class CronHandler {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		add_action( 'nirab_wi_rain_alert', array( $this, 'send_alert_mail' ) );
	}

	/**
	 * Send rain alert email.
	 *
	 * @return void
	 */
	public function send_alert_mail() {
		$enable_alert = get_option( 'nirab_wi_enable_alert' );
		if ( ! $enable_alert ) {
			return;
		}

		$location = get_option( 'nirab_wi_location' );
		if ( ! $location ) {
			return;
		}
		$weather_data = WeatherAPI::nextDayForecast( $location );

		if ( ! $weather_data->success ) {
			return;
		}

		$next_day    = $weather_data->data->days[0];
		$condition   = $next_day->conditions;
		$description = $next_day->description;
		$precip_prob = $next_day->precipprob;

		if ( $precip_prob > 90 ) {
			$admin_mail = get_option( 'admin_email' );
			$to_mail    = get_option( 'nirab_wi_email', $admin_mail );

			if ( ! $to_mail ) {
				$to_mail = $admin_mail;
			}
			$headers = array( 'Content-Type: text/html; charset=UTF-8' );

			$html_message = View::renderRaw(
				'emails/rain-alert',
				array(
					'condition'   => $condition,
					'description' => $description,
					'precip_prob' => $precip_prob,
				)
			);

			wp_mail( $to_mail, __( 'Rain Alert: It might rain tomorrow.', 'nirab-wi' ), $html_message, $headers );
		}
	}
}
