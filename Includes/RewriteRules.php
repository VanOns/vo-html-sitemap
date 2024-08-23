<?php

namespace VOHTMLSitemap\Includes;

class RewriteRules
{
    public static function init(): void
    {
        add_action('init', [self::class, 'addRewriteRules']);
        add_filter('query_vars', [self::class, 'addQueryVars']);
    }

    public static function addRewriteRules(): void
    {
        $id = Settings::getPageId();

        if (!$id) {
            return;
        }

        $page = get_post($id);

        if (!$page) {
            return;
        }

        $permalink = get_permalink($page->ID);
        $base = str_replace('/', '\/', trim(str_replace(home_url(), '', $permalink), '/'));

        add_rewrite_rule(
            "^{$base}\/([0-9]{4})\/?([0-9]{1,2})\/([0-9]{1,2})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-year=$matches[1]&vo-html-sitemap-month=$matches[2]&vo-html-sitemap-day=$matches[3]',
            'top'
        );
        add_rewrite_rule(
            "^{$base}\/([0-9]{4})\/([0-9]{1,2})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-year=$matches[1]&vo-html-sitemap-month=$matches[2]',
            'top'
        );

        add_rewrite_rule(
            "^{$base}\/([0-9]{4})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-year=$matches[1]',
            'top'
        );

        $sitemapDates = PagesRepository::getRanges();
        $slugs = array_map(function ($date) {
            return $date->getSlug();
        }, $sitemapDates);
        $expression = implode('|', $slugs);

        add_rewrite_rule(
            "^{$base}\/({$expression})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-range=$matches[1]',
            'top'
        );

        add_rewrite_rule(
            "^{$base}$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true',
            'top'
        );
    }

    public static function addQueryVars(array $vars): array
    {
        $vars[] = 'vo-html-sitemap';
        $vars[] = 'vo-html-sitemap-range';
        $vars[] = 'vo-html-sitemap-year';
        $vars[] = 'vo-html-sitemap-month';
        $vars[] = 'vo-html-sitemap-day';

        return $vars;
    }
}
