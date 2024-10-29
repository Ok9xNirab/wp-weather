<?php

use Nirab\WI\Shortcodes\NirabWiShortCode;
use WPDrill\Facades\Shortcode;
use WPDrill\Plugin;

return function ( Plugin $plugin ) {
	Shortcode::add( 'nirab-wi', NirabWiShortCode::class );
};
