<?php

namespace Nirab\WI\Rest\Controllers;

use Nirab\WI\Models\User;
use WPDrill\Contracts\InvokableContract;
use WPDrill\DB\QueryBuilder\QueryBuilderHandler;

class WPDrillController implements InvokableContract {


	protected QueryBuilderHandler $db;

	public function __construct( QueryBuilderHandler $db ) {
		$this->db = $db;
	}

	public function __invoke() {
		$user = User::where( 'id', 1 )->first();
		// $user = $this->db->table('users')->where('id', 1)->first();
		return nirab_rest( $user )
			->setHeader( 'Content-Type', 'application/json' )
			->details( 'User fetched successfully' )
			->success( 'User found' );
	}
}
