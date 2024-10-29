<?php
/**
 * Plugin Name:       Weather Information
 * Plugin URI:        https://github.com/wpdrill/framework
 * Description:       A plugin development framework for human
 * Version:           1.0.0-alpha
 * Author:            Istiaq Ahmmed Nirab
 * Author URI:        https://nirab.me/
 * Text Domain:       nirab-wi
 * Domain Path:       /languages
 *
 * @package   WPDrill
 * @author    Nahid Bin Azhar <nahid.dns@gmail.com>
 * @copyright Copyright (C) 2024 WPDrill. All rights reserved.
 * @license   GPLv3 or later
 * @since     1.0.0
 */

// don't call the file directly
defined( 'ABSPATH' ) || die();

define( 'NIRAB_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'NIRAB_PREFIX', 'rvx_' );
define( 'NIRAB_FILE', __FILE__ );


if ( php_sapi_name() === 'cli' ) {
	return;
}

function nirab_wpdrill_init() {
	include __DIR__ . '/vendor/autoload.php';

	call_user_func(
		function ( $bootstrap ) {
			$bootstrap( __FILE__ );
		},
		include __DIR__ . '/bootstrap/boot.php'
	);
}

nirab_wpdrill_init();
