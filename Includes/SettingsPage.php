<?php

namespace VOHTMLSitemap\Includes;

class SettingsPage
{
    public static function init(): void
    {
        add_action('admin_init', [self::class, 'registerSettings']);
        add_action('admin_menu', [self::class, 'addSubmenuPage']);
    }

    public static function registerSettings(): void
    {
        register_setting('vo-html-sitemap-settings', 'vo-html-sitemap-post-types', [
            'type' => 'array',
            'sanitize_callback' => function ($value) {
                return array_map(function (string $type) use ($value) {
                    return isset($value[$type]) && $value[$type];
                }, get_post_types(['public' => true]));
            },
            'default' => [
                'post' => true
            ]
        ]);

        register_setting('vo-html-sitemap-settings', 'vo-html-sitemap-page', [
            'type' => 'integer',
            'sanitize_callback' => function ($value) {
                $id = (int) $value;
                $page = get_post($id);

                return $page && $page?->post_type === 'page' ? $id : 0;
            },
            'default' => 0
        ]);

        add_settings_section(
            'vo-html-sitemap',
            __('VO HTML Sitemap Settings', 'vo-html-sitemap'),
            '__return_false',
            'vo-html-sitemap'
        );
    }

    public static function addSubmenuPage(): void
    {
        add_submenu_page(
            'options-general.php',
            __('VO HTML Sitemap', 'vo-html-sitemap'),
            __('HTML Sitemap', 'vo-html-sitemap'),
            'manage_options',
            'vo-html-sitemap',
            [self::class, 'renderSubmenuPage']
        );
    }

    public static function renderSubmenuPage(): void
    {
        Template::render('admin/settings');
    }
}
