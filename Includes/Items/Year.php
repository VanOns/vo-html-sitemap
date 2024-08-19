<?php

namespace VOHTMLSitemap\Includes\Items;

use VOHTMLSitemap\Includes\Settings;

class Year extends Item
{
    public function __construct(
        public int $number
    )
    {
    }

    public function getLabel(): string
    {
        return $this->number;
    }

    public function getUrl(): string
    {
        return get_permalink(Settings::getPageId()) . $this->number;
    }
}
