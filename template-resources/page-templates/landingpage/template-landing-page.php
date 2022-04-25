<?php /* Template Name: Landing Page */ ?>

<!-- The template for displaying the Front Page, modified to be a Landing Page. -->

<?php get_header(); ?>

<main class="<?php post_class(); ?>" id="<?php post_type(); ?>">
	<div id="main" class="row-fluid">
		<div id="primary" class="row-fluid">
			<div id="content" role="main" class="contentwrapper">
				<?php the_content(); ?>
					<div id="slider" class="wrapper">
						<article id="content">
							<?php get_template_part( 'template-parts/landingpage/section-slider' ); ?>
				</article>
			</div>
		</section>

	<section id="main">
			<section id="primary" class="contentwrapper">
				<div id="about" class="wrapper">
					<article id="content">
						<?php get_template_part( 'template-parts/landingpage/section-about' ); ?>
				</article>
			</div>
		</section>

	<section id="main">
					<section id="primary" class="contentwrapper">
				<div id="featured" class="wrapper">
					<article id="content">
						<?php get_template_part( 'template-parts/landingpage/section-featured' ); ?>
				</article>
			</div>
		</section>

	<section id="main">
					<section id="primary">
				<div id="blog" class="wrapper">
					<article id="content">
						<?php get_template_part( 'template-parts/landingpage/section-blog' ); ?>
				</article>
			</div>
		</section>

	<section id="main">
					<section id="primary" class="contentwrapper">
				<div id="services" class="wrapper">
					<article id="content">
						<?php get_template_part( 'template-parts/landingpage/section-service' ); ?>
				</article>
			</div>
		</section>

	<section id="main">
					<section id="primary" class="contentwrapper">
				<div id="tesimonial" class="wrapper">
					<article id="content">
						<?php get_template_part( 'template-parts/landingpage/section-testimonial' ); ?>
				</article>
			</div>
		</section>

	<section id="main">
					<section id="primary" class="contentwrapper">
				<div id="contact" class="wrapper">
					<article id="content">
						<?php get_template_part( 'template-parts/landingpage/section-cta' ); ?>
				</article>
			</div>
		</section>
		<section>
		</main>

	<?php get_footer(); ?>

	</body>
	</html>
