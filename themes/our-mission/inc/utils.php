<?php

/**
 * All districts.
 *
 * @return array
 */
function ourm_get_disctricts() {
	return array(
		'miller_harbour' => __( 'Miller harbour', 'our-mission' ),
		'crime_alley'    => __( 'Crime alley', 'our-mission' ),
		'the_bowery'     => __( 'The Bowery', 'our-mission' ),
		'little_italy'   => __( 'Little Italy', 'our-mission' ),
		'bloodhaven'     => __( 'Bloodhaven', 'our-mission' ),
		'otisburg'       => __( 'Otisburg', 'our-mission' ),
	);
}

/**
 * All initiatives statuses.
 *
 * @return array
 */
function ourm_get_statuses() {

	return array(
		'on-keep'     => __( 'Collection is going', 'our-mission' ),
		'completed'   => __( 'Collection completed', 'our-mission' ),
		'on-consider' => __( 'Under consideration', 'our-mission' ),
		'denied'      => __( 'Not supported', 'our-mission' ),
	);

}

/**
 * Orderby options.
 *
 * @return array
 */
function ourm_get_orderby() {

	return array(
		'date-asc'     => __( 'Chronology', 'our-mission' ),
		'date-desc'    => __( 'Reverse chronology', 'our-mission' ),
		'soon-expired' => __( 'Little time left', 'our-mission' ),
		'votes'        => __( 'Number of votes', 'our-mission' ),
	);

}

/**
 * Output filters on news page.
 */
function ourm_get_categories_html() {
	$categories = get_categories(
		array(
			'taxonomy' => 'category',
			'type'     => 'post',
			'orderby'  => 'name',
			'order'    => 'ASC',

		)
	);
	echo '<ul>';
	echo '<li><a href="' . esc_url( get_post_type_archive_link( 'post' ) ) . '" class="' . ( isset( $_GET['cat'] ) ? '' : 'active' ) . '">' . __( 'All news', 'our-mission' ) . '</a></li>';
	foreach ( $categories as $cat ) {
		echo '<li><a href="' . esc_url( add_query_arg( array( 'cat' => $cat->term_id ), get_post_type_archive_link( 'post' ) ) ) . '" class="' . ( isset( $_GET['cat'] ) && (int) $_GET['cat'] === $cat->term_id ? 'active' : '' ) . '">' . esc_html( $cat->name ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Orderby html block.
 */
function ourm_get_orderby_html() {
	$orderby_array = ourm_get_orderby();
	echo '<ul>';

	foreach ( $orderby_array as $key => $value ) {
		$link = add_query_arg( array( 'orderby' => $key ), get_post_type_archive_link( 'ourm_inititives' ) );
		echo '<li><a href="' . esc_url( $link ) . '" >' . esc_html( $value ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Disctricts html block.
 */
function ourm_get_disctricts_html() {
	$districts_array    = ourm_get_disctricts();
	$all_districts_link = remove_query_arg( 'district', get_post_type_archive_link( 'ourm_inititives' ) );
	echo '<ul>';
	echo '<li><a href="' . esc_url( $all_districts_link ) . '" >' . __( 'All districts', 'our-mission' ) . '</a></li>';
	foreach ( $districts_array as $key => $value ) {
		$link = add_query_arg( array( 'district' => $key ), get_post_type_archive_link( 'ourm_inititives' ) );
		echo '<li><a href="' . esc_url( $link ) . '" >' . esc_html( $value ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Statuses html block.
 */
function ourm_get_status_html() {
	$status_array = ourm_get_statuses();
	echo '<ul>';

	foreach ( $status_array as $key => $value ) {
		$link = add_query_arg( array( 'status_ini' => $key ), get_post_type_archive_link( 'ourm_inititives' ) );
		echo '<li><a href="' . esc_url( $link ) . '" >' . esc_html( $value ) . '</a></li>';
	}
	echo '</ul>';
}
