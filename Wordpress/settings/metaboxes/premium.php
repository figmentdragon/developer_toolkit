<?php
/**
 * Metabox template for displaying premium features.
 *
 * @package TheThemeName
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );
?>

<a href="https://wp-pagebuilderframework.com/premium/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName" target="_blank" class="premium-add-on-banner-link">
	<img class="premium-add-on-banner" src="<?php echo esc_url( THEME_URI ); ?>/img/premium-add-on-banner.jpg" alt="TheThemeName Premium Add-On">
</a>

<div class="heatbox premium-metabox">

	<h2>
		<?php _e( 'Premium Add-On Features', 'TheThemeName' ); ?>
		<a href="https://wp-pagebuilderframework.com/premium/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName" target="_blank" style="float: right;"><?php _e( 'Upgrade Now', 'TheThemeName' ); ?></a>
	</h2>

	<ul class="premium-list">

		<?php

			$premium_features = array(
				array(
					'title'       => __( 'Transparent Header', 'TheThemeName' ),
					'description' => __( 'Create a customizable Transparent Header with just a few clicks.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/premium/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'title'       => __( 'Sticky Navigation', 'TheThemeName' ),
					'description' => __( 'Create a beautiful & fully customizable Sticky Navigation in seconds.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/premium/?video=stickynav&utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName#premium',
				),
				array(
					'title'       => __( 'White Label Settings', 'TheThemeName' ),
					'description' => __( 'Your theme, your branding. Fully white label TheThemeName & the Premium Add-On.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/docs/white-label/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'title'       => __( 'Advanced Typography', 'TheThemeName' ),
					'description' => __( 'Customize fonts and add Typekit- & Custom Fonts to your website.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/docs/advanced-typography/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'title'       => __( 'Adjustable Breakpoints', 'TheThemeName' ),
					'description' => __( 'Set custom responsive breakpoints for tablets, desktops & mobiles for a pixel perfect design.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/docs/custom-responsive-breakpoints/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'title'       => __( 'Advanced WooCommerce Features', 'TheThemeName' ),
					'description' => __( 'Take full control over the design of your online store with more advanced WooCommerce features.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/free-woocommerce-theme/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName#premium',
				),
				array(
					'title'       => __( 'Mega Menu', 'TheThemeName' ),
					'description' => __( 'Easily create an advanced mega menu with up to 4 rows.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/docs/mega-menu/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'title'       => __( 'Call to Action Button', 'TheThemeName' ),
					'description' => __( 'Add a customizable Call to Action Button to your navigation with just a few clicks.', 'TheThemeName' ),
					'link'        => 'https://wp-pagebuilderframework.com/docs/call-to-action-button/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
			);

			foreach ( $premium_features as $premium_feature ) {

				?>

				<li>
					<div class="premium-list-content">
						<h3>
							<?php echo esc_html( $premium_feature['title'] ); ?>
						</h3>
						<div class="tooltip">
							<i class="dashicons dashicons-editor-help"></i>
							<p><?php echo esc_html( $premium_feature['description'] ); ?></p>
						</div>
					</div>
					<div class="premium-list-icon">
						<i class="dashicons dashicons-yes-alt"></i>
					</div>
				</li>

				<?php

			}

		?>

		<li>
			<div class="premium-list-content">
				<h3>
					<strong><?php _e( 'And much more!', 'TheThemeName' ); ?></strong>
				</h3>
				<p>
					<?php _e( 'Check out all the Premium Add-On features.', 'TheThemeName' ); ?>
				</p>
			</div>
			<div class="premium-list-icon">
				<a href="https://wp-pagebuilderframework.com/premium/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName" target="_blank" class="button button-larger button-primary"><?php _e( 'Learn More', 'TheThemeName' ); ?></a>
			</div>
		</li>

	</ul>

</div>
