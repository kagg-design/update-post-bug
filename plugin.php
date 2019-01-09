<?php

/**
 *
 * Plugin Name: Update Post Bug
 * Description: wp_update_post() changes the tag of the post.
 * Author: KAGG Design
 * Author URI: https://kagg.eu/en
 * Version: 0.1
 */

function wpup_insert_post() {
	$term_1 = get_term_by( 'name', 'wp_update_post_tag_1', 'post_tag' );

	if ( ! $term_1 ) {
		$args   = array(
			'slug' => 'wp_update_post_tag_1',
		);
		$term_1 = wp_insert_term( 'wp_update_post_tag', 'post_tag', $args );
	}

	$term_2 = get_term_by( 'name', 'wp_update_post_tag_2', 'post_tag' );
	if ( ! $term_2 ) {
		$args   = array(
			'slug' => 'wp_update_post_tag_2',
		);
		$term_2 = wp_insert_term( 'wp_update_post_tag', 'post_tag', $args );
	}

}

add_action( 'init', 'wpup_insert_post' );

function wpup_test_page() {
	$uri  = $_SERVER['REQUEST_URI'];
	$path = wp_parse_url( $uri, PHP_URL_PATH );

	if ( 0 === strpos( trailingslashit( $path ), '/wpup-test/' ) ) {
		$post = get_page_by_title( 'Test wp_update_post', 'OBJECT', 'post' );
		if ( $post ) {
			wp_delete_post( $post->ID, true );
		}

		$term = get_term_by( 'slug', 'wp_update_post_tag_2', 'post_tag' );

		$postarr = array(
			'post_title'  => 'Test wp_update_post',
			'post_status' => 'publish',
			'tags_input'  => array( $term->term_id ),
		);

		$post_id = wp_insert_post( $postarr );

		$post = get_post( $post_id );

		echo 'wp_get_post_tags() Before wp_update_post()';
		$tags = wp_get_post_tags( $post->ID );
		var_dump( $tags );
		echo '<br><br><br>';

		echo 'wp_get_post_tags() After wp_update_post()';
		wp_update_post( $post );
		$tags = wp_get_post_tags( $post->ID );
		var_dump( $tags );

		die();
	}
}

add_action( 'init', 'wpup_test_page', 20 );

