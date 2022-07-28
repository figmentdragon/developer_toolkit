<!--The area inside the while loop could be anything, that’s just some example typical inside-loop code. The trick is the first line, and the cat=-3 parameter. -3 in this case is the ID of the category, and you can replace that with any category you wish to remove from the loop. You may use comma separated values here to remove more than one category (e.g. cat=-1,-2).-->

<?php query_posts('cat=-3'); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
  <h3></h3>
  <p><?php the_time('F jS, Y') ?></p>
  <?php the_content(); ?>
<?php endwhile; ?>
