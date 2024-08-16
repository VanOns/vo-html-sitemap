<?php

use VOHTMLSitemap\Includes\Items\Year;

/**
 * @var $years Year[]
 */
?>

<h2>
    <?php the_title() ?>
</h2>

<ul>
    <?php foreach ($years as $year): ?>
        <li>
            <a href="<?php echo esc_attr( $year->getUrl() ) ?>"><?php echo esc_html( $year->getLabel() ) ?></a>
        </li>
    <?php endforeach; ?>
</ul>
