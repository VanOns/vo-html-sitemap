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
        register_setting('vohtmlsitemap-settings', 'vohtmlsitemap-post-types', [
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

        register_setting('vohtmlsitemap-settings', 'vohtmlsitemap-page', [
            'type' => 'integer',
            'sanitize_callback' => function ($value) {
                $id = (int) $value;
                $page = get_post($id);

                return $page && $page?->post_type === 'page' ? $id : 0;
            },
            'default' => 0
        ]);

        add_settings_section(
            'vohtmlsitemap',
            __('VO HTML Sitemap Settings', 'vohtmlsitemap'),
            '__return_false',
            'vohtmlsitemap'
        );

        $settings = [
            'vo-html-sitemap-post-types' => 'vohtmlsitemap-post-types',
            'vo-html-sitemap-page' => 'vohtmlsitemap-page'
        ];

        // rename old settings, if they exist
        foreach ($settings as $old => $new) {
            if ($value = get_option($old)) {
                update_option($new, $value);
                delete_option($old);
            }
        }
    }

    public static function addSubmenuPage(): void
    {
        add_submenu_page(
            'options-general.php',
            __('VO HTML Sitemap', 'vohtmlsitemap'),
            __('HTML Sitemap', 'vohtmlsitemap'),
            'manage_options',
            'vohtmlsitemap',
            [self::class, 'renderSubmenuPage']
        );
    }

    public static function renderSubmenuPage(): void
    {
        Template::render('admin/settings');
    }
}
