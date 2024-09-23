<?php

namespace VOHTMLSitemap\Includes\Pages;

use DateTime;
use VOHTMLSitemap\Includes\QueryHelper;
use VOHTMLSitemap\Includes\Template;

class Month extends Page
{
    public function __construct(
        public Year $year,
        public int  $number
    )
    {
    }

    public function content(): string
    {
        return Template::get('sitemap-month', [
            'year' => $this->year,
            'month' => $this,
            'days' => $this->getItems()
        ]);
    }

    public function getItems(array $parameters = []): array
    {
        if ($this->items !== null) {
            return $this->items;
        }

        $qh = QueryHelper::getInstance();

        $days = $qh->wpdb->get_results(
            $qh->wpdb->prepare(
                "SELECT DAY(post_date) AS day FROM {$qh->wpdb->posts} WHERE YEAR(post_date) = %d AND MONTH(post_date) = %d AND post_type IN ({$qh->getPostTypesPreparableCount()}) AND post_status = 'publish' GROUP BY day ORDER BY day ASC",
                array_merge([$this->year->number, $this->number], $qh->getPostTypesPreparableValues())
            )
        );

        return $this->items = array_map(fn($day) => new Day($this->year, $this, $day->day), $days);
    }

    public function getLabel(): string
    {
        return ucfirst(wp_date('F', mktime(0, 0, 0, $this->number, 1, $this->year->number)));
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([$this->year->number, $this->number]);
    }

    public function getLatestDateShown(): DateTime
    {
        $day = gmdate('t', mktime(0, 0, 0, $this->number, 1, $this->year->number));
        return new DateTime("{$this->year->number}-{$this->number}-{$day}");
    }
}
