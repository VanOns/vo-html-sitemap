<?php

namespace VOHTMLSitemap\Includes\Items;

class Month extends Item
{
    public function __construct(
        public Year $year,
        public int  $number
    )
    {
    }

    public function getLabel(): string
    {
        return ucfirst(date_i18n('F', mktime(0, 0, 0, $this->number, 1, $this->year->number)));
    }

    public function getUrl(): string
    {
        return $this->buildUrlPath([$this->year->number, $this->number]);
    }
}
