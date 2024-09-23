<?php

namespace VOHTMLSitemap\Includes;

class Settings
{
    public static function getPostTypes(): array
    {
        return array_filter(get_option('vohtmlsitemap-post-types', ['post' => true]));
    }

    public static function getPageId(): int
    {
        return get_option('vohtmlsitemap-page', 0);
    }
}
