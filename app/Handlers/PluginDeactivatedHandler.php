<?php

namespace Nirab\WI\Handlers;

use WPDrill\Contracts\InvokableContract;

class PluginDeactivatedHandler implements InvokableContract {

	public function __invoke() {
		wp_clear_scheduled_hook( 'subscrpt_daily_cron' );
	}
}
