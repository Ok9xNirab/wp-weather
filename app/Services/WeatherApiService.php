<?php

namespace Nirab\WI\Services;

use Apiz\AbstractApi;
use GuzzleHttp\Exception\ConnectException;
use stdClass;
use WPDrill\Facades\Config;

/**
 * Weather API service.
 */
class WeatherApiService extends AbstractApi {

	/**
	 * Location query.
	 *
	 * @var string
	 */
	private string $q;
	/**
	 * Path of API.
	 *
	 * @var string
	 */
	private string $path;

	/**
	 * Get base URL of API.
	 *
	 * @return string
	 */
	protected function getBaseURL() {
		return Config::get( 'weather.base_url' );
	}

	/**
	 * API Prefix.
	 *
	 * @return string
	 */
	public function getPrefix(): string {
		return 'VisualCrossingWebServices/rest/services/timeline';
	}

	/**
	 * Default queries set to every requests.
	 *
	 * @return array
	 */
	protected function getDefaultQueries(): array {
		return array(
			'key'         => Config::get( 'weather.api_key' ),
			'unitGroup'   => 'uk',
			'include'     => 'days,current',
			'contentType' => 'json',
		);
	}

	/**
	 * Get current weather.
	 *
	 * @param string $q Location query.
	 *
	 * @return stdClass
	 */
	public function current( string $q ): stdClass {
		$this->q    = $q;
		$this->path = 'today';

		return $this->getData();
	}

	/**
	 * Get forecast data.
	 *
	 * @param string $q Location query.
	 *
	 * @return stdClass
	 */
	public function forecast( string $q ): stdClass {
		$this->q    = $q;
		$this->path = 'next7days';

		return $this->getData();
	}

	/**
	 * Get forecast data.
	 *
	 * @param string $q Location query.
	 *
	 * @return stdClass
	 */
	public function nextDayForecast( string $q ): stdClass {
		$this->q    = $q;
		$this->path = 'tomorrow';

		return $this->getData();
	}

	/**
	 * Handle request.
	 *
	 * @return stdClass
	 */
	private function getData(): stdClass {
		$transient_key = "nirab_wi_{$this->path}_{$this->q}";
		$transient     = get_transient( $transient_key );

		if ( $transient ) {
			return $transient;
		}

		$data     = new StdClass();
		$response = null;
		try {
			$response = $this->get( "{$this->q}/{$this->path}" );
		} catch ( \Exception $e ) {
			$data->success = false;
			if ( $e instanceof ConnectException || 404 === $e->getCode() ) {
				$data->message = __( 'Invalid URL!', 'nirab-wi' );
			} elseif ( 401 === $e->getCode() ) {
				$data->message = __( 'Invalid API key!', 'nirab-wi' );
			} elseif ( 400 === $e->getCode() ) {
				$data->message = __( 'Invalid Location!', 'nirab-wi' );
			} else {
				$data->message = __( 'Something went wrong! Try again later.', 'nirab-wi' );
			}
		}

		if ( $response ) {
			$data->success = true;
			$data->data    = json_decode( $response->getContents() );
		}

		// set transient for 30 minutes.
		set_transient( $transient_key, $data, 30 * 60 );

		return $data;
	}
}
