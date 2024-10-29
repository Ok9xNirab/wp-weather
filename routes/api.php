<?php

use WPDrill\Facades\Route;

Route::get( '/wpdrill', \Nirab\WI\Rest\Controllers\WPDrillController::class )->middleware( \Nirab\WI\Rest\Middleware\WPDrillMiddleware::class );

Route::group(
	array(
		'prefix'     => '/info',
		'middleware' => function () {
			return false;
		},
	),
	function () {
		Route::get(
			'/about',
			function () {
				return array(
					'title'   => 'About WPDrill',
					'content' => 'A WordPress Plugin development framework for humans',
				);
			}
		);
	}
);
