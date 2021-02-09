<?php

namespace CBOX\OL\SiteTemplatePicker\PostType;

/**
 * Registers the "Site Template" post type.
 *
 * @return void
 */
function register() {
	register_post_type(
		'cboxol_site_template',
		[
			'labels'                => [
				'name'                  => __( 'Site Templates', 'cboxol-site-template-picker' ),
				'singular_name'         => __( 'Site Template', 'cboxol-site-template-picker' ),
				'all_items'             => __( 'All Site Templates', 'cboxol-site-template-picker' ),
				'archives'              => __( 'Site Template Archives', 'cboxol-site-template-picker' ),
				'attributes'            => __( 'Site Template Attributes', 'cboxol-site-template-picker' ),
				'insert_into_item'      => __( 'Insert into Site Template', 'cboxol-site-template-picker' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Site Template', 'cboxol-site-template-picker' ),
				'featured_image'        => _x( 'Featured Image', 'cboxol_site_template', 'cboxol-site-template-picker' ),
				'set_featured_image'    => _x( 'Set featured image', 'cboxol_site_template', 'cboxol-site-template-picker' ),
				'remove_featured_image' => _x( 'Remove featured image', 'cboxol_site_template', 'cboxol-site-template-picker' ),
				'use_featured_image'    => _x( 'Use as featured image', 'cboxol_site_template', 'cboxol-site-template-picker' ),
				'filter_items_list'     => __( 'Filter Site Templates list', 'cboxol-site-template-picker' ),
				'items_list_navigation' => __( 'Site Templates list navigation', 'cboxol-site-template-picker' ),
				'items_list'            => __( 'Site Templates list', 'cboxol-site-template-picker' ),
				'new_item'              => __( 'New Site Template', 'cboxol-site-template-picker' ),
				'add_new'               => __( 'Add New', 'cboxol-site-template-picker' ),
				'add_new_item'          => __( 'Add New Site Template', 'cboxol-site-template-picker' ),
				'edit_item'             => __( 'Edit Site Template', 'cboxol-site-template-picker' ),
				'view_item'             => __( 'View Site Template', 'cboxol-site-template-picker' ),
				'view_items'            => __( 'View Site Templates', 'cboxol-site-template-picker' ),
				'search_items'          => __( 'Search Site Templates', 'cboxol-site-template-picker' ),
				'not_found'             => __( 'No Site Templates found', 'cboxol-site-template-picker' ),
				'not_found_in_trash'    => __( 'No Site Templates found in trash', 'cboxol-site-template-picker' ),
				'parent_item_colon'     => __( 'Parent Site Template:', 'cboxol-site-template-picker' ),
				'menu_name'             => __( 'Site Templates', 'cboxol-site-template-picker' ),
			],
			'public'                => false,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => false,
			'supports'              => [ 'title', 'excerpt' ],
			'has_archive'           => false,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'cboxol_site_template',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\\register' );

/**
 * Sets the post updated messages for the "Site Template" post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the "Site Template" post type.
 */
function updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['cboxol_site_template'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Site Template updated. <a target="_blank" href="%s">View Site Template</a>', 'cboxol-site-template-picker' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'cboxol-site-template-picker' ),
		3  => __( 'Custom field deleted.', 'cboxol-site-template-picker' ),
		4  => __( 'Site Template updated.', 'cboxol-site-template-picker' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Site Template restored to revision from %s', 'cboxol-site-template-picker' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Site Template published. <a href="%s">View Site Template</a>', 'cboxol-site-template-picker' ), esc_url( $permalink ) ),
		7  => __( 'Site Template saved.', 'cboxol-site-template-picker' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Site Template submitted. <a target="_blank" href="%s">Preview Site Template</a>', 'cboxol-site-template-picker' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf(
			__( 'Site Template scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Site Template</a>', 'cboxol-site-template-picker' ),
			date_i18n( __( 'M j, Y @ G:i', 'cboxol-site-template-picker' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Site Template draft updated. <a target="_blank" href="%s">Preview Site Template</a>', 'cboxol-site-template-picker' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\updated_messages' );
