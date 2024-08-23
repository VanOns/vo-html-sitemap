<?php

use VOHTMLSitemap\Includes\Items\Month;
use VOHTMLSitemap\Includes\Items\Year;

/**
 * @var $year Year
 * @var $months Month[]
 */

?>

<div class="vo-html-sitemap">
    <h2>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a> -
        <?php echo esc_html( $year->getLabel() ) ?>
    </h2>

    <ul class="vo-html-sitemap__grid">
        <?php foreach ($months as $month): ?>
            <li class="vo-html-sitemap__grid-item">
                <a href="<?php echo esc_attr($month->getUrl()) ?>"><?php echo esc_html($month->getLabel()) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
