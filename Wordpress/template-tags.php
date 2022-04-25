<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package creativity architect
 */

/**
 * Prints HTML with date information for the current post.
 *
 * @author WebDevStudios
 *
 * @param array $args Configuration args.
 */
function creativitypost_date( $args = [] ) {

	// Set defaults.
	$defaults = [
		'date_text'   => esc_html__( 'Posted on', 'creativityarchitect' ),
		'date_format' => get_option( 'date_format' ),
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );
	?>
	<span class="posted-on">
		<?php echo esc_html( $args['date_text'] . ' ' ); ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_time( $args['date_format'] ) ); ?></time></a>
	</span>
	<?php
}


/**
 * Prints HTML with author information for the current post.
 *
 * @author WebDevStudios
 *
 * @param array $args Configuration args.
 */
function creativitypost_author( $args = [] ) {

	// Set defaults.
	$defaults = [
		'author_text' => esc_html__( 'by', 'creativityarchitect' ),
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	?>
	<span class="post-author">
		<?php echo esc_html( $args['author_text'] . ' ' ); ?>
		<span class="author vcard">
			<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
		</span>
	</span>

	<?php
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 *
 * @author WebDevStudios
 */
function creativityentry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_attr__( ', ', 'creativityarchitect' ) );
		if ( $categories_list && creativitycategorized_blog() ) {

			/* translators: the post category */
			printf( '<span class="cat-links">' . esc_attr__( 'Posted in %1$s', 'creativityarchitect' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_attr__( ', ', 'creativityarchitect' ) );
		if ( $tags_list ) {

			/* translators: the post tags */
			printf( '<span class="tags-links">' . esc_attr__( 'Tagged %1$s', 'creativityarchitect' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_attr__( 'Leave a comment', 'creativityarchitect' ), esc_attr__( '1 Comment', 'creativityarchitect' ), esc_attr__( '% Comments', 'creativityarchitect' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'creativityarchitect' ),
			wp_kses_post( get_the_title( '<span class="screen-reader-text">"', '"</span>', false ) )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Display SVG Markup.
 *
 * @author WebDevStudios
 *
 * @param array $args The parameters needed to get the SVG.
 */
function creativitydisplay_svg( $args = [] ) {
	$kses_defaults = wp_kses_allowed_html( 'post' );

	$svg_args = [
		'svg'   => [
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true, // <= Must be lower case!
			'color'           => true,
			'stroke-width'    => true,
		],
		'g'     => [ 'color' => true ],
		'title' => [
			'title' => true,
			'id'    => true,
		],
		'path'  => [
			'd'     => true,
			'color' => true,
		],
		'use'   => [
			'xlink:href' => true,
		],
	];

	$allowed_tags = array_merge(
		$kses_defaults,
		$svg_args
	);

	echo wp_kses(
		creativityget_svg( $args ),
		$allowed_tags
	);
}

/**
 * Return SVG markup.
 *
 * @author WebDevStudios
 *
 * @param array $args The parameters needed to display the SVG.
 *
 * @return string Error string or SVG markup.
 */
function creativityget_svg( $args = [] ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_attr__( 'Please define default parameters in the form of an array.', 'creativityarchitect' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_attr__( 'Please define an SVG icon filename.', 'creativityarchitect' );
	}

	// Set defaults.
	$defaults = [
		'color'        => '',
		'icon'         => '',
		'title'        => '',
		'desc'         => '',
		'stroke-width' => '',
		'height'       => '',
		'width'        => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Figure out which title to use.
	$block_title = ( $args['title'] ) ? $args['title'] : $args['icon'];

	// Generate random IDs for the title and description.
	$random_number  = wp_rand( 0, 99999 );
	$block_title_id = 'title-' . sanitize_title( $block_title ) . '-' . $random_number;
	$desc_id        = 'desc-' . sanitize_title( $block_title ) . '-' . $random_number;

	// Set ARIA.
	$aria_hidden     = ' aria-hidden="true"';
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="' . $block_title_id . ' ' . $desc_id . '"';
		$aria_hidden     = '';
	}

	// Set SVG parameters.
	$color        = ( $args['color'] ) ? ' color="' . $args['color'] . '"' : '';
	$stroke_width = ( $args['stroke-width'] ) ? ' stroke-width="' . $args['stroke-width'] . '"' : '';
	$height       = ( $args['height'] ) ? ' height="' . $args['height'] . '"' : '';
	$width        = ( $args['width'] ) ? ' width="' . $args['width'] . '"' : '';

	// Start a buffer...
	ob_start();
	?>

	<svg
	<?php
		echo creativityget_the_content( $height ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
		echo creativityget_the_content( $width ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
		echo creativityget_the_content( $color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
		echo creativityget_the_content( $stroke_width ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
	?>
		class="icon <?php echo esc_attr( $args['icon'] ); ?>"
	<?php
		echo creativityget_the_content( $aria_hidden ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
		echo creativityget_the_content( $aria_labelledby ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
	?>
		role="img">
		<title id="<?php echo esc_attr( $block_title_id ); ?>">
			<?php echo esc_html( $block_title ); ?>
		</title>

		<?php
		// Display description if available.
		if ( $args['desc'] ) :
			?>
			<desc id="<?php echo esc_attr( $desc_id ); ?>">
				<?php echo esc_html( $args['desc'] ); ?>
			</desc>
		<?php endif; ?>

		<?php
		// Use absolute path in the Customizer so that icons show up in there.
		if ( is_customize_preview() ) :
			?>
			<use xlink:href="<?php echo esc_url( get_parent_theme_file_uri( '/build/images/icons/sprite.svg#' . esc_html( $args['icon'] ) ) ); ?>"></use>
		<?php else : ?>
			<use xlink:href="#<?php echo esc_html( $args['icon'] ); ?>"></use>
		<?php endif; ?>

	</svg>

	<?php
	// Get the buffer and return.
	return ob_get_clean();
}

/**
 * Trim the title length.
 *
 * @author WebDevStudios
 *
 * @param array $args Parameters include length and more.
 *
 * @return string The title.
 */
function creativityget_the_title( $args = [] ) {
	// Set defaults.
	$defaults = [
		'length' => 12,
		'more'   => '...',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the title.
	return wp_kses_post( wp_trim_words( get_the_title( get_the_ID() ), $args['length'], $args['more'] ) );
}

/**
 * Limit the excerpt length.
 *
 * @author WebDevStudios
 *
 * @param array $args Parameters include length and more.
 *
 * @return string The excerpt.
 */
function creativityget_the_excerpt( $args = [] ) {

	// Set defaults.
	$defaults = [
		'length' => 20,
		'more'   => '...',
		'post'   => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the excerpt.
	return wp_trim_words( get_the_excerpt( $args['post'] ), absint( $args['length'] ), esc_html( $args['more'] ) );
}

/**
 * Echo the copyright text saved in the Customizer.
 *
 * @author WebDevStudios
 */
function creativitydisplay_copyright_text() {
	// Grab our customizer settings.
	$copyright_text = get_theme_mod( 'creativitycopyright_text' );

	if ( $copyright_text ) {
		echo creativityget_the_content( do_shortcode( $copyright_text ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
	}
}

/**
 * Display the social links saved in the customizer.
 *
 * @author WebDevStudios
 */
function creativitydisplay_social_network_links() {
	// Create an array of our social links for ease of setup.
	// Change the order of the networks in this array to change the output order.
	$social_networks = [
		'facebook',
		'instagram',
		'linkedin',
		'twitter',
	];

	?>
	<ul class="flex social-icons menu">
		<?php
		// Loop through our network array.
		foreach ( $social_networks as $network ) :

			// Look for the social network's URL.
			$network_url = get_theme_mod( 'creativity' . $network . '_link' );

			// Only display the list item if a URL is set.
			if ( ! empty( $network_url ) ) :
				?>
				<li class="social-icon <?php echo esc_attr( $network ); ?> mr-2">
					<a href="<?php echo esc_url( $network_url ); ?>">
						<?php
						creativitydisplay_svg(
							[
								'icon'   => $network . '-square',
								'width'  => '24',
								'height' => '24',
							]
						);
						?>
						<span class="screen-reader-text">
						<?php
						/* translators: the social network name */
						printf( esc_attr__( 'Link to %s', 'creativityarchitect' ), ucwords( esc_html( $network ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
						?>
						</span>
					</a>
				</li><!-- .social-icon -->
				<?php
			endif;
		endforeach;
		?>
	</ul><!-- .social-icons -->
	<?php
}

/**
 * Displays numeric pagination on archive pages.
 *
 * @author WebDevStudios
 *
 * @param array    $args  Array of params to customize output.
 * @param WP_Query $query The Query object; only passed if a custom WP_Query is used.
 */
function creativitydisplay_numeric_pagination( $args = [], $query = null ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Make the pagination work on custom query loops.
	$total_pages = isset( $query->max_num_pages ) ? $query->max_num_pages : 1;

	// Set defaults.
	$defaults = [
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'mid_size'  => 4,
		'total'     => $total_pages,
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	if ( null === paginate_links( $args ) ) {
		return;
	}
	?>

	<nav class="container pagination-container" aria-label="<?php esc_attr_e( 'numeric pagination', 'creativityarchitect' ); ?>">
		<?php echo paginate_links( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK. ?>
	</nav>

	<?php
}

/**
 * Displays the mobile menu with off-canvas background layer.
 *
 * @author WebDevStudios
 *
 * @return string An empty string if no menus are found at all.
 */
function creativitydisplay_mobile_menu() {
	// Bail if no mobile or primary menus are set.
	if ( ! has_nav_menu( 'mobile' ) && ! has_nav_menu( 'primary' ) ) {
		return '';
	}

	// Set a default menu location.
	$menu_location = 'primary';

	// If we have a mobile menu explicitly set, use it.
	if ( has_nav_menu( 'mobile' ) ) {
		$menu_location = 'mobile';
	}
	?>
	<div class="off-canvas-screen"></div>
	<nav class="off-canvas-container" aria-label="<?php esc_attr_e( 'Mobile Menu', 'creativityarchitect' ); ?>" aria-hidden="true" tabindex="-1">
		<?php
		// Mobile menu args.
		$mobile_args = [
			'theme_location'  => $menu_location,
			'container'       => 'div',
			'container_class' => 'off-canvas-content',
			'container_id'    => '',
			'menu_id'         => 'site-mobile-menu',
			'menu_class'      => 'mobile-menu',
			'fallback_cb'     => false,
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		];

		// Display the mobile menu.
		wp_nav_menu( $mobile_args );
		?>
	</nav>
	<?php
}

/**
 * Display the comments if the count is more than 0.
 *
 * @author WebDevStudios
 */
function creativitydisplay_comments() {
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}
