<?php

namespace VOHTMLSitemap\Includes;

use VOHTMLSitemap\Includes\Pages\Page;
use WP_Query;

class Plugin
{
    protected ?Page $page = null;

    protected function __construct()
    {
    }

    public static function init(): void
    {
        $self = new self();

        SettingsPage::init();
        RewriteRules::init();

        add_action('pre_get_posts', [$self, 'valiDateQuery']);
        add_action('the_content', [$self, 'sitemapContent']);
        add_action('wp_enqueue_scripts', [$self, 'enqueueAssets']);
        add_action('init', [$self, 'loadTextDomain'], 0, 9);
    }

    /**
     * Check if the given date is a valid date and there are items for that date, otherwise set the query to a 404.
     *
     * @param WP_Query $query
     * @return void
     *
     * In Dutch, we call this a woordgrapje, a word joke. The function name is a combination of validate and date.
     */
    public function valiDateQuery(WP_Query $query): void
    {
        if (!$query->is_main_query()) {
            return;
        }

        $page = PagesRepository::resolve();

        if (is_null($page)) {
            return;
        }

        if ($page->showWhenEmpty !== true && empty($page->getItems())) {
            $query->set_404();
            return;
        }

        $this->page = $page;

        wp_enqueue_style('vohtmlsitemap');

        if ($page->getLatestDateShown()->getTimestamp() < strtotime('-1 year')) {
            header('X-Robots-Tag: noindex');
        }
    }

    public function sitemapContent(string $content): string
    {
        if (is_null($this->page)) {
            return $content;
        }

        return $this->page->content();
    }

    public function enqueueAssets(): void
    {
        $rootUrl = plugin_dir_url(VOHTMLSITEMAP_FILE);

        wp_register_style('vohtmlsitemap', $rootUrl . 'dist/main.css', [], VOHTMLSITEMAP_VERSION);
    }

    public function loadTextDomain(): void
    {
        load_plugin_textdomain('vo-html-sitemap', false, dirname(plugin_basename(VOHTMLSITEMAP_FILE)) . '/languages');
    }
}
