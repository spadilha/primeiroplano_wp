<?php
/*
Plugin Name: 	Admin Columns Pro - Yoast SEO
Version:        1.0.3
Description: 	Enhance Yoast SEO columns with Admin Columns Pro features
Author:         AdminColumns.com
Author URI:     https://www.admincolumns.com
Plugin URI:     https://www.admincolumns.com
Text Domain: 	codepress-admin-columns
Requires PHP:   5.6.20
*/

use ACA\YoastSeo\Dependencies;
use ACA\YoastSeo\YoastSeo;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_admin() ) {
	return;
}

require_once __DIR__ . '/classes/Dependencies.php';

add_action( 'after_setup_theme', function () {
	$dependencies = new Dependencies( plugin_basename( __FILE__ ), '1.0.3' );
	$dependencies->requires_acp( '5.2.1' );
	$dependencies->requires_php( '5.6.20' );

	if ( ! defined( 'WPSEO_VERSION' ) ) {
		$dependencies->add_missing_plugin( 'Yoast SEO', $dependencies->get_search_url( 'Yoast SEO' ) );
	};

	if ( $dependencies->has_missing() ) {
		return;
	}

	$class_map = __DIR__ . '/config/autoload-classmap.php';

	if ( is_readable( $class_map ) ) {
		AC\Autoloader::instance()->register_class_map( require $class_map );
	} else {
		AC\Autoloader::instance()->register_prefix( 'ACA\YoastSeo', __DIR__ . '/classes' );
	}

	$addon = new YoastSeo( __FILE__ );
	$addon->register();
} );