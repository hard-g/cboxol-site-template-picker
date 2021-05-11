<?php
/**
 * General "Site Template" taxonomy functionality.
 */

namespace CBOX\OL\SiteTemplatePicker\Taxonomy;

use function CBOX\OL\SiteTemplatePicker\Functions\view;

/**
 * Registers the "Site Template Category" taxonomy.
 *
 * @return void
 */
function register() {
	register_taxonomy(
		'cboxol_template_category',
		[ 'cboxol_site_template' ],
		[
			'labels'            => [
				'name'                       => __( 'Template Categories', 'cboxol-site-template-picker' ),
				'singular_name'              => _x( 'Template Category', 'taxonomy general name', 'cboxol-site-template-picker' ),
				'search_items'               => __( 'Search Template Categories', 'cboxol-site-template-picker' ),
				'popular_items'              => __( 'Popular Template Categories', 'cboxol-site-template-picker' ),
				'all_items'                  => __( 'All Template Categories', 'cboxol-site-template-picker' ),
				'parent_item'                => __( 'Parent Template Category', 'cboxol-site-template-picker' ),
				'parent_item_colon'          => __( 'Parent Template Category:', 'cboxol-site-template-picker' ),
				'edit_item'                  => __( 'Edit Template Category', 'cboxol-site-template-picker' ),
				'update_item'                => __( 'Update Template Category', 'cboxol-site-template-picker' ),
				'view_item'                  => __( 'View Template Category', 'cboxol-site-template-picker' ),
				'add_new_item'               => __( 'Add New Template Category', 'cboxol-site-template-picker' ),
				'new_item_name'              => __( 'New Template Category', 'cboxol-site-template-picker' ),
				'separate_items_with_commas' => __( 'Separate template Categories with commas', 'cboxol-site-template-picker' ),
				'add_or_remove_items'        => __( 'Add or remove template categories', 'cboxol-site-template-picker' ),
				'choose_from_most_used'      => __( 'Choose from the most used template categories', 'cboxol-site-template-picker' ),
				'not_found'                  => __( 'No template categories found.', 'cboxol-site-template-picker' ),
				'no_terms'                   => __( 'No template categories', 'cboxol-site-template-picker' ),
				'menu_name'                  => __( 'Template categories', 'cboxol-site-template-picker' ),
				'items_list_navigation'      => __( 'Template categories list navigation', 'cboxol-site-template-picker' ),
				'items_list'                 => __( 'Template categories list', 'cboxol-site-template-picker' ),
				'most_used'                  => _x( 'Most Used', 'template_category', 'cboxol-site-template-picker' ),
				'back_to_items'              => __( '&larr; Back to Template categories', 'cboxol-site-template-picker' ),
			],
			'hierarchical'      => true,
			'public'            => false,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_admin_column' => true,
			'query_var'         => false,
			'rewrite'           => false,
			'show_in_rest'      => true,
			'rest_base'         => 'template_category',
			'capabilities'      => [
				'manage_terms' => 'manage_sites',
				'edit_terms'   => 'manage_sites',
				'delete_terms' => 'manage_sites',
				'assign_terms' => 'manage_sites',
			],
			'meta_box_cb'       => __NAMESPACE__ . '\\meta_box_cb',
		]
	);

}
add_action( 'init', __NAMESPACE__ . '\\register' );

/**
 * Sets the post updated messages for the "Site Template Category" taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the "Site Template Category" taxonomy.
 */
function updated_messages( $messages ) {
	$messages['cboxol_template_category'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Template category added.', 'cboxol-site-template-picker' ),
		2 => __( 'Template category deleted.', 'cboxol-site-template-picker' ),
		3 => __( 'Template category updated.', 'cboxol-site-template-picker' ),
		4 => __( 'Template category not added.', 'cboxol-site-template-picker' ),
		5 => __( 'Template category not updated.', 'cboxol-site-template-picker' ),
		6 => __( 'Template categories deleted.', 'cboxol-site-template-picker' ),
	];

	return $messages;
}
add_filter( 'term_updated_messages', __NAMESPACE__ . '\\updated_messages' );

/**
 * Gets the group types associated with a term.
 *
 * @param int $term_id
 * @return array
 */
function get_group_types( $term_id ) {
	return get_term_meta( $term_id, 'cboxol_group_type', false );
}

/**
 * Meta box callback for taxonomy.
 *
 * A wrapper for post_categories_meta_box() (the default) that adds our label filters.
 *
 * @return void
 */
