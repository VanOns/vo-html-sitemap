<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use VOHTMLSitemap\Includes\Pages\Page;

/**
 * @var $page Page
 * @var $posts WP_Post[]
 */

?>
<div class="vo-html-sitemap">
    <h2>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a> -
        <?php echo esc_html($page->getLabel()) ?>
    </h2>

    <hr>

    <h3>
        <?php echo esc_html( __('Posts') ) ?>
    </h3>

    <ul class="vo-html-sitemap__list">
        <?php if (empty($posts)): ?>
            <li class="vo-html-sitemap__list-item">
                <?php esc_html_e('No posts found', 'vohtmlsitemap') ?>
            </li>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <li class="vo-html-sitemap__list-item">
                    <a href="<?php echo esc_attr(get_permalink($post)) ?>"><?php echo esc_html($post->post_title) ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
