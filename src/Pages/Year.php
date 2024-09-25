<?php

namespace VOHTMLSitemap\Pages;

use DateTime;
use VOHTMLSitemap\Core\QueryHelper;
use VOHTMLSitemap\Core\Template;

class Year extends Page
{
    public function __construct(
        public int $number
    ) {}

    public function content(): string
    {
        return Template::get('sitemap-year', [
            'year' => $this,
            'months' => $this->getItems(),
        ]);
    }

    public function getItems(array $parameters = []): array
    {
        if ($this->items !== null) {
            return $this->items;
        }

        $qh = QueryHelper::getInstance();

        $months = $qh->wpdb->get_results(
            $qh->wpdb->prepare(
                "SELECT MONTH(post_date) AS month FROM {$qh->wpdb->posts} WHERE YEAR(post_date) = %d AND post_type IN ({$qh->getPostTypesPreparableCount()}) AND post_status = 'publish' GROUP BY month ORDER BY month ASC",
                array_merge([$this->number], $qh->getPostTypesPreparableValues())
            )
        );

        return $this->items = array_map(fn ($month) => new Month($this, $month->month), $months);
    }

    public function getLabel(): string
    {
        return $this->number;
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([$this->number]);
    }

    public function getLatestDateShown(): DateTime
    {
        return new DateTime("{$this->number}-12-31");
    }
}