function meta_box_cb( $post, $box ) {
	add_filter( 'get_terms', __NAMESPACE__ . '\\append_group_types_to_labels' );
	post_categories_meta_box( $post, $box );
	remove_filter( 'get_terms', __NAMESPACE__ . '\\append_group_types_to_labels' );
}

/**
 * Appends associated group types to term labels.
 *
 * @param array $terms
 * @return array
 */
function append_group_types_to_labels( $terms ) {
	$all_group_types = cboxol_get_group_types();

	foreach ( $terms as &$term ) {
		$type_labels = get_term_group_type_labels( $term->term_id );

		if ( $type_labels ) {
			$term->name .= ' (' . implode( ', ', $type_labels ) . ')';
		} else {
			$term->name .= ' (no group types)';
		}
	}

	return $terms;
}

/**
 * Gets an array of the labels belonging to a term's group types.
 *
 * @param int $term_id
 * @return array
 */
function get_term_group_type_labels( $term_id ) {
	$all_group_types = cboxol_get_group_types();

	$type_labels = array_map(
		function( $type_slug ) use ( $all_group_types ) {
			if ( isset( $all_group_types[ $type_slug ] ) ) {
				return $all_group_types[ $type_slug ]->get_label( 'plural' );
			}
		},
		get_group_types( $term_id )
	);

	return array_filter( $type_labels );
}


/**
 * Adds the group-type selecton interface on edit-tags.php.
 *
 * @return void
 */
function add_group_type_fields_to_edit_tags() {
	$group_types = array_map(
		function( $type ) {
			return [
				'label' => $type->get_label( 'plural' ),
				'value' => $type->get_slug(),
			];
		},
		cboxol_get_group_types()
	);

	view( 'admin/edit-tags-group-types.php', [ 'group_types' => $group_types ] );
}
add_action( 'cboxol_template_category_add_form_fields', __NAMESPACE__ . '\\add_group_type_fields_to_edit_tags' );

/**
 * Adds the group-type selecton interface on term.php.
 *
 * @param $term WP_Term object.
 * @return void
 */
function add_group_type_fields_to_term( $term ) {
	$group_types = array_map(
		function( $type ) {
			return [
				'label' => $type->get_label( 'plural' ),
				'value' => $type->get_slug(),
			];
		},
		cboxol_get_group_types()
	);

	$selected = get_group_types( $term->term_id );

	view( 'admin/term-group-types.php', [ 'group_types' => $group_types, 'selected' => $selected ] );
}
add_action( 'cboxol_template_category_edit_form', __NAMESPACE__ . '\\add_group_type_fields_to_term' );

/**
 * Handles taxonomy edits and saves group types.
 *
 * @param int $term_id ID of the term.
 * @return void
 */
function handle_term_save( $term_id ) {
	if ( ! current_user_can( 'delete_sites' ) ) {
		return;
	}

	if ( ! isset( $_POST['cboxol-edit-term-nonce'] ) ) {
		return;
	}

	check_admin_referer( 'cboxol_edit_term', 'cboxol-edit-term-nonce' );

	$submitted = $_POST['group-types'];

	// Delete existing and re-add.
	delete_term_meta( $term_id, 'cboxol_group_type' );

	$all_group_types = cboxol_get_group_types();
	foreach ( $submitted as $type ) {
		if ( ! isset( $all_group_types[ $type ] ) ) {
			continue;
		}

		add_term_meta( $term_id, 'cboxol_group_type', $type );
	}
}
add_action( 'saved_cboxol_template_category', __NAMESPACE__ . '\\handle_term_save' );

/**
 * Adds 'Group Types' column to edit-tags.php.
 *
 * @param array $columns
 * @return array
 */
function add_group_types_column( $columns ) {
	$columns['group_type'] = __( 'Group Type', 'cboxol-site-template-picker' );
	return $columns;
}
add_filter( 'manage_edit-cboxol_template_category_columns', __NAMESPACE__ . '\\add_group_types_column' );

/**
 * Populates the 'Group Types' column on edit-tags.php.
 */
function group_types_column_content( $content, $column, $term_id ) {
	$type_labels = get_term_group_type_labels( $term_id );
	return implode( ', ', $type_labels );
}
add_filter( 'manage_cboxol_template_category_custom_column', __NAMESPACE__ . '\\group_types_column_content', 10, 3 );
