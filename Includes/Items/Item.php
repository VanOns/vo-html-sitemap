<?php

namespace VOHTMLSitemap\Includes\Items;

use VOHTMLSitemap\Includes\Settings;

abstract class Item
{
    abstract public function getLabel(): string;

    abstract public function getUrl(): string;

    protected function buildUrlPath(array $parts): string
    {
        $base = rtrim(get_permalink(Settings::getPageId()), "/");

        return implode('/', array_merge([$base], $parts)) . '/';
    }
}
