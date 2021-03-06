<?php
/**
 * Plugin Name: JS Affiliate
 * Plugin URI: https://safarzade.com
 * Description: Have affiliate system for woocommerce plugin
 * Version: 1.0
 * Author: Joseph Safarzade
 * Author URI: https://safarzade.com
 * Text Domain: js-affiliate
 *
 * @package WPBakery Page Builder
 */


if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}


if ( ! defined( 'JS_AFF_VERSION' ) ) {

    define( 'JS_AFF_VERSION', '1.0' );
}

$dir = dirname( __FILE__ );

define( 'JS_AFF_DIR', $dir );

define('JS_AFF_PLUGIN_URL',plugin_dir_url( __FILE__ ));

define('JS_AFF_PLUGIN_ASSETS_URL',JS_AFF_PLUGIN_URL . "assets");

define('JS_AFF_PLUGIN_ASSETS_CSS_URL',JS_AFF_PLUGIN_ASSETS_URL . "/css");

define('JS_AFF_PLUGIN_ASSETS_JS_URL',JS_AFF_PLUGIN_ASSETS_URL . "/js");

define( 'JS_AFF_FILE', __FILE__ );

require_once($dir . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "framework-loader.php");


