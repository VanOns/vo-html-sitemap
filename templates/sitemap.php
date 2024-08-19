<?php

use VOHTMLSitemap\Includes\Items\Year;

/**
 * @var $years Year[]
 */
?>

<div class="vo-html-sitemap">
    <h2>
        <?php the_title() ?>
    </h2>

    <ul class="vo-html-sitemap__grid">
        <?php foreach ($years as $year): ?>
            <li class="vo-html-sitemap__grid-item">
                <a href="<?php echo esc_attr($year->getUrl()) ?>"><?php echo esc_html($year->getLabel()) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
