<?php

namespace Nirab\WI\Handlers;

use Nirab\WI\Facades\WeatherAPI;
use WPDrill\Facades\View;

/**
 * Handle blocks.
 */
class BlockHandler {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Register blocks.
	 *
	 * @return void
	 */
	public function register_blocks() {
		register_block_type(
			NIRAB_DIR_PATH . 'build/blocks/weather-widget',
			array(
				'render_callback' => array( $this, 'render_widget' ),
			)
		);
	}

	/**
	 * Render the weather widget content.
	 *
	 * @return string
	 */
	public function render_widget() {
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
			'widgets/weather',
			array(
				'forecasts' => $forecasts,
				'current'   => $current,
				'address'   => $address,
			)
		);
	}
}
