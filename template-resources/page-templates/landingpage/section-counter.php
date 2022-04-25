<?php
/**
 *
 * @package creativityarchitect
 */
if (get_theme_mod('theme_counter_section_disable') != 'on') {
    ?>
    <section id="ht-counter-section" data-stellar-background-ratio="0.5">
        <div class="ht-counter-section ht-section">
            <div class="ht-counter-overlay"></div>
            <div class="ht-container">
                <?php
                $theme_counter_title = get_theme_mod('theme_counter_title');
                $theme_counter_sub_title = get_theme_mod('theme_counter_sub_title');
                ?>
                <?php
                if ($theme_counter_title || $theme_counter_sub_title) {
                    ?>
                    <div class="ht-section-title-tagline">
                        <?php if ($theme_counter_title) { ?>
                            <h2 class="ht-section-title"><?php echo esc_html($theme_counter_title); ?></h2>
                        <?php } ?>

                        <?php if ($theme_counter_sub_title) { ?>
                            <div class="ht-section-tagline"><?php echo esc_html($theme_counter_sub_title); ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="ht-team-counter-wrap ht-clearfix">
                    <?php
                    for ($i = 1; $i < 5; $i++) {
                        $theme_counter_title = get_theme_mod('theme_counter_title' . $i);
                        $theme_counter_count = get_theme_mod('theme_counter_count' . $i);
                        $theme_counter_icon = get_theme_mod('theme_counter_icon' . $i);
                        if ($theme_counter_count) {
                            ?>
                            <div class="ht-counter">
                                <div class="ht-counter-icon">
                                    <i class="<?php echo esc_attr($theme_counter_icon); ?>"></i>
                                </div>

                                <div class="ht-counter-count odometer odometer<?php echo esc_attr($i); ?>" data-count="<?php echo absint($theme_counter_count); ?>">
                                    99
                                </div>

                                <h6 class="ht-counter-title">
                                    <?php echo esc_html($theme_counter_title); ?>
                                </h6>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
