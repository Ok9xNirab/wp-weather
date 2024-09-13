<?php

namespace Nirab\WI\Handlers;

/**
 * Some initialization after plugins loaded.
 */
class PluginLoadedHandler {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		new CronHandler();
		new WidgetHandler();
		new BlockHandler();
	}
}
