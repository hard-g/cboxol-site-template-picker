<?php
/**
 * General "Site Template" post type functionality.
 */

namespace CBOX\OL\SiteTemplatePicker\PostType;

use function CBOX\OL\SiteTemplatePicker\Functions\view;

/**
 * Registers the "Site Template" post type.
 *
 * @return void
 */
function register() {
	register_post_type(
		'cboxol_site_template',
		[
			'labels'               => [
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
			'public'               => false,
			'hierarchical'         => false,
			'show_ui'              => true,
			'show_in_menu'         => false,
			'show_in_nav_menus'    => false,
			'register_meta_box_cb' => __NAMESPACE__ . '\\register_meta_boxes',
			'supports'             => [ 'title', 'excerpt', 'thumbnail' ],
			'has_archive'          => false,
			'rewrite'              => false,
			'query_var'            => false,
			'delete_with_user'     => false,
			'menu_position'        => null,
			'menu_icon'            => 'dashicons-admin-post',
			'show_in_rest'         => true,
			'rest_base'            => 'site-templates',
			'capabilities'         => [
				'delete_posts'           => 'delete_sites',
				'delete_post'            => 'delete_sites',
				'delete_published_posts' => 'delete_sites',
				'delete_private_posts'   => 'delete_sites',
				'delete_others_posts'    => 'delete_sites',
				'edit_post'              => 'manage_sites',
				'edit_posts'             => 'manage_sites',
				'edit_others_posts'      => 'manage_sites',
				'edit_published_posts'   => 'manage_sites',
				'read_post'              => 'read',
				'read_private_posts'     => 'read',
				'publish_posts'          => 'create_sites',
			],
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\\register' );

/**
 * Display "Site Templates" in CBOXOL submenu.
 *
 * @return void
 */
function register_admin_menu() {
	add_submenu_page(
		\cboxol_admin_slug(),
		__( 'Site Templates', 'cboxol-site-template-picker' ),
		__( 'Site Templates', 'cboxol-site-template-picker' ),
		'manage_sites',
		get_admin_url( \cbox_get_main_site_id(), 'edit.php?post_type=cboxol_site_template' ),
		'',
		7
	);
}
add_action( 'cbox_openlab_admin_menu', __NAMESPACE__ . '\\register_admin_menu' );

/**
 * Handle post type specific metaboxes.
 *
 * @return void
 */
function register_meta_boxes() {
	// Manually remove metabox instead of 'supports' args to make it available in REST API.
	remove_meta_box( 'postexcerpt', 'cboxol_site_template', 'normal' );

	add_meta_box(
		'template-description',
		__( 'Description', 'cboxol-site-template-picker' ),
		__NAMESPACE__ . '\\render_description',
		'cboxol_site_template',
		'normal',
		'core'
	);
}

/**
 * Sets the post updated messages for the "Site Template" post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the "Site Template" post type.
 */
function updated_messages( $messages ) {
	global $post;

	$site_id   = (int) get_post_meta( $post->ID, '_template_site_id', true );
	$permalink = get_admin_url( $site_id );

	$messages['cboxol_site_template'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Site Template updated. <a target="_blank" href="%s">View Site Template</a>', 'cboxol-site-template-picker' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'cboxol-site-template-picker' ),
		3  => __( 'Custom field deleted.', 'cboxol-site-template-picker' ),
		4  => __( 'Site Template updated.', 'cboxol-site-template-picker' ),
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		5  => isset( $_GET['revision'] ) ? __( 'Site Template restored.', 'cboxol-site-template-picker' ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Site Template published. <a href="%s">View Site Template</a>', 'cboxol-site-template-picker' ), esc_url( $permalink ) ),
		7  => __( 'Site Template saved.', 'cboxol-site-template-picker' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Site Template submitted. <a target="_blank" href="%s">Preview Site Template</a>', 'cboxol-site-template-picker' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
			__( 'Site Template scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Site Template</a>', 'cboxol-site-template-picker' ),
			date_i18n( __( 'M j, Y @ G:i', 'cboxol-site-template-picker' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Site Template draft updated. <a target="_blank" href="%s">Preview Site Template</a>', 'cboxol-site-template-picker' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\updated_messages' );

/**
 * Custom minor actions the "Site Template" submit box.
 *
 * @param \WP_Post $post The site template object.
 * @return void
 */
function render_minor_actions( $post ) {
	if ( 'cboxol_site_template' !== $post->post_type ) {
		return;
	}

	if ( 'publish' !== $post->post_status ) {
		return;
	}

	$site_id = (int) get_post_meta( $post->ID, '_template_site_id', true );
	if ( ! $site_id ) {
		return;
	}

	view( 'admin/submit-actions.php', [ 'url' => get_site_url( $site_id ) ] );
}
add_action( 'post_submitbox_minor_actions', __NAMESPACE__ . '\\render_minor_actions' );

/**
 * Visually replace "Excerpt" metabox with "Description" metabox
 *
 * @param \WP_Post $post
 * @return void
 */
function render_description( $post ) {
	view( 'admin/description.php', [ 'description' => $post->post_excerpt ] );
}

/**
 * Create associated template site.
 *
 * @param int $post_id   The site template ID.
 * @param \WP_Post $post The site template object.
 * @return void
 */
function create_site_template( $post_id, \WP_Post $post ) {
	if ( isset( $post->post_status ) && 'auto-draft' === $post->post_status ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}

	if ( 'cboxol_site_template' !== $post->post_type ) {
		return;
	}

	$site_id = (int) get_post_meta( $post_id, '_template_site_id', true );
	if ( $site_id ) {
		return;
	}

	// Use timestamp as a hash to ensure uniqueness.
	$slug            = sprintf( 'site-template-%s-%s', $post->post_name, time() );
	$current_network = get_network();

	if ( is_subdomain_install() ) {
		$site_domain = preg_replace( '|^www\.|', '', $current_network->domain );
		$domain      = $slug . '.' . $site_domain;
		$path        = '/';
	} else {
		$domain = $current_network->domain;
		$path   = $current_network->path . $slug . '/';
	}

	$site_id = wp_insert_site(
		[
			'domain'  => $domain,
			'path'    => $path,
			'user_id' => get_current_user_id(),
			/* translators: Site template name */
			'title'   => sprintf( __( 'Site Template - %s', 'cboxol-site-template-picker' ), esc_html( $post->post_title ) ),
		]
	);

	if ( is_wp_error( $site_id ) ) {
		return;
	}

	// Save template ID for syncing.
	update_site_meta( $site_id, '_site_template_id', $post_id );

	// Save template site ID for syncing.
	update_post_meta( $post_id, '_template_site_id', $site_id );
}
add_action( 'save_post', __NAMESPACE__ . '\\create_site_template', 10, 2 );

/**
 * Set template site status as "Deleted".
 * This doesn't actually delete the site from the DB.
 *
 * @param int $post_id The site template ID.
 * @return void
 */
function delete_site_template( $post_id ) {
	// WP < 5.5 compatibility.
	$post = get_post( $post_id );

	if ( 'cboxol_site_template' !== $post->post_type ) {
		return;
	}

	$site_id = (int) get_post_meta( $post_id, '_template_site_id', true );

	// Bail if template has no associated site.
	if ( ! $site_id ) {
		return;
	}

	update_blog_status( $site_id, 'deleted', 1 );
}
add_action( 'before_delete_post', __NAMESPACE__ . '\\delete_site_template' );
