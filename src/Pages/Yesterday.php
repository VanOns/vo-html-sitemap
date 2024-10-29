<?php

namespace VOHTMLSitemap\Pages;

use DateTime;
use VOHTMLSitemap\Core\Settings;
use VOHTMLSitemap\Core\Template;
use WP_Query;

class Yesterday extends Page
{
    public bool $showWhenEmpty = true;

    public function content(): string
    {
        return Template::get('sitemap-range', [
            'page' => $this,
            'postTypes' => $this->getItems(),
        ]);
    }

    public function getItems(array $parameters = []): array
    {
        if ($this->items !== null) {
            return $this->items;
        }

        $postTypes = Settings::getPostTypes();

        $yesterday = new DateTime('yesterday');

        $query = new WP_Query([
            'post_type' => array_keys($postTypes),
            'post_status' => 'publish',
            'date_query' => [
                'year' => $yesterday->format('Y'),
                'month' => $yesterday->format('m'),
                'day' => $yesterday->format('d'),
            ],
            'posts_per_page' => -1,
            'orderby' => ['type', 'date'],
        ]);

        return $this->items = $this->splitByPostType( $query->posts );
    }

    public function getLabel(): string
    {
        return __('Yesterday', 'vo-html-sitemap');
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([sanitize_title($this->getLabel())]);
    }

    public function getLatestDateShown(): DateTime
    {
        return new DateTime('yesterday');
    }
}
