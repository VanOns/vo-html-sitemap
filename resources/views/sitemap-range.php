<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use VOHTMLSitemap\Pages\Page;

/**
 * @var $page Page
 * @var $postTypes array
 */

?>
<div class="vo-html-sitemap">
    <h2>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a> -
        <?php echo esc_html($page->getLabel()) ?>
    </h2>

    <hr>

    <?php if (empty($postTypes)): ?>
        <p><?php esc_html_e('Nothing found', 'vo-html-sitemap') ?></p>
    <?php else: ?>
        <?php foreach ($postTypes as $postType => $posts): ?>
            <h3><?php echo esc_html(get_post_type_object($postType)->label) ?></h3>

            <ul class="vo-html-sitemap__list">
                <?php foreach ($posts as $post): ?>
                    <li class="vo-html-sitemap__list-item">
                        <a href="<?php echo esc_attr(get_permalink($post)) ?>"><?php echo esc_html($post->post_title) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
