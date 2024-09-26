<?php

namespace VOHTMLSitemap\Core;

class QueryHelper
{
    public $wpdb;

    protected function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public static function getInstance(): QueryHelper
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }
        return $instance;
    }

    public function getPostTypesPreparableCount(): string
    {
        return implode(', ', array_fill(0, count($this->getPostTypesPreparableValues()), '%s'));
    }

    public function getPostTypesPreparableValues(): array
    {
        return array_keys(Settings::getPostTypes());
    }
}
