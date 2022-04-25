<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
	<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'chique' ); ?>">
		<?php
			wp_nav_menu( array(
					'container'      => '',
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu nav-menu',
				)
			);
		?>
<?php else : ?>

	<nav id="site-navigation" class="main-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'chique' ); ?>">
		<?php wp_page_menu(
			array(
				'menu_class' => 'primary-menu-container',
				'before'     => '<ul id="primary-menu" class="menu nav-menu">',
				'after'      => '</ul>',
			)
		); ?>

<?php endif; ?>

	</nav><!-- .main-navigation -->
