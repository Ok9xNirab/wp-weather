<?php

namespace Nirab\WI\Handlers;

use WPDrill\Contracts\InvokableContract;
use WPDrill\DB\Migration\Migrator;

class PluginActivatedHandler implements InvokableContract {


	private Migrator $migrator;

	public function __construct( Migrator $migrator ) {
		$this->migrator = $migrator;
	}

	public function __invoke() {
		// run migration
		$this->migrator->run();

		// register schedule.
		if ( ! wp_next_scheduled( 'nirab_wi_rain_alert' ) ) {
			wp_schedule_event( time(), 'daily', 'nirab_wi_rain_alert' );
		}
	}
}
