<?php

namespace VOHTMLSitemap\Pages;

use DateTime;
use VOHTMLSitemap\Core\Settings;
use WP_Post;

abstract class Page
{
    public bool $showWhenEmpty = false;

    /**
     * Item cache
     *
     * @var null|array|Page[]|WP_Post[]
     */
    public ?array $items = null;

    /**
     * Get the items that are shown on this page.
     *
     * @return array|Page[]|WP_Post[]
     */
    abstract public function getItems(): array;

    abstract public function content(): string;

    abstract public function getLabel(): string;

    abstract public function getUrl(): string;

    /**
     * Return the latest possible date that can be shown on this page.
     *
     * @return DateTime
     */
    abstract public function getLatestDateShown(): DateTime;

    protected function buildUrlPath(array $parts = []): string
    {
        $base = rtrim(get_permalink(Settings::getPageId()), "/");

        return implode('/', array_merge([$base], $parts)) . '/';
    }

    public function getSlug(): string
    {
        return sanitize_title($this->getLabel());
    }
}
