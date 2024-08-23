<?php

namespace VOHTMLSitemap\Includes\Pages;

use DateTime;
use VOHTMLSitemap\Includes\Settings;
use VOHTMLSitemap\Includes\Template;
use WP_Query;

class LastWeek extends Page
{
    public bool $showWhenEmpty = true;

    public function content(): string
    {
        return Template::get('sitemap-range', [
            'page' => $this,
            'posts' => $this->getItems()
        ]);
    }

    public function getItems(array $parameters = []): array
    {
        if ($this->items !== null) {
            return $this->items;
        }

        $postTypes = Settings::getPostTypes();

        $query = new WP_Query([
            'post_type' => array_keys($postTypes),
            'post_status' => 'publish',
            'date_query' => [
                'after' => gmdate('Y-m-d', strtotime('last week monday midnight')),
                'before' => gmdate('Y-m-d', strtotime('last week sunday 23:59:59'))
            ],
            'posts_per_page' => -1
        ]);

        return $this->items = $query->posts;
    }

    public function getLabel(): string
    {
        return __('Last week', 'vo-html-sitemap');
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([sanitize_title($this->getLabel())]);
    }

    public function getLatestDateShown(): DateTime
    {
        return new DateTime('last week');
    }
}
