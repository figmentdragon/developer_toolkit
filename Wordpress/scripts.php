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
function creativityscripts() {
	$asset_file_path = dirname( __DIR__ ) . '/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	// Register styles & scripts.
	wp_enqueue_style( 'wd_s', get_stylesheet_directory_uri() . '/build/index.css', [], $asset_file['version'] );
	wp_enqueue_script( 'wds-scripts', get_stylesheet_directory_uri() . '/build/index.js', $asset_file['dependencies'], $asset_file['version'], true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'creativityscripts' );

/**
 * Preload styles and scripts.
 *
 * @author WebDevStudios
 */
function creativitypreload_scripts() {
	$asset_file_path = dirname( __DIR__ ) . '/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	?>
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/index.css?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="style">
	<link rel="preload" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/build/index.js?ver=<?php echo esc_html( $asset_file['version'] ); ?>" as="script">
	<?php
}
add_action( 'wp_head', 'creativitypreload_scripts', 1 );

/**
 * Preload assets.
 *
 * @author Corey Collins
 */
function creativitypreload_assets() {
	?>
	<?php if ( creativityget_custom_logo_url() ) : ?>
		<link rel="preload" href="<?php echo esc_url( creativityget_custom_logo_url() ); ?>" as="image">
	<?php endif; ?>
	<?php
}
add_action( 'wp_head', 'creativitypreload_assets', 1 );
