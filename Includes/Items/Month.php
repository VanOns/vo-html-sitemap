<?php

namespace VOHTMLSitemap\Includes\Items;

use VOHTMLSitemap\Includes\Settings;

class Month extends Item
{
    public function __construct(
        public Year $year,
        public int $number
    )
    {
    }

    public function getLabel(): string
    {
        return ucfirst( date_i18n('F', mktime(0, 0, 0, $this->number, 1, $this->year->number) ) );
    }

    public function getUrl(): string
    {
        return get_permalink(Settings::getPageId()) . $this->year->number . '/' . $this->number;
    }
}
