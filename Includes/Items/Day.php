<?php

namespace VOHTMLSitemap\Includes\Items;

class Day extends Item
{
    public function __construct(
        public Year  $year,
        public Month $month,
        public int   $number
    )
    {
    }

    public function getLabel(): string
    {
        return $this->number;
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([$this->year->number, $this->month->number, $this->number]);
    }
}
