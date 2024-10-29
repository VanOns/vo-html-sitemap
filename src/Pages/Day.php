<?php

namespace VOHTMLSitemap\Pages;

use DateTime;
use VOHTMLSitemap\Core\Settings;
use VOHTMLSitemap\Core\Template;
use WP_Query;

class Day extends Page
{
    public function __construct(
        public Year  $year,
        public Month $month,
        public int   $number
    ) {}

    public function content(): string
    {
        return Template::get('sitemap-day', [
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this,
            'postTypes' => $this->getItems(),
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
                'year' => $this->year->number,
                'month' => $this->month->number,
                'day' => $this->number,
            ],
            'orderby' => ['type', 'date'],
            'posts_per_page' => -1,
        ]);

        return $this->items = $this->splitByPostType($query->posts);
    }

    public function getLabel(): string
    {
        return $this->number;
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([$this->year->number, $this->month->number, $this->number]);
    }

    public function getLatestDateShown(): DateTime
    {
        return new DateTime("{$this->year->number}-{$this->month->number}-{$this->number}");
    }
}
