<?php
/**
 * Theme Customizer Fonts
 *
 * @package 	Customizer_Library
 * @author		The Theme Foundry
 */

if ( ! function_exists( 'customizer_library_get_font_choices' ) ) :
/**
 * Packages the font choices into value/label pairs for use with the customizer.
 *
 * @since  1.0.0.
 *
 * @return array    The fonts in value/label pairs.
 */
function customizer_library_get_all_fonts() {
	$default       = array( 1 => array( 'label' => sprintf( '--- %s ---', __( 'Default', 'writing' ) ) ), 'writing_font' => array( 'label' => __( 'Lora', 'writing' ) )  );
	$heading1       = array( 1 => array( 'label' => sprintf( '--- %s ---', __( 'Standard Fonts', 'writing' ) ) ) );
	$standard_fonts = customizer_library_get_standard_fonts();
	$heading2       = array( 2 => array( 'label' => sprintf( '--- %s ---', __( 'Google Fonts', 'writing' ) )) );
	$google_fonts   = customizer_library_get_google_fonts();

	/**
	 * Allow for developers to modify the full list of fonts.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $fonts    The list of all fonts.
	 */
	return apply_filters( 'customizer_library_all_fonts', array_merge( $default, $heading1, $standard_fonts, $heading2, $google_fonts ) );
}
endif;

if ( ! function_exists( 'customizer_library_get_font_choices' ) ) :
/**
 * Packages the font choices into value/label pairs for use with the customizer.
 *
 * @since  1.0.0.
 *
 * @return array    The fonts in value/label pairs.
 */
function customizer_library_get_font_choices() {
	$fonts   = customizer_library_get_all_fonts();
	$choices = array();

	// Repackage the fonts into value/label pairs
	foreach ( $fonts as $key => $font ) {
		if (isset($font['subsets'])) {
			$subsets = " (" . implode(', ', $font['subsets']) . ")";
		} else {
			$subsets = "";
		}
		$choices[ $key ] = $font['label'] . $subsets;
	}

	return $choices;
}
endif;

if ( ! function_exists( 'customizer_library_get_google_font_uri' ) ) :
/**
 * Build the HTTP request URL for Google Fonts.
 *
 * @since  1.0.0.
 *
 * @return string    The URL for including Google Fonts.
 */
function customizer_library_get_google_font_uri( $fonts ) {

	// De-dupe the fonts
	$fonts         = array_unique( $fonts );
	$allowed_fonts = customizer_library_get_google_fonts();
	$family        = array();

	// Validate each font and convert to URL format
	foreach ( $fonts as $font ) {
		$font = trim( $font );

		// Verify that the font exists
		if ( array_key_exists( $font, $allowed_fonts ) ) {
			// Build the family name and variant string (e.g., "Open+Sans:regular,italic,700")
			$family[] = urlencode( $font . ':' . join( ',', customizer_library_choose_google_font_variants( $font, $allowed_fonts[ $font ]['variants'] ) ) );
		}
	}

	// Convert from array to string
	if ( empty( $family ) ) {
		return '';
	} else {
		$request = '//fonts.googleapis.com/css?family=' . implode( '|', $family ) . '&display=swap';
	}

	// Load the font subset
	$subset = get_theme_mod( 'themename_font_subset' );
	if (!empty($subsets)) {
		if (!is_array($subset)) {
			$subset = explode(",", $subset);
		}
	} else {
		$subset = array('latin');
	}

	if ( in_array('all', $subset) ) {
		$subsets_available = customizer_library_get_google_font_subsets();

		// Remove the all set
		unset( $subsets_available['all'] );

		// Build the array
		$subsets = $subsets_available;
	} else {
		if (!is_array($subset)) {
			$subsets = explode(",", $subset);
		}
	}

	// Append the subset string
	if ( ! empty( $subsets ) ) {
		$request .= urlencode( '&subset=' . join( ',', $subsets ) );
	}

	return esc_url( $request );
}
endif;

if ( ! function_exists( 'customizer_library_get_google_font_subsets' ) ) :
/**
 * Retrieve the list of available Google font subsets.
 *
 * @since  1.0.0.
 *
 * @return array    The available subsets.
 */
function customizer_library_get_google_font_subsets() {
	return array(
		'all',
		"latin",
		"latin-ext",
		"vietnamese",
		"cyrillic",
		"cyrillic-ext",
		"devanagari",
		"greek",
		"greek-ext",
		"korean",
		"thai",
		"khmer",
		"arabic",
		"telugu",
		"hebrew",
		"chinese-simplified",
		"gujarati",
		"tamil",
		"japanese",
		"bengali",
		"malayalam",
		"chinese-traditional",
		"gurmukhi",
		"chinese-hongkong",
		"kannada",
		"myanmar",
		"oriya",
		"sinhala",
		"tibetan"
	);
}
endif;

