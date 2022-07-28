<?php
/**
 * Upgrade Control for the Customizer
 * @package creativity_
*
 * Control type.
 * For Upsell content in the customizer
 */
 
// Displays the upgrade teasers in thhe Pro Version / More Features section.
if ( class_exists( 'WP_Customize_Control' ) ) {
	
	class creativity_Customize_Static_Text_Control extends WP_Customize_Control {
		// Render Control
		public function render_content() {
	?>

    <div class="upgrade-pro-version">		

    <p class="rp-pro-heading"><?php esc_html_e('creativity_ Pro - Save $10', 'creativity') ?></p>
    <p class="rp-discount"><?php esc_html_e('Save $10 (Limited Time Offer!) if you purchase the Pro version with this discount code on checkout:', 'creativity') ?>
        <span class="rp-discount-code"><?php esc_html_e('creativity_10', 'creativity') ?></span></p>
    <p class="rp-pro-title"><?php esc_html_e('Pro Features:', 'creativity') ?></p>

		
			<ul class="rp-pro-list">
				<li><?php esc_html_e('&bull; 5 Blog Styles', 'creativity')?></li>
				<li><?php esc_html_e('&bull; 10 Dynamic Sidebar Positions', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Add Multiple Splash Page Images', 'creativity')?></li>
				<li><?php esc_html_e('&bull; 3 Full Post Layouts', 'creativity')?></li>
				<li><?php esc_html_e('&bull; 5 Menu Locations', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Thumbnail Creation for the Blogs', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Recent Posts Widget w/thumbnails', 'creativity')?></li>				
				<li><?php esc_html_e('&bull; An About Me Widget', 'creativity')?></li>
				<li><?php esc_html_e('&bull; A Social Links Widget', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Customize the Read More Button Text', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Custom Styled Archive Titles', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Custom Styled WordPress Login Page', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Add a Custom Blog Title with Introduction', 'creativity')?></li>
				<li><?php esc_html_e('&bull; We Made the Customizer Look Better', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Show or Hide the Featured Post Label', 'creativity')?></li>
				<li><?php esc_html_e('&bull; Premium Support', 'creativity')?></li>
			</ul>

    <p><a class="rp-get-pro button" href="<?php echo esc_url('https://www.roughpixels.com/blogging-themes/creativity/'); ?>" target="_blank"><?php esc_html_e( 'Go Pro Now', 'creativity' ); ?></a></p>			

    </div>

    <?php
		}
	}
}
