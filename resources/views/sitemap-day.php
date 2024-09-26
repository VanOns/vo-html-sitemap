<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use VOHTMLSitemap\Pages\Day;
use VOHTMLSitemap\Pages\Month;
use VOHTMLSitemap\Pages\Year;

/**
 * @var $year Year
 * @var $month Month
 * @var $day Day
 * @var $posts WP_Post[]
 */

?>
<div class="vo-html-sitemap">
    <h2>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a> -
        <a href="<?php echo esc_attr($year->getUrl()) ?>"><?php echo esc_html($year->getLabel()) ?></a> -
        <a href="<?php echo esc_attr($month->getUrl()) ?>"><?php echo esc_html($month->getLabel()) ?></a> -
        <?php echo esc_html($day->getLabel()) ?>
    </h2>

    <hr>

    <h3>
        <?php echo esc_html(__('Posts')) ?>
    </h3>

    <ul class="vo-html-sitemap__list">
        <?php foreach ($posts as $post): ?>
            <li class="vo-html-sitemap__list-item">
                <a href="<?php echo esc_attr(get_permalink($post)) ?>"><?php echo esc_html($post->post_title) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
