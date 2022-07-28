<?php
/**
 * Metabox template for displaying documentation links.
 *
 * @package TheThemeName
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );
?>

<div class="documentation-metabox">

	<div class="documentation-boxes">

		<?php

			$docs_boxes = array(
				array(
					'icon'    => 'dashicons-book-alt',
					'title'   => __( 'Documentation', 'TheThemeName' ),
					'content' => __( 'Not sure how something works? <br><br> Our extensive Documentation is a great place to get started and learn more about TheThemeName.', 'TheThemeName' ),
					'link'    => 'https://wp-pagebuilderframework.com/docs/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'icon'    => 'dashicons-admin-users',
					'title'   => __( 'Community', 'TheThemeName' ),
					'content' => __( 'Did you know? There is a Facebook Community of TheThemeName users, just like you! <br><br> Join the community and meet 1500+ TheThemeName users.', 'TheThemeName' ),
					'link'    => 'https://www.facebook.com/groups/wpagebuilderframework/',
				),
				array(
					'icon'    => 'dashicons-download',
					'title'   => __( 'Child Theme', 'TheThemeName' ),
					'content' => __( 'Are you planning to make code changes to your website? We\'ve got you covered! <br><br> Download the TheThemeName child theme or generate your own, white labeled version of it.', 'TheThemeName' ),
					'link'    => 'https://wp-pagebuilderframework.com/child-theme-generator/?utm_source=repository&utm_medium=theme_settings&utm_campaign=TheThemeName',
				),
				array(
					'icon'    => 'dashicons-sos',
					'title'   => __( 'Support Forum', 'TheThemeName' ),
					'content' => __( 'Any questions? Don\'t hesitate to reach out! <br><br> Post your question in the official WordPress support forum and we will help you out asap!', 'TheThemeName' ),
					'link'    => 'https://wordpress.org/support/theme/TheThemeName/',
				),
			);

			foreach ( $docs_boxes as $docs_box ) {

				?>

				<div class="heatbox">
					<h2>
						<a href="<?php echo esc_url( $docs_box['link'] ); ?>" target="_blank">
							<span class="dashicons <?php echo esc_attr( $docs_box['icon'] ); ?>"></span> <?php echo esc_html( $docs_box['title'] ); ?>
						</a>
					</h2>
					<div class="heatbox-content">
						<div class="documentation-content">
							<p>
								<?php echo $docs_box['content']; ?>
							</p>
							<a href="<?php echo esc_url( $docs_box['link'] ); ?>" target="_blank" class="button button-primary button-larger">
								<?php echo esc_html( $docs_box['title'] ); ?>
							</a>
						</div>
					</div>
				</div>

				<?php

			}

		?>

	</div>

</div>
