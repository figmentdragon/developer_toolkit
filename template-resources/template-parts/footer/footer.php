<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

</main><!-- / end page container, begun in the header -->

<footer class="site-footer">
	<div class="widget-wrapper">
		<nav class="site-navigation" id="menu-1">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_id'        => 'menu-1', ) ); ?>
		</nav>
	</div>

		<div class="site-info container" id="copyright">
			<p> Based on starter themes: <a href="http://bckmn.com/naked-wordpress" rel="theme">Naked</a> ,
				<a href="http://undescores.me"> Underscores</a>,
				and <a href="https://themble.com/bones/"> Bones</a>
			on <a href="http://wordpress.org" rel="generator">Wordpress</a>. |
			All works are &copy; CJMTermini & THEME; unless stated <a href="/#citations">otherwise</a>.
		</p>

	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer();
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website.
// Removing this fxn call will disable all kinds of plugins.
// Move it if you like, but keep it around.
?>

</body>
</html>
