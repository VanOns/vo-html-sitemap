<?php
/**
 * Plugin Name:       VO HTML Sitemap
 * Description:       Van Ons plugin to add an HTML sitemap to your site.
 * Author:            Van Ons
 * Author URI:        https://van-ons.nl/
 * Version:           1.0.10
 * Text Domain:       vo-html-sitemap
 * Domain Path:       /languages
 * Requires at least: 6.4
 * Requires PHP:      8.0
 * License:           MIT
 */

namespace VOHTMLSitemap;

use Exception;

if (!defined('ABSPATH') || !function_exists('add_filter')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

// Define plugin constants.
define('VOHTMLSITEMAP_VERSION', '1.0.10');

define('VOHTMLSITEMAP_ROOT', __DIR__ . '/');
define('VOHTMLSITEMAP_ROOT_FILE', __FILE__);
define('VOHTMLSITEMAP_FILE', plugin_basename(__FILE__));
define('VOHTMLSITEMAP_NAMESPACE', 'VOHTMLSitemap');
define('VOHTMLSITEMAP_PREFIX', strtolower(VOHTMLSITEMAP_NAMESPACE));
define('VOHTMLSITEMAP_RESOURCES_PATH', VOHTMLSITEMAP_ROOT . 'resources/');
define('VOHTMLSITEMAP_SRC_PATH', VOHTMLSITEMAP_ROOT . 'src/');

/**
 * Autoload classes
 *
 * @throws Exception
 */
function autoload(string $class): void
{
    if (!str_contains($class, VOHTMLSITEMAP_NAMESPACE)) {
        return;
    }

    $result = str_replace([VOHTMLSITEMAP_NAMESPACE . '\\', '\\'], ['', '/'], $class);
    $result .= '.php';

    if (!file_exists(VOHTMLSITEMAP_SRC_PATH . $result)) {
        return;
    }

    require VOHTMLSITEMAP_SRC_PATH . $result;
}

spl_autoload_register(VOHTMLSITEMAP_NAMESPACE . '\\autoload');

Plugin::init();
