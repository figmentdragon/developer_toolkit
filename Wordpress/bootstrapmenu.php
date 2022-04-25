<?php

/* Bootstrap_Walker for Wordpress
 * Author: George Huger, Illuminati Karate, Inc
 * More Info: http://illuminatikarate.com/blog/bootstrap-walker-for-wordpress
 *
 * Formats a Wordpress menu to be used as a Bootstrap dropdown menu (http://getbootstrap.com).
 *
 * Specifically, it makes these changes to the normal Wordpress menu output to support Bootstrap:
 *
 *        - adds a 'dropdown' class to level-0 <li>'s which contain a dropdown
 *         - adds a 'dropdown-submenu' class to level-1 <li>'s which contain a dropdown
 *         - adds the 'dropdown-menu' class to level-1 and level-2 <ul>'s
 *
 * Supports menus up to 3 levels deep.
 *
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
	     * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if (strcasecmp($item->attr_title, 'disabled') == 0) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		}
                else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if($args->has_children && $depth === 0) { $class_names .= ' dropdown'; }
                        elseif($args->has_children && $depth > 0) { $class_names .= ' dropdown-submenu'; }


            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            /************************ Start themename mega menu options ***********************/
            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            $check_mega_menu = "";
            if($depth === 0 && $item->megamenu != ''){
                $class_names .= ' mega_menu';
                $class_names .= ' mega_menu_'.$item->megamenu;
            }else{
            	$class_names .= ' default_menu';
            }

            if ($depth === 0 && $item->cols_nums ){
            	$class_names .= ' '.$item->cols_nums;
            }

            if($depth === 1 && $item->menutitle != ''){
                $class_names .= ' menu_title';
                $class_names .= ' menu_title'.$item->menutitle;
            }

            if($depth > 0 && $item->columntype == "text") {
            	$class_names .= ' text_mega_menu';
            }

            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/
            /************************  end themename mega menu options  ***********************/
            /*******************************************************************************/
            /*******************************************************************************/
            /*******************************************************************************/

			if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';
			if($depth > 0 && $item->columntype == "text") {
				$output .= do_shortcode($item->text);;
			}else {
				$atts = array();
				$atts['title']  = '';
	                        /*if(!empty($item->title)):
	                            if(strpos($item->title, 'icon-') === 0):
	                                $atts['title'] = '<i class="' . $item->title . '"></i>';
	                            endif;
	                        else:
	                            $atts['title'] = '';
	                        endif;*/

				$atts['target'] = ! empty( $item->target ) ? $item->target : '';
				$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';

				//If item has_children add atts to a
				if($args->has_children && $depth === 0) {
					/* $atts['href'] = '#'; */
					/* $atts['data-toggle']	= 'dropdown'; */
	                                $atts['href'] = ! empty( $item->url ) ? $item->url : '#';
					$atts['data-hover'] = 'dropdown';
					$atts['class'] = 'dropdown-toggle';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

				$attributes = '';
				foreach ( $atts as $attr => $value ) {
	                            if ( ! empty( $value ) ) {
	                                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

	                                if($value !== 'srp-icon'){
	                                    $attributes .= ' ' . $attr . '="' . $value . '"';
	                                }
	                            }
				}

				$item_output = $args->before;

				/*
				 * Glyphicons
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */

				if(! empty( $item->attr_title )){
	                            if( $item->title === 'srp-icon' ){
	                                $item_output .= '<a'. $attributes . '><i class=" ' . esc_attr( $item->attr_title ) . '"></i>';
	                            }
	                            else{
	                                $item_output .= '<a'. $attributes .'><i class=" ' . esc_attr( $item->attr_title ) . '"></i>';
	                            }

				} else {
	                            $item_output .= '<a'. $attributes .'>';
				}

				if (! empty($item->icon)) {
					$item_output .= '<i class=" ' . esc_attr( $item->icon ) . '"></i>';
				}

	            if( $item->title === 'srp-icon' ){
	                $item_output .= $args->link_before . $args->link_after;
	            }
				else{
	                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	            }

	            //$item_output .= ($args->has_children) ? ' <span class="mobile_menu_arrow"><i class="fa fa-chevron-right"></i></span></a>' : '</a>';
	            $item_output .= '</a>';

	            $item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_object( $args[0] ) ) {
           $args[0]->has_children = isset( $children_elements[$element->$id_field] ) && ! empty( $children_elements[$element->$id_field] );
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
?>