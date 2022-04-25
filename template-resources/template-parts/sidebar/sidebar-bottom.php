<?php
/**
 * For displaying the bottom sidebar
 * @package creativity
*/

	// If no active sidebars - then load nothing
	if (   ! is_active_sidebar( 'bottom1'  )
	&& ! is_active_sidebar( 'bottom2' )
	&& ! is_active_sidebar( 'bottom3'  )		
	&& ! is_active_sidebar( 'bottom4'  )	
	)
	return;	
?>


<aside id="bottom-sidebar-wrapper">
	<div id="bottom-sidebar" class="widget-area grid-container">
		 
		<?php if ( is_active_sidebar( 'bottom1' ) ) : ?>
			<div id="bottom1" class="sidebar-column">
				<?php dynamic_sidebar( 'bottom1' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'bottom2' ) ) : ?>      
			<div id="bottom2" class="sidebar-column">
				<?php dynamic_sidebar( 'bottom2' ); ?>
			</div>         
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'bottom3' ) ) : ?>        
			<div id="bottom3" class="sidebar-column">
				<?php dynamic_sidebar( 'bottom3' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'bottom4' ) ) : ?>        
			<div id="bottom4" class="sidebar-column">
				<?php dynamic_sidebar( 'bottom4' ); ?>
			</div>
		<?php endif; ?>	
		
	</div>
</aside>         