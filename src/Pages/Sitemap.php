<?php

namespace VOHTMLSitemap\Pages;

use DateTime;
use VOHTMLSitemap\Core\QueryHelper;
use VOHTMLSitemap\Core\Settings;
use VOHTMLSitemap\Core\Template;

class Sitemap extends Page
{
    public bool $showWhenEmpty = true;

    protected int $id = 0;

    public function __construct()
    {
        $this->id = Settings::getPageId();
    }

    public function content(): string
    {
        return Template::get('sitemap', [
            'years' => $this->getItems(),
        ]);
    }

    public function getItems(array $parameters = []): array
    {
        if ($this->items !== null) {
            return $this->items;
        }

        $qh = QueryHelper::getInstance();

        $years = $qh->wpdb->get_results(
            $qh->wpdb->prepare(
                "SELECT YEAR(post_date) AS year FROM {$qh->wpdb->posts} WHERE post_type IN ({$qh->getPostTypesPreparableCount()}) AND post_status = 'publish' GROUP BY year ORDER BY year DESC",
                $qh->getPostTypesPreparableValues()
            )
        );

        return $this->items = array_map(fn ($year) => new Year($year->year), $years);
    }

    public function getLabel(): string
    {
        return get_the_title($this->id);
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath();
    }

    public function getLatestDateShown(): DateTime
    {
        return new DateTime('today');
    }
}
