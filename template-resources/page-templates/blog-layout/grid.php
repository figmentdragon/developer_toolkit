<?php 
/**************************************/
## Grid blog layout
/**************************************/

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$THEMENAME_sidebar = esc_attr(get_theme_mod('THEMENAME_sidebar_position', '2cr'));
$THEMENAME_first_post_full = false;	
?>

<div class="grid-container <?php if($THEMENAME_sidebar == '1c'): ?>grid-no-sidebar <?php else: ?> grid-with-sidebar <?php endif;?> <?php if($THEMENAME_first_post_full && $paged <= 1): ?> grid-with-first <?php else: ?> grid-no-first <?php endif;?>">
	<?php 
		if(have_posts()):
			$counter = 0;
			while(have_posts()): the_post();
				$counter++;
				if($counter == 1 && $paged <= 1 && $THEMENAME_first_post_full):
					get_template_part('inc/theme/layouts/grid/content-first-post');
				else:
					get_template_part('inc/theme/layouts/grid/content');
				endif;
				
			endwhile;
		else:
			get_template_part( 'inc/theme/views/content-none'); 
		endif; 
	?>
</div>