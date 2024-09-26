<?php

namespace VOHTMLSitemap\Pages;

use DateTime;
use VOHTMLSitemap\Core\Settings;
use VOHTMLSitemap\Core\Template;
use WP_Query;

class Today extends Page
{
    public bool $showWhenEmpty = true;

    public function content(): string
    {
        return Template::get('sitemap-range', [
            'page' => $this,
            'posts' => $this->getItems(),
        ]);
    }

    public function getItems(array $parameters = []): array
    {
        if ($this->items !== null) {
            return $this->items;
        }

        $postTypes = Settings::getPostTypes();

        $today = new DateTime('today');

        $query = new WP_Query([
            'post_type' => array_keys($postTypes),
            'post_status' => 'publish',
            'date_query' => [
                'year' => $today->format('Y'),
                'month' => $today->format('m'),
                'day' => $today->format('d'),
            ],
            'posts_per_page' => -1,
        ]);

        return $this->items = $query->posts;
    }

    public function getLabel(): string
    {
        return __('Today', 'vo-html-sitemap');
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([$this->getSlug()]);
    }

    public function getLatestDateShown(): DateTime
    {
        return new DateTime('today');
    }
}
