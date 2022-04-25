<?php
/**
 *
 * @package creativityarchitect
 */
if (get_theme_mod('theme_client_logo_section_disable') != 'on') {
    ?>
    <section id="ht-logo-section" class="ht-section">
        <div class="ht-container">
            <?php
            $theme_logo_title = get_theme_mod('theme_logo_title');
            $theme_logo_sub_title = get_theme_mod('theme_logo_sub_title');
            ?>
            <?php if ($theme_logo_title || $theme_logo_sub_title) { ?>
                <div class="ht-section-title-tagline">
                    <?php if ($theme_logo_title) { ?>
                        <h2 class="ht-section-title"><?php echo esc_html($theme_logo_title); ?></h2>
                    <?php } ?>

                    <?php if ($theme_logo_sub_title) { ?>
                        <div class="ht-section-tagline"><?php echo esc_html($theme_logo_sub_title); ?></div>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php
            $theme_client_logo_image = get_theme_mod('theme_client_logo_image');
            $theme_client_logo_image = explode(',', $theme_client_logo_image);
            ?>

            <div class="ht_client_logo_slider owl-carousel">
                <?php
                foreach ($theme_client_logo_image as $theme_client_logo_image_single) {
                    $image = wp_get_attachment_image_src($theme_client_logo_image_single, 'full');
                    ?>
                    <img class="no-lazyload" src="<?php echo esc_url($image[0]); ?>">
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
