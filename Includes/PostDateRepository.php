<?php

namespace VOHTMLSitemap\Includes;

use VOHTMLSitemap\Includes\Items\Month;
use VOHTMLSitemap\Includes\Items\Year;

class PostDateRepository
{
    protected $wpdb;

    protected function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    /**
     * @return Year[]
     */
    public static function getYears(): array
    {
        $self = static::getInstance();

        $sql = "SELECT YEAR(post_date) AS year FROM {$self->wpdb->posts} WHERE post_type IN ({$self->getPostTypesPreparedCount()}) AND post_status = 'publish' GROUP BY year ORDER BY year ASC";
        $years = $self->query($sql, $self->getPostTypesPreparedValues());

        return array_map(fn($year) => new Year($year->year), $years);
    }

    protected static function getInstance(): PostDateRepository
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }
        return $instance;
    }

    protected function getPostTypesPreparedCount(): string
    {
        return implode(', ', array_fill(0, count($this->getPostTypesPreparedValues()), '%s'));
    }

    protected function getPostTypesPreparedValues(): array
    {
        return array_keys(Settings::getPostTypes());
    }

    protected function query($sql, array $args = []): array
    {
        return $this->wpdb->get_results($this->wpdb->prepare($sql, $args));
    }

    /**
     * @param Year $year
     * @return Month[]
     */
    public static function getMonths(Year $year): array
    {
        $self = static::getInstance();

        $sql = "SELECT MONTH(post_date) AS month FROM {$self->wpdb->posts} WHERE YEAR(post_date) = %d AND post_type IN ({$self->getPostTypesPreparedCount()}) AND post_status = 'publish' GROUP BY month ORDER BY month ASC";
        $months = $self->query($sql, array_merge([$year->number], $self->getPostTypesPreparedValues()));

        return array_map(fn($month) => new Month($year, $month->month), $months);
    }

    /**
     * @param Year $year
     * @param Month $month
     * @return Items\Day[]
     */
    public static function getDays(Month $month): array
    {
        $self = static::getInstance();

        $sql = "SELECT DAY(post_date) AS day FROM {$self->wpdb->posts} WHERE YEAR(post_date) = %d AND MONTH(post_date) = %d AND post_type IN ({$self->getPostTypesPreparedCount()}) AND post_status = 'publish' GROUP BY day ORDER BY day ASC";
        $days = $self->query($sql, array_merge([$month->year->number, $month->number], $self->getPostTypesPreparedValues()));

        return array_map(fn($day) => new Items\Day($month->year, $month, $day->day), $days);
    }
}
