<?php

/**
 * Add arrows to menu.
 */
add_filter( 'nav_menu_item_title', 'our_nav_menu_item_title', 10, 4 );
function our_nav_menu_item_title( $title, $menu_item, $args, $depth ) {

	if ( 0 === $depth && in_array( 'menu-item-has-children', $menu_item->classes, true ) ) {
		$title .= '<span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
	<path d="M7.32824 10.3125C7.2111 10.3125 7.09385 10.2667 7.00442 10.1752L2.42427 5.48769C2.2453 5.30452 2.2453 5.00792 2.42427 4.82487C2.60324 4.64183 2.89304 4.64171 3.0719 4.82487L7.32824 9.18097L11.5846 4.82487C11.7635 4.64171 12.0533 4.64171 12.2322 4.82487C12.4111 5.00804 12.4112 5.30464 12.2322 5.48769L7.65205 10.1752C7.56262 10.2667 7.44537 10.3125 7.32824 10.3125Z" fill="#000"/>
	</svg></span>';
	} elseif ( 0 !== $depth && in_array( 'menu-item-has-children', $menu_item->classes, true ) ) {
		$title .= '<span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
		<path d="M10.3125 7.32801C10.3125 7.44515 10.2667 7.5624 10.1752 7.65183L5.48769 12.232C5.30452 12.411 5.00792 12.411 4.82487 12.232C4.64183 12.053 4.64171 11.7632 4.82487 11.5844L9.18097 7.32801L4.82487 3.07168C4.64171 2.89271 4.64171 2.6029 4.82487 2.42405C5.00804 2.24519 5.30464 2.24508 5.48768 2.42405L10.1752 7.0042C10.2667 7.09363 10.3125 7.21088 10.3125 7.32801Z" fill="#000"/>
		</svg></span>';
	}
	return $title;
}

/**
 * Add custom fields to menu.
 */
add_action( 'wp_nav_menu_item_custom_fields', 'our_wp_nav_menu_item_custom_fields', 10, 5 );

function our_wp_nav_menu_item_custom_fields( $item_id, $menu_item, $depth, $args, $current_object_id ) {
	wp_enqueue_media();
	$meta_item_icon = get_post_meta( $item_id, '_menu_item_icon', true ); // id.
	$icon_name_attr = 'menu_item_icon[' . $item_id . ']';
	// mega menu
	$meta_item_mega = get_post_meta( $item_id, '_menu_item_mega', true );
	$mega_name_attr = 'menu_item_mega[' . $item_id . ']';
	?>
	<div class="kh-nav-icon">
	<div class="kh-nav-icon-inner">
	<?php if ( $meta_item_icon ) : ?>
		<?php $image_url = wp_get_attachment_image_url( $meta_item_icon, 'thumbnail' ); ?>
		<div class="kh-nav-image">
			<img src="<?php echo esc_url( $image_url ); ?>" />
		</div>
		<span class="kh-nav-close">		
			<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M6.46967 6.46967C6.76256 6.17678 7.23744 6.17678 7.53033 6.46967L14 12.9393L20.4697 6.46967C20.7626 6.17678 21.2374 6.17678 21.5303 6.46967C21.8232 6.76256 21.8232 7.23744 21.5303 7.53033L15.0607 14L21.5303 20.4697C21.8232 20.7626 21.8232 21.2374 21.5303 21.5303C21.2374 21.8232 20.7626 21.8232 20.4697 21.5303L14 15.0607L7.53033 21.5303C7.23744 21.8232 6.76256 21.8232 6.46967 21.5303C6.17678 21.2374 6.17678 20.7626 6.46967 20.4697L12.9393 14L6.46967 7.53033C6.17678 7.23744 6.17678 6.76256 6.46967 6.46967Z" fill="white"/>
			</svg>
		</span>
		<?php else : ?>
		<div class="kh-nav-image">
			<span>+</span>
		</div>
		<?php endif; ?>
	</div>
	<input type="hidden" name="<?php echo esc_attr( $icon_name_attr ); ?>" value="<?php echo esc_attr( $meta_item_icon ); ?>" />
</div>

	<?php
	// Mega menu.
	if ( 0 === $depth ) :
		?>
	<div class="kh-mega-menu">
		<input type="checkbox" name="<?php echo esc_attr( $mega_name_attr ); ?>" <?php checked( $meta_item_mega, true ); ?> />
		<label for=""><?php esc_html_e( 'Mega menu', 'our-mission' ); ?></label>
	</div>
		<?php
	endif;
}