if ( ! function_exists( 'customizer_library_choose_google_font_variants' ) ) :
/**
 * Given a font, chose the variants to load for the theme.
 *
 * Attempts to load regular, italic, and 700. If regular is not found, the first variant in the family is chosen. italic
 * and 700 are only loaded if found. No fallbacks are loaded for those fonts.
 *
 * @since  1.0.0.
 *
 * @param  string    $font        The font to load variants for.
 * @param  array     $variants    The variants for the font.
 * @return array                  The chosen variants.
 */
function customizer_library_choose_google_font_variants( $font, $variants = array() ) {
	$chosen_variants = array();
	if ( empty( $variants ) ) {
		$fonts = customizer_library_get_google_fonts();

		if ( array_key_exists( $font, $fonts ) ) {
			$variants = $fonts[ $font ]['variants'];
		}
	}

	// If a "regular" variant is not found, get the first variant
	if ( ! in_array( 'regular', $variants ) ) {
		$chosen_variants[] = $variants[0];
	} else {
		$chosen_variants[] = 'regular';
	}

	// Only add "italic" if it exists
	if ( in_array( 'italic', $variants ) ) {
		$chosen_variants[] = 'italic';
	}

	// Only add "700" if it exists
	if ( in_array( '700', $variants ) ) {
		$chosen_variants[] = '700';
	}

	return apply_filters( 'customizer_library_font_variants', array_unique( $chosen_variants ), $font, $variants );
}
endif;

if ( ! function_exists( 'customizer_library_get_standard_fonts' ) ) :
/**
 * Return an array of standard websafe fonts.
 *
 * @since  1.0.0.
 *
 * @return array    Standard websafe fonts.
 */
function customizer_library_get_standard_fonts() {
	return array(
		'serif' => array(
			'label' => _x( 'Serif', 'font style', 'writing' ),
			'stack' => 'Georgia,Times,"Times New Roman",serif'
		),
		'sans-serif' => array(
			'label' => _x( 'Sans Serif', 'font style', 'writing' ),
			'stack' => '"Helvetica Neue",Helvetica,Arial,sans-serif'
		),
		'monospace' => array(
			'label' => _x( 'Monospaced', 'font style', 'writing' ),
			'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'
		)
	);
}
endif;

if ( ! function_exists( 'customizer_library_get_font_stack' ) ) :
/**
 * Validate the font choice and get a font stack for it.
 *
 * @since  1.0.0.
 *
 * @param  string    $font    The 1st font in the stack.
 * @return string             The full font stack.
 */
function customizer_library_get_font_stack( $font ) {

	$all_fonts = customizer_library_get_all_fonts();

	// Sanitize font choice

	$sans = '"Helvetica Neue",sans-serif';
	$serif = 'Georgia, serif';

	// Use stack if one is identified
	if ( isset( $all_fonts[ $font ]['stack'] ) && ! empty( $all_fonts[ $font ]['stack'] ) ) {
		$stack = $all_fonts[ $font ]['stack'];
	} else {
		$stack = '"' . $font . '",' . $sans;
	}

	return $stack;
}
endif;

if ( ! function_exists( 'customizer_library_sanitize_font_choice' ) ) :
/**
 * Sanitize a font choice.
 *
 * @since  1.0.0.
 *
 * @param  string    $value    The font choice.
 * @return string              The sanitized font choice.
 */
function customizer_library_sanitize_font_choice( $value ) {
	if ( is_int( $value ) ) {
		// The array key is an integer, so the chosen option is a heading, not a real choice
		return '';
	} else if ( array_key_exists( $value, customizer_library_get_font_choices() ) ) {
		return $value;
	} else {
		return '';
	}
}
endif;

if ( ! function_exists( 'customizer_library_get_google_fonts' ) ) :
/**
 * Return an array of all available Google Fonts.
 *
 * @since  1.0.0.
 *
 * @return array    All Google Fonts.
 */
function customizer_library_get_google_fonts() {

	global $google_fonts_array;
	$decoded_google_fonts = json_decode($google_fonts_array, true);
	$webfonts = array();
	foreach ($decoded_google_fonts['items'] as $key => $value) {
		$add_font = false;
		$subsets = themename_option('themename_font_subset');
		if (!empty($subsets)) {
			if (!is_array($subsets)) {
				$subsets = explode(',', $subsets);
			}
		} else {
			$subsets = array('latin');
		}

		if (is_array($subsets) && !in_array('all', $subsets)) {
			if (array_intersect($decoded_google_fonts['items'][$key]['subsets'], $subsets)) {
				$add_font = true;
			}
		} else {
			$add_font = true;
		}
		if ($add_font) {
			$font_family = $decoded_google_fonts['items'][$key]['family'];
			$webfonts[$font_family] = array();
			$webfonts[$font_family]['label'] = $font_family;
			$webfonts[$font_family]['variants'] = $decoded_google_fonts['items'][$key]['variants'];
			$webfonts[$font_family]['subsets'] = $decoded_google_fonts['items'][$key]['subsets'];
		}
	}

	return apply_filters( 'customizer_library_get_google_fonts', $webfonts );
}
endif;