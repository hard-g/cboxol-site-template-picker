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

	$categories = get_terms(
		[
			'taxonomy'   => 'cboxol_template_category',
			'number'     => 0,
			'hide_empty' => false,
		]
	);

	if ( is_wp_error( $categories ) ) {
		$categories = [];
	}

	wp_enqueue_style( 'cboxol-site-template-picker-style' );
	wp_enqueue_script( 'cboxol-site-template-picker-script' );

	view( 'template-picker.php', [ 'categories' => $categories ] );
}
add_action( 'openlab_after_group_site_markup', __NAMESPACE__ . '\\render_template_picker' );
