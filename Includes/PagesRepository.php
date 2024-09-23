<?php

namespace VOHTMLSitemap\Includes;

use VOHTMLSitemap\Includes\Pages\Day;
use VOHTMLSitemap\Includes\Pages\LastWeek;
use VOHTMLSitemap\Includes\Pages\Month;
use VOHTMLSitemap\Includes\Pages\Page;
use VOHTMLSitemap\Includes\Pages\Sitemap;
use VOHTMLSitemap\Includes\Pages\ThisWeek;
use VOHTMLSitemap\Includes\Pages\Today;
use VOHTMLSitemap\Includes\Pages\Year;
use VOHTMLSitemap\Includes\Pages\Yesterday;

class PagesRepository
{
    public static function resolve(): ?Page
    {
        if (get_query_var('vohtmlsitemap', false) !== 'true') {
            return null;
        }

        $range = get_query_var('vohtmlsitemap-range', false);
        $day = get_query_var('vohtmlsitemap-day', false);
        $month = get_query_var('vohtmlsitemap-month', false);
        $year = get_query_var('vohtmlsitemap-year', false);

        if ($range !== false && ($range = self::getRangeBySlug($range))) {
            return $range;
        } else if ($range !== false) {
            return null;
        }

        // validate the given date (day) is a valid date, for example, 2022-02-31 is not a valid date because February has only 28 or 29 days.
        if ($day !== false && !checkdate($month, $day, $year)) {
            return null;
        }

        if ($year !== false) {
            $year = new Year($year);

            if ($month !== false) {
                $month = new Month($year, $month);

                if ($day !== false) {
                    $day = new Day($year, $month, $day);
                }
            }
        }

        if ($day !== false) {
            return $day;
        }

        if ($month !== false) {
            return $month;
        }

        if ($year !== false) {
            return $year;
        }

        return new Sitemap();
    }

    public static function getRanges(): array
    {
        return [
            new Today(),
            new Yesterday(),
            new ThisWeek(),
            new LastWeek()
        ];
    }

    public static function getRangeBySlug(string $slug): ?Page
    {
        $ranges = self::getRanges();

        foreach ($ranges as $range) {
            if ($range->getSlug() === $slug) {
                return $range;
            }
        }

        return null;
    }
}