add_action( 'wp_update_nav_menu_item', 'ourm_wp_update_nav_menu_item', 10, 3 );

/**
 * Saves the properties of a menu item or create a new one.
 *
 * The menu-item-title, menu-item-description and menu-item-attr-title are expected
 * to be pre-slashed since they are passed directly to APIs that expect slashed data.
 *
 * @since 3.0.0
 * @since 5.9.0 Added the `$fire_after_hooks` parameter.
 *
 * @param int   $menu_id          The ID of the menu. If 0, makes the menu item a draft orphan.
 * @param int   $menu_item_db_id  The ID of the menu item. If 0, creates a new menu item.
 * @param array $menu_item_data   The menu item's data.
 * @param bool  $fire_after_hooks Whether to fire the after insert hooks. Default true.
 * @return int|WP_Error The menu item's database ID or WP_Error object on failure.
 */
function ourm_wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {
	if ( isset( $_POST['menu_item_icon'][ $menu_item_db_id ] ) && ! empty( $_POST['menu_item_icon'][ $menu_item_db_id ] ) ) {
		update_post_meta( $menu_item_db_id, '_menu_item_icon', absint( $_POST['menu_item_icon'][ $menu_item_db_id ] ) );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_icon' );
	}

	// save mega

	if ( isset( $_POST['menu_item_mega'][ $menu_item_db_id ] ) && ! empty( $_POST['menu_item_mega'][ $menu_item_db_id ] ) ) {
		$mega_menu_value = 'on' === sanitize_text_field( wp_unslash( $_POST['menu_item_mega'][ $menu_item_db_id ] ) );
		update_post_meta( $menu_item_db_id, '_menu_item_mega', $mega_menu_value ? 1 : 0 );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_mega' );
	}
}

add_filter( 'walker_nav_menu_start_el', 'our_walker_nav_menu_start_el', 10, 4 );

/**
 * Filters a menu item's starting output.
 *
 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
 * no filter for modifying the opening and closing `<li>` for a menu item.
 *
 * @since 3.0.0
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $menu_item   Menu item data object.
 * @param int      $depth       Depth of menu item. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 */
function our_walker_nav_menu_start_el( $item_output, $menu_item, $depth, $args ) {
	$meta_item_icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	if ( $meta_item_icon ) {
		$image_url    = wp_get_attachment_image_url( $meta_item_icon, 'thumbnail' );
		$item_output .= '<img src="' . esc_url( $image_url ) . '" />';

	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'our_mega_walker_nav_menu_start_el', 10, 4 );

/**
 * Filters a menu item's starting output.
 *
 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
 * no filter for modifying the opening and closing `<li>` for a menu item.
 *
 * @since 3.0.0
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $menu_item   Menu item data object.
 * @param int      $depth       Depth of menu item. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 */
function our_mega_walker_nav_menu_start_el( $item_output, $menu_item, $depth, $args ) {
	$meta_item_icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );

	$atts           = array();
	$atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
	$atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
	if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
		$atts['rel'] = 'noopener';
	} else {
		$atts['rel'] = $menu_item->xfn;
	}
	$atts['href']         = ! empty( $menu_item->url ) ? $menu_item->url : '';
	$atts['aria-current'] = $menu_item->current ? 'page' : '';

	$atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );

	$attributes = '';
	foreach ( $atts as $attr => $value ) {
		if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
			$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
			$attributes .= ' ' . $attr . '="' . $value . '"';
		}
	}

	$title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

	$title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

	$item_output = $args->before;
	if ( $meta_item_icon ) {
		$item_output .= '<div class="ourm-submenu-header">';
	}
	$item_output .= '<a' . $attributes . '>';
	$item_output .= $args->link_before . $title . $args->link_after;
	if ( $meta_item_icon ) {
		$image_url    = wp_get_attachment_image_url( $meta_item_icon, 'thumbnail' );
		$item_output .= '<img src="' . esc_url( $image_url ) . '" />';
	}
	$item_output .= '</a>';
	if ( $meta_item_icon ) {
		$item_output .= '</div>';
	}
	$item_output .= $args->after;

	return $item_output;
}

add_filter( 'nav_menu_css_class', 'ourm_nav_menu_css_class', 10, 4 );
function ourm_nav_menu_css_class( $classes, $menu_item, $args, $depth ) {
	$meta_item_mega = get_post_meta( $menu_item->ID, '_menu_item_mega', true );
	if ( $meta_item_mega ) {
		$classes[] = 'ourm-mega-menu';
	}
	return $classes;
}
