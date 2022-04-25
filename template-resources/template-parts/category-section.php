<?php
global  $themify;
$categories=themify_get_query_categories();
foreach( $categories as $category ) :
    $category = get_term_by( is_numeric( $category ) ? 'id': 'slug', $category, 'category' );
    $cats = get_categories( array( 'include' => isset( $category ) && isset( $category->term_id ) ? $category->term_id : 0, 'orderby' => 'id' ) );

    foreach( $cats as $cat ) :
	    // Query posts action based on global $themify options
	    do_action( 'themify_custom_query_posts', array(
		    'tax_query' => array(
			    array(
				    'taxonomy' => $themify->query_taxonomy,
				    'field' => 'id',
				    'terms' => $cat->cat_ID
			    )
		    )
	    ) );

	    if(have_posts()): ?>

		    <!-- category-section -->
		    <div class="category-section tf_clearfix <?php echo $cat->slug; ?>-category">

			    <h3 class="category-section-title"><a href="<?php echo get_category_link($cat->cat_ID); ?>" title="<?php _e('View more posts', 'themify'); ?>"><?php echo $cat->cat_name; ?></a></h3>
			     <?php 
				themify_loop_output();
				wp_reset_query();
			    ?>

		    </div>
		    <!-- /category-section -->

	    <?php endif; ?>

    <?php endforeach; ?>

<?php endforeach; ?>
<?php // wp reset query will be hooked in FW 

