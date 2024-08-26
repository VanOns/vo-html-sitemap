<?php

use VOHTMLSitemap\Includes\Items\Year;
use VOHTMLSitemap\Includes\PagesRepository;

/**
 * @var $years Year[]
 */
?>

<div class="vo-html-sitemap">
    <h2>
        <?php the_title() ?>
    </h2>

    <hr>

    <ul class="vo-html-sitemap__row">
        <?php foreach (PagesRepository::getRanges() as $range): ?>
            <li class="vo-html-sitemap__row-item">
                <a href="<?php echo esc_attr($range->getUrl()) ?>"><?php echo esc_html($range->getLabel()) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

    <ol class="vo-html-sitemap__grid">
        <?php foreach ($years as $year): ?>
            <li class="vo-html-sitemap__grid-item">
                <a href="<?php echo esc_attr($year->getUrl()) ?>"><?php echo esc_html($year->getLabel()) ?></a>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
