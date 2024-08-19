<?php

namespace VOHTMLSitemap\Includes;

use VOHTMLSitemap\Includes\Items\Day;

class PostRepository
{
    public static function getPostIdsForDate(Day $day): array
    {
        $postTypes = Settings::getPostTypes();

        $query = new \WP_Query([
            'post_type' => array_keys($postTypes),
            'post_status' => 'publish',
            'fields' => 'ids',
            'date_query' => [
                'year' => $day->year->number,
                'month' => $day->month->number,
                'day' => $day->day
            ],
            'posts_per_page' => -1
        ]);

        return $query->posts;
    }

    public static function getPostsForDate(Day $day): array
    {
        $postTypes = Settings::getPostTypes();

        $query = new \WP_Query([
            'post_type' => array_keys($postTypes),
            'post_status' => 'publish',
            'date_query' => [
                'year' => $day->year->number,
                'month' => $day->month->number,
                'day' => $day->day
            ],
            'posts_per_page' => -1
        ]);

        return $query->posts;
    }
}
