<?php

use WPDrill\Response;
use WPDrill\Plugin;

if ( ! function_exists( 'nirab_plugin' ) ) {
	function nirab_plugin(): \WPDrill\Plugin {
		return \WPDrill\Plugin::getInstance();
	}
}

if ( ! function_exists( 'nirab_rest' ) ) {
	function nirab_rest( $data ): \WPDrill\Response {
		return new Response( $data );
	}
}

if ( ! function_exists( 'nirab_plugin_path' ) ) {
	function nirab_plugin_path( string $path = '' ): string {
		return NIRAB_DIR_PATH . ltrim( $path, '/' );
	}
}

if ( ! function_exists( 'nirab_plugin_file' ) ) {
	function nirab_plugin_file( string $path = '' ): string {
		return NIRAB_FILE;
	}
}

if ( ! function_exists( 'nirab_resource_path' ) ) {
	function nirab_resource_path( string $path = '' ): string {
		return nirab_plugin_path( 'resources/' . ltrim( $path, '/' ) );
	}
}

if ( ! function_exists( 'nirab_storage_path' ) ) {
	function nirab_storage_path( string $path = '' ): string {
		return nirab_plugin_path( 'storage/' . ltrim( $path, '/' ) );
	}
}

if ( ! function_exists( 'nirab_plugin' ) ) {
	function nirab_plugin( string $path = '' ): Plugin {
		return Plugin::getInstance( NIRAB_FILE );
	}
}
