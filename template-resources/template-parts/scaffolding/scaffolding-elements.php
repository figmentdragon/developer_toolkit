<?php
/**
 * The template used for displaying generic elements in the scaffolding library.
 *
 * @package creativity architect
 */

?>

<section class="section-scaffolding">

	<h2 class="scaffolding-heading"><?php esc_html_e( 'Generic Elements', 'creativityarchitect' ); ?></h2>

	<?php
	// Right-aligned Image.
	ca_display_scaffolding_section(
		[
			'title'       => 'Numeric Pagination',
			'description' => 'Display numeric pagination.',
			'usage'       => 'ca_display_numeric_pagination()',
			'output'      => '
				<nav class="pagination-container">
					<a class="prev page-numbers" href="#>&laquo;</a>
					<a class="page-numbers" href="#">1</a>
					<span aria-current="page" class="page-numbers current">2</span>
					<a class="page-numbers" href="#">3</a>
					<a class="next page-numbers" href="#">&raquo;</a>
				</nav>
			',
		]
	);

	?>
</section>
