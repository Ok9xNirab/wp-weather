<?php

namespace Nirab\WI\Providers;

use Nirab\WI\Handlers\PluginLoadedHandler;
use Nirab\WI\Services\WeatherApiService;
use WPDrill\ServiceProvider;

class PluginServiceProvider extends ServiceProvider {

	public function register(): void {
		$this->plugin->bind(
			WeatherApiService::class,
			fn() => new WeatherApiService()
		);
	}

	public function boot(): void {
		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	public function init_plugin(): void {
		new PluginLoadedHandler();
	}
}
