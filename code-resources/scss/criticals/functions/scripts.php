<?php
/**
 * Custom scripts and styles.
 *
 * @package creativity architect
 */

/**
 * Enqueue scripts and styles.
 *
 * @author WebDevStudios
 */
function core_scripts() {
	// Register styles & scripts.
	wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/source/core/core.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'core_scripts' );

/**
 * Preload styles and scripts.
 *
 * @author WebDevStudios
 */
function core_preload_scripts() {
	$asset_file_path = dirname( __DIR__ ) . '/source/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	?>
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/source/build/index.css?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="style">
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/source/build/index.js?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="script">
	<?php
}
add_action( 'wp_head', 'core_preload_scripts', 1 );

/**
 * Preload assets.
 *
 * @author Corey Collins
 */
function core_preload_assets() {
	?>
	<?php if ( core_get_custom_logo_url() ) : ?>
		<link rel="preload" href="<?php echo esc_url( core_get_custom_logo_url() ); ?>" as="image">
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'core_preload_assets', 1 );
