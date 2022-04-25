<?php if ( is_single() ) { ?>
<nav>
	<div><?php previous_post_link('&laquo; %link') ?></div>
	<div><?php next_post_link('%link &raquo;') ?></div>
</nav>
<?php } else { ?>
<nav>
	<div><?php next_posts_link('&laquo; Older Entries') ?></div>
	<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</nav>
<?php } // end of is_single() ?>