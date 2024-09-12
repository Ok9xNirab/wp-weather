<?php

namespace Nirab\WI\Facades;

use Nirab\WI\Services\WeatherApiService;
use WPDrill\Facade;

/**
 * @method static \StdClass current(string $q)
 * @method static \StdClass forecast(string $q)
 * @method static \StdClass nextDayForecast(string $q)
 */
class WeatherAPI extends Facade {

	public static function getFacadeAccessor() {
		return WeatherApiService::class;
	}
}
