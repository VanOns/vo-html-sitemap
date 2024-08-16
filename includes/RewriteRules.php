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

        add_rewrite_rule(
            "^{$page->post_name}\/([0-9]{4})\/([0-9]{1,2})\/([0-9]{1,2})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-year=$matches[1]&vo-html-sitemap-month=$matches[2]&vo-html-sitemap-day=$matches[3]',
            'top'
        );
        add_rewrite_rule(
            "{$page->post_name}\/([0-9]{4})\/([0-9]{1,2})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-year=$matches[1]&vo-html-sitemap-month=$matches[2]',
            'top'
        );

        add_rewrite_rule(
            "{$page->post_name}\/([0-9]{4})$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true&vo-html-sitemap-year=$matches[1]',
            'top'
        );

        add_rewrite_rule(
            "{$page->post_name}$",
            'index.php?page_id=' . $page->ID . '&vo-html-sitemap=true',
            'top'
        );
    }

    public static function addQueryVars(array $vars): array
    {
        $vars[] = 'vo-html-sitemap';
        $vars[] = 'vo-html-sitemap-year';
        $vars[] = 'vo-html-sitemap-month';
        $vars[] = 'vo-html-sitemap-day';

        return $vars;
    }
}
