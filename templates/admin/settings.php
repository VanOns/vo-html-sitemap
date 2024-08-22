<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields('vo-html-sitemap-settings') ?>
        <?php do_settings_sections('vo-html-sitemap') ?>


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
                                <input type="checkbox" name="vo-html-sitemap-post-types[<?php echo $type ?>]"
                                       value="1" <?= checked(get_option('vo-html-sitemap-post-types')[$type] ?? false) ?>>
                                <?php echo get_post_type_object($type)->label ?>
                            </label>
                            <br>
                        <?php endforeach; ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="vo-html-sitemap-page">
                        <?php esc_html_e('Sitemap page', 'vo-html-sitemap') ?>
                    </label>
                </th>
                <td>
                    <select id="vo-html-sitemap-page" name="vo-html-sitemap-page">
                        <option value="0"><?php esc_html_e('Select a page', 'vo-html-sitemap') ?></option>
                        <?php foreach (get_posts(['post_type' => 'page', 'posts_per_page' => -1]) as $page): ?>
                            <option value="<?php echo esc_attr($page->ID) ?>" <?= selected(get_option('vo-html-sitemap-page'), $page->ID) ?>>
                                <?php echo esc_html($page->post_title) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>

        <?php submit_button() ?>
    </form>
</div>
