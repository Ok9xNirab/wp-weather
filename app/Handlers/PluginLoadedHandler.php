<?php

namespace Nirab\WI\Handlers;

class PluginLoadedHandler {

	public function __construct() {
		new CronHandler();
		new WidgetHandler();
	}
}
