<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

?>

<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields('vohtmlsitemap-settings') ?>
        <?php do_settings_sections('vohtmlsitemap') ?>

        <table class="form-table">
            <tr>
                <th scope="row">
                    <?php esc_html_e('Post types', 'vo-html-sitemap'); ?>
                </th>
                <td>
                    <fieldset id="post_types">
                        <legend>
                            <?php esc_html_e('Post types to include in the sitemap', 'vo-html-sitemap') ?>
                        </legend>
                        <?php foreach (get_post_types(['public' => true]) as $type): ?>
                            <label>
                                <input type="checkbox" name="vohtmlsitemap-post-types[<?php echo esc_attr($type) ?>]" <?php echo checked(get_option('vohtmlsitemap-post-types')[$type] ?: false) ?>>
                                <?php echo esc_html(get_post_type_object($type)->label) ?>
                            </label>
                            <br>
                        <?php endforeach; ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="vohtmlsitemap-page">
                        <?php esc_html_e('Sitemap page', 'vo-html-sitemap') ?>
                    </label>
                </th>
                <td>
                    <select id="vohtmlsitemap-page" name="vohtmlsitemap-page">
                        <option value="0"><?php esc_html_e('Select a page', 'vo-html-sitemap') ?></option>
                        <?php foreach (get_posts(['post_type' => 'page', 'posts_per_page' => -1, 'post_status' => 'any']) as $page): ?>
                            <option value="<?php echo esc_attr($page->ID) ?>" <?php echo selected(get_option('vohtmlsitemap-page'), $page->ID) ?>>
                                <?php echo esc_html($page->post_title) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p>
                        <?php esc_html_e('After changing this setting you need to re-save your permalink settings.', 'vo-html-sitemap') ?>
                        <br>
                        <a href="<?php echo esc_url(admin_url('options-permalink.php')) ?>">
                            <?php esc_html_e('Permalink Settings', 'vo-html-sitemap') ?>
                        </a>
                    </p>
                </td>
            </tr>
        </table>

        <?php submit_button() ?>
    </form>
</div>
