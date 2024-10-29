<?php

namespace Nirab\WI\Shortcodes;

use Nirab\WI\Facades\WeatherAPI;
use WPDrill\Contracts\ShortcodeContract;
use WPDrill\Facades\View;

class NirabWiShortCode implements ShortcodeContract {

	public function render( array $attrs, string $content = null ): string {
		$location = get_option( 'nirab_wi_location' );
		if ( ! $location ) {
			return View::render(
				'error-notice',
				array(
					'notice' => __( 'No Location set!', 'nirab-wi' ),
				)
			);
		}

		$data = WeatherAPI::forecast( $location );

		if ( ! $data->success ) {
			return View::render(
				'error-notice',
				array(
					'notice' => $data->message,
				)
			);
		}

		array_shift( $data->data->days );
		$forecasts = $data->data->days;
		$current   = $data->data->currentConditions;
		$address   = $data->data->resolvedAddress;

		return View::render(
			'shortcode/nirab-wi',
			array(
				'address'   => $address,
				'current'   => $current,
				'forecasts' => $forecasts,
			)
		);
	}
}
