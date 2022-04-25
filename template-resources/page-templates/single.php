<?php get_header(); ?>

	<main role="main" aria-label="Content">
	<!-- section -->
	<section>

	<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); // Fullsize image for the single post. ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- /post title -->

			<!-- post details -->
			<span class="date">
				<time datetime="<?php the_time( 'Y-m-d' ); ?> <?php the_time( 'H:i' ); ?>">
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
			</span>
			<span class="author"><?php esc_html_e( 'Published by', 'THEMENAME' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php if ( comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'THEMENAME' ), __( '1 Comment', 'THEMENAME' ), __( '% Comments', 'THEMENAME' ) ); ?></span>
			<!-- /post details -->

			<?php the_content(); // Dynamic Content. ?>

			<?php the_tags( __( 'Tags: ', 'THEMENAME' ), ', ', '<br>' ); // Separated by commas with a line break at the end. ?>

			<p><?php esc_html_e( 'Categorised in: ', 'THEMENAME' ); the_category( ', ' ); // Separated by commas. ?></p>

			<p><?php esc_html_e( 'This post was written by ', 'THEMENAME' ); the_author(); ?></p>

			<?php edit_post_link(); // Always handy to have Edit Post Links available. ?>

			<?php comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else : ?>

		<!-- article -->
		<article>

			<h1><?php esc_html_e( 'Sorry, nothing to display.', 'THEMENAME' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
