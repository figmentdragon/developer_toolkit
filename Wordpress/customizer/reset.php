<?php
/**
 * Reset Theme Options
 *
 * @package themename
 */

if ( ! class_exists( 'themename_Customizer_Reset' ) ) {
	/**
	 * Adds Reset button to customizer
	 */
	final class themename_Customizer_Reset {
		/**
		 * @var themename_Customizer_Reset
		 */
		private static $instance = null;

		/**
		 * @var WP_Customize_Manager
		 */
		private $wp_customize;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'customize_controls_print_scripts' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
		}

		public function customize_controls_print_scripts() {
			$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			$path = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'assets/js/source/' : 'assets/js/';

			wp_enqueue_script( 'themename-customizer-reset', get_theme_file_uri( $path . 'customizer-reset' . $min . '.js' ), array( 'jquery' ), '20190207', true );
			
			wp_localize_script( 'themename-customizer-reset', 'themenameCustomizerReset', array(
				'reset'          => esc_html__( 'Reset', 'themename' ),
				'confirm'        => esc_html__( "Caution: Reset all settings to default. Process is irreversible.", 'themename' ),
				'nonce'          => array(
					'reset' => wp_create_nonce( 'themename-customizer-reset' ),
				),
				'resetSection'   => esc_html__( 'Reset section', 'themename' ),
				'confirmSection' => esc_html__( "Caution: Reset section settings to default. Process is irreversible.", 'themename' ),
			) );
		}

		/**
		 * Store a reference to `WP_Customize_Manager` instance
		 *
		 * @param $wp_customize
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		public function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'themename-customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

			if ( 'all' === $_POST['section'] ) {
				$this->reset_customizer();
			}

			wp_send_json_success();
		}

		public function reset_customizer() {
			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}

themename_Customizer_Reset::get_instance();
