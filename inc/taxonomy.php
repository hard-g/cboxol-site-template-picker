<?php
/**
 * General "Site Template" taxonomy functionality.
 */

namespace CBOX\OL\SiteTemplatePicker\Taxonomy;

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
