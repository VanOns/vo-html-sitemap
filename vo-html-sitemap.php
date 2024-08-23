<?php
/**
 * Plugin Name:       Van Ons HTML Sitemap
 * Description:       Van Ons plugin to add a HTML sitemap to your site.
 * Author:            Van Ons
 * Author URI:        https://van-ons.nl/
 * Version:           1.0.0
 * Text Domain:       vo-html-sitemap
 * Domain Path:       /languages
 * Requires at least: 6.4
 * Requires PHP:      8.0
 * License:           MIT
 */

namespace VOHTMLSitemap;

use Exception;

if( !defined('ABSPATH') || !function_exists('add_filter') ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

spl_autoload_register(__NAMESPACE__ . '\\autoload');

// define plugin constants
define('VOHTMLSITEMAP_VERSION', '1.0.0');

define('VOHTMLSITEMAP_ROOT', dirname(__FILE__) . '/');
define('VOHTMLSITEMAP_ROOT_FILE', __FILE__);
define('VOHTMLSITEMAP_FILE', plugin_basename(__FILE__));
define('VOHTMLSITEMAP_PREFIX', strtolower(__NAMESPACE__));

Includes\Plugin::init();

/**
 * Autoload classes
 *
 * @param $class
 * @throws Exception
 */
function autoload( $class ) {
    if( !strstr($class, __NAMESPACE__) ) return;

    $result = str_replace(__NAMESPACE__ . '\\', '', $class);
    $result = str_replace('\\', '/', $result);
	$result .= '.php';

    if (!file_exists( VOHTMLSITEMAP_ROOT . $result)) {
    	return;
    }

    require $result;
}
