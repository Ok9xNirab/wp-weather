<?php

return array(
	'name'               => 'Weather Information',
	'slug'               => 'weather-information',
	'prefix'             => 'nirab',
	'rest_api_namespace' => 'nirab',
	'version'            => '0.0.1',
	'is_dev'             => false,

	'initial_handlers'   => array(
		'activated'   => \Nirab\WI\Handlers\PluginActivatedHandler::class,
		'deactivated' => \Nirab\WI\Handlers\PluginDeactivatedHandler::class,
		'uninstalled' => null,
	),

	'providers'          => array(
		\WPDrill\Providers\ShortcodeServiceProvider::class,
		\WPDrill\Providers\DBServiceProvider::class,
		\WPDrill\Providers\RequestServiceProvider::class,
		\WPDrill\Providers\MenuServiceProvider::class,
		\WPDrill\Providers\ViewServiceProvider::class,
		\WPDrill\Providers\ConfigServiceProvider::class,
		\WPDrill\Providers\EnqueueServiceProvider::class,
		\WPDrill\Providers\RoutingServiceProvider::class,
		\WPDrill\Providers\MigrationServiceProvider::class,
		\WPDrill\Providers\CommonServiceProvider::class,


		\Nirab\WI\Providers\PluginServiceProvider::class,
	),
);
