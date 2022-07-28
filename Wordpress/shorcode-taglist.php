function taglist( $atts )  {
  	extract(shortcode_atts( array( "number" => '0', "show_count" => true, "orderby" => 'name', "order" => "ASC", "hide_empty" => 1, "mincount" => '1' ), $atts ));

  	// set args
	$tags = get_tags(array(
	  'number' => $number,
	  'count' => $show_count,
	  'orderby' => $orderby,
	  'order' => $order,
	  'hide_empty' => $hide_empty,

	));

	if ($tags) {
    	$output .= '<ul class="taglist">';

        foreach ($tags as $tag) {
          if ($tag->count >= $mincount) {
			  $output .= '<li><a href="'. get_term_link($tag).'">'. $tag->name .'</a>';
			  if ($show_count)  $output .= ' (' . $tag->count . ')';
			  $output .= '</li>';
		  }
        }

    	$output .= '</ul>';

 	} else {
 		$output = '<p>No tags found!</p>';
 	}

 	return $output;

}
