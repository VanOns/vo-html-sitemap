<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields('vohtmlsitemap-settings') ?>
        <?php do_settings_sections('vohtmlsitemap') ?>

        <table class="form-table">
            <tr>
                <th scope="row">
                    <?php esc_html_e('Post types', 'vohtmlsitemap'); ?>
                </th>
                <td>
                    <fieldset id="post_types">
                        <legend>
                            <?php esc_html_e('Post types to include in the sitemap', 'vohtmlsitemap') ?>
                        </legend>
                        <?php foreach (get_post_types(['public' => true]) as $type): ?>
                            <label>
                                <input type="checkbox" name="vohtmlsitemap-post-types[<?php echo esc_attr( $type ) ?>]" <?php echo checked(get_option('vohtmlsitemap-post-types')[$type] ?: false) ?>>
                                <?php echo esc_html( get_post_type_object($type)->label ) ?>
                            </label>
                            <br>
                        <?php endforeach; ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="vohtmlsitemap-page">
                        <?php esc_html_e('Sitemap page', 'vohtmlsitemap') ?>
                    </label>
                </th>
                <td>
                    <select id="vohtmlsitemap-page" name="vohtmlsitemap-page">
                        <option value="0"><?php esc_html_e('Select a page', 'vohtmlsitemap') ?></option>
                        <?php foreach (get_posts(['post_type' => 'page', 'posts_per_page' => -1]) as $page): ?>
                            <option value="<?php echo esc_attr($page->ID) ?>" <?php echo selected(get_option('vohtmlsitemap-page'), $page->ID) ?>>
                                <?php echo esc_html( $page->post_title ) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>

        <?php submit_button() ?>
    </form>
</div>
