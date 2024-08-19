<?php

namespace VOHTMLSitemap\Includes;

class Sitemap
{
    public static function getSitemapOverviewData(): array
    {
        return [
            'years' => PostDateRepository::getYears()
        ];
    }

    public static function getSitemapYearData(int $year): array
    {
        $year = new Items\Year($year);

        return [
            'year' => $year,
            'months' => PostDateRepository::getMonths($year)
        ];
    }

    public static function getSitemapMonthData(int $year, int $month): array
    {
        $year = new Items\Year($year);
        $month = new Items\Month($year, $month);

        return [
            'year' => $year,
            'month' => $month,
            'days' => PostDateRepository::getDays($month)
        ];
    }

    public static function getSitemapDayData(int $year, int $month, int $day): array
    {
        $year = new Items\Year($year);
        $month = new Items\Month($year, $month);
        $day = new Items\Day($year, $month, $day);

        return [
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'posts' => PostRepository::getPostsForDate($day)
        ];
    }
}
