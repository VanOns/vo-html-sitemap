<?php

namespace VOHTMLSitemap\Includes\Items;

use VOHTMLSitemap\Includes\Settings;

class Day extends Item
{
    public function __construct(
        public Year $year,
        public Month $month,
        public int $day
    )
    {
    }

    public function getLabel(): string
    {
        return $this->day;
    }

    public function getUrl(): string
    {
        return get_permalink(Settings::getPageId()) . $this->year->number . '/' . $this->month->number . '/' . $this->day;
    }
}
