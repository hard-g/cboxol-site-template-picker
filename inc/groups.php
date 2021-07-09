<?php
/**
 * Group integration.
 */

namespace CBOX\OL\SiteTemplatePicker\Groups;

use function CBOX\OL\SiteTemplatePicker\Functions\view;

/**
 * Renders "Template Picker" panel on "Site Details" step.
 *
 * @return void
 */
function render_template_picker() {
	$group_id = bp_get_current_group_id();
	$is_clone = (bool) cboxol_get_clone_source_group_id( $group_id );

	// Don't display template picker we're cloning the group.
	if ( $is_clone ) {
		return;
	}

	// Don't display template picker if there's no group type.
	$group_type = cboxol_get_group_group_type( $group_id );
	if ( ! $group_type || is_wp_error( $group_type ) ) {
		return;
	}

	$categories = get_terms(
		[
			'taxonomy'   => 'cboxol_template_category',
			'number'     => 0,
			'hide_empty' => false,
			'meta_query' => [
				[
					'key'   => 'cboxol_group_type',
					'value' => $group_type->get_slug(),
				],
			],
		]
	);

	// If there are no valid categories, then there's nothing to show.
	if ( empty( $categories ) ) {
		return;
	}

	if ( is_wp_error( $categories ) ) {
		$categories = [];
	}

	$gloss = get_option( 'cboxol_stp_gloss', '' );

	wp_enqueue_style( 'cboxol-site-template-picker-style' );
	wp_enqueue_script( 'cboxol-site-template-picker-script' );

	view( 'template-picker.php', [ 'categories' => $categories, 'gloss' => $gloss ] );
}
add_action( 'openlab_after_group_site_markup', __NAMESPACE__ . '\\render_template_picker' );
