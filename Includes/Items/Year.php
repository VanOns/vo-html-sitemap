<?php

namespace VOHTMLSitemap\Includes\Items;

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
        return $this->buildUrlPath([$this->number]);
    }
}
