<?php

use VOHTMLSitemap\Includes\Items\Day;
use VOHTMLSitemap\Includes\Items\Month;
use VOHTMLSitemap\Includes\Items\Year;

/**
 * @var $year Year
 * @var $month Month
 * @var $day Day
 * @var $posts WP_Post[]
 */

?>

<h2>
    <a href="<?php the_permalink()?>"><?php the_title() ?></a> -
    <a href="<?php echo esc_attr($year->getUrl()) ?>"><?php echo esc_html( $year->getLabel() ) ?></a> -
    <a href="<?php echo esc_attr($month->getUrl()) ?>"><?php echo esc_html( $month->getLabel() ) ?></a> -
    <?php echo esc_html( $day->getLabel() ) ?>
</h2>

<h3>
    <?php esc_html_e( __('Posts') ) ?>
</h3>

<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href="<?php echo esc_attr( get_permalink($post) ) ?>"><?php echo esc_html( $post->post_title ) ?></a>
        </li>
    <?php endforeach; ?>
</ul>
