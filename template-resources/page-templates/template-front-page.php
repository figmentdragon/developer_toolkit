<?php /* Template Name: Front Page */ ?>

<?php /**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package the creativity architect
 */ ?>

<?php get_header(); ?>

<body <?php body_class(); ?> id="front-page">
 <div class="site container">

   <section class="masthead">
     <p id="page-title">
       <?php the_ID();?>
     </p>
   </section>
  <div class="page">

  <main class="main fluid" id="main" role="main">
        <div class="container">
            <header class="site-header right-shadow right-shadow:before" id="secondary">
              <section class="nameplate">
                <p id="author-name">
                  <?php get_the_author_meta('display_name'); ?>
                </p>
                <p id="site-title">
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </p>
                <p id="site-description">
                  <?php bloginfo( 'description' ); ?>
                </p>
              </section>



              </header>

              <?php the_content(); ?>

        </div>
        <?php get_footer(); ?>
    </main>

  </div>


  </body>
</html>
