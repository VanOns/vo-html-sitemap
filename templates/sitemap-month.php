<?php

use VOHTMLSitemap\Includes\Items\Day;
use VOHTMLSitemap\Includes\Items\Month;
use VOHTMLSitemap\Includes\Items\Year;

/**
 * @var $year Year
 * @var $month Month
 * @var $days Day[]
 */

?>

<div class="vo-html-sitemap">
    <h2>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a> -
        <a href="<?php echo esc_attr($year->getUrl()) ?>"><?php echo esc_html($year->getLabel()) ?></a> -
        <?php echo esc_html($month->getLabel()) ?>
    </h2>

    <ul class="vo-html-sitemap__list">
        <?php foreach ($days as $day): ?>
            <li class="vo-html-sitemap__list-item">
                <a href="<?php echo esc_attr($day->getUrl()) ?>"><?php echo esc_html($day->getLabel()) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
