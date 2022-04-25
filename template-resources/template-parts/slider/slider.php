<?php 
/************************************************************/
## Slider section for home page.
/***********************************************************/

$slider_status = esc_attr(get_theme_mod('TheCreativityArchitect_slider_enable', 'enable'));

if( $slider_status == 'enable'):

	$slider_meta_status  = esc_attr(get_theme_mod('TheCreativityArchitect_slider_content_meta', 'enable'));
	$posts_per_page      = esc_attr(get_theme_mod('TheCreativityArchitect_slider_posts', '5'));
	$slider_content_type = esc_attr(get_theme_mod('TheCreativityArchitect_slider_content', 'category'));
		
	if($slider_content_type == 'category'){
		$slider_post_cats = esc_attr(get_theme_mod('TheCreativityArchitect_slider_post_cats'));
		if($slider_post_cats != ''){
			$categories = explode(',',$slider_post_cats);
		}else{
			$categories = '';
		}
		
		$TheCreativityArchitect_slider_args = array(
			'post_type'    => 'post',
			'category__in' => $categories,
			'meta_query'   => array(
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
			),
			'ignore_sticky_posts' => true,
			'posts_per_page'         => $posts_per_page,
			'orderby'                => 'date',
			'order'                  => 'DESC',
		);
		
	} else {
		$TheCreativityArchitect_slider_args = array(
			'post_type' => 'post',
			'meta_query' => array(
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
			),
			
			'posts_per_page'         => $posts_per_page,
			'orderby'                => 'date',
			'order'                  => 'DESC'
		);
	}
	
	$TheCreativityArchitect_slider_data = new WP_Query($TheCreativityArchitect_slider_args);
	
	if($TheCreativityArchitect_slider_data->have_posts()):
	
	$slider_display_type = esc_attr(get_theme_mod('TheCreativityArchitect_slider_display_type'));
?>
	<div class="site-banner<?php if( $slider_display_type == 'fluid'){ ?> banner-fluid<?php }else{ ?> banner-non-fluid<?php }?>">
        <div class="<?php if($slider_display_type == 'fluid') { ?>site-container-fluid no-padding <?php } else{ ?> site-container <?php }?> ">
            <div class="site-row">
                <div class="site-column-12">
					<div class="site-banner-carousel" id="site-banner-carousel">
						<?php  
						$TheCreativityArchitect_slider_counter=0;
						
						while($TheCreativityArchitect_slider_data->have_posts()): 
						$TheCreativityArchitect_slider_data->the_post(); 
						if(has_post_thumbnail()) : 
						$src =  wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID()), 'TheCreativityArchitect-slider');
						
						$TheCreativityArchitect_slider_counter++;
						
						?>
						<div class="banner-item">
							<div class="banner-media" style="<?php echo 'background-image:url('. $src[0].')'; ?>">
							</div>
							
							<div class="banner-text">
								<div class="site-container">
									<?php if($slider_meta_status == 'enable'): ?>
										<span class="banner-text-cat"><?php the_category(',') ?></span>
									<?php endif; ?>
									<?php the_title( '<h2 class="banner-text-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ) ?>
									<?php if($slider_meta_status == 'enable'): ?>
										<span class="banner-text-author"><?php echo __('By', 'TheCreativityArchitect') ?> <?php the_author_posts_link() ?></span>
									<?php endif; ?>
									
								</div>
							</div>
						</div>
						
						<?php endif; endwhile;	?>
					</div>
                </div>
            </div>
        </div>
    </div>
	
<?php wp_reset_postdata(); endif; /* have_posts() */ endif; ?>