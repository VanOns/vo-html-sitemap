<?php
namespace VOHTMLSitemap\Includes\Items;

abstract class Item
{
    abstract public function getLabel(): string;
    abstract public function getUrl(): string;
}
