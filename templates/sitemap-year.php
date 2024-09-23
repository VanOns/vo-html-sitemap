<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use VOHTMLSitemap\Includes\Pages\Month;
use VOHTMLSitemap\Includes\Pages\Year;

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

    <hr>

    <ol class="vo-html-sitemap__grid vo-html-sitemap__grid--2">
        <?php foreach ($months as $month): ?>
            <li class="vo-html-sitemap__grid-item">
                <a href="<?php echo esc_attr($month->getUrl()) ?>"><?php echo esc_html($month->getLabel()) ?></a>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
