<?php

namespace VOHTMLSitemap\Includes;

use VOHTMLSitemap\Includes\Items\Day;
use VOHTMLSitemap\Includes\Items\Month;
use VOHTMLSitemap\Includes\Items\Year;

class Plugin
{
    public static function init(): void
    {
        SettingsPage::init();
        RewriteRules::init();

        add_action('pre_get_posts', [self::class, 'valiDateQuery']);
        add_action('the_content', [self::class, 'sitemapContent']);
        add_action('wp_enqueue_scripts', [self::class, 'enqueueAssets']);
    }

    /**
     * Check if the given date is a valid date and there are items for that date, otherwise set the query to a 404.
     *
     * @param \WP_Query $query
     * @return void
     *
     * In Dutch we call this a woordgrapje, a word joke. The function name is a combination of validate and date.
     */
    public static function valiDateQuery(\WP_Query $query): void
    {
        if (!($query->is_main_query() && get_query_var('vo-html-sitemap', false))) {
            return;
        }

        $day = get_query_var('vo-html-sitemap-day', false);
        $month = get_query_var('vo-html-sitemap-month', false);
        $year = get_query_var('vo-html-sitemap-year', false);

        // validate the given date (day) is a valid date, for example, 2022-02-31 is not a valid date because February has only 28 or 29 days.
        if ($day !== false && !checkdate($month, $day, $year)) {
            $query->set_404();
            return;
        }

        if ($year !== false) {
            $year = new Year($year);
        }

        if ($month !== false && $year !== false) {
            $month = new Month($year, $month);
        }

        if ($day !== false && $month !== false && $year !== false) {
            $day = new Day($year, $month, $day);
        }

        if ($day !== false && empty( PostRepository::getPostIdsForDate($day) )) {
            $query->set_404();
            return;
        }

        if ($month !== false && $day === false && empty( PostDateRepository::getDays($month) )) {
            $query->set_404();
            return;
        }

        if ($year !== false && $month === false && $day === false && empty( PostDateRepository::getMonths($year) )) {
            $query->set_404();
            return;
        }

        if ($year === false && $month === false && $day === false && empty( PostDateRepository::getYears() )) {
            $query->set_404();
            return;
        }

        wp_enqueue_style('vo-html-sitemap');
    }

    public static function sitemapContent(string $content): string
    {
        if (get_query_var('vo-html-sitemap', false) !== 'true') {
            return $content;
        }

        $year = get_query_var('vo-html-sitemap-year', false);
        $month = get_query_var('vo-html-sitemap-month', false);
        $day = get_query_var('vo-html-sitemap-day', false);

        if ($day !== false) {
            return Template::get('sitemap-day', Sitemap::getSitemapDayData($year, $month, $day));
        }

        if ($month !== false) {
            return Template::get('sitemap-month', Sitemap::getSitemapMonthData($year, $month));
        }

        if ($year !== false) {
            return Template::get('sitemap-year', Sitemap::getSitemapYearData($year));
        }

        return Template::get('sitemap', Sitemap::getSitemapOverviewData());
    }

    public static function enqueueAssets() {
        $rootUrl = plugin_dir_url(VOHTMLSITEMAP_FILE);

        wp_register_style('vo-html-sitemap', $rootUrl . 'dist/main.css', [], VOHTMLSITEMAP_VERSION);
    }
}
