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
	$categories = get_terms( [
		'taxonomy'   => 'cboxol_template_category',
		'number'     => 0,
		'hide_empty' => true,
	] );

	if ( is_wp_error( $categories ) ) {
		$categories = [];
	}

	view( 'template-picker.php', [ 'categories' => $categories ] );
}
add_action( 'openlab_after_group_site_markup', __NAMESPACE__ . '\\render_template_picker' );
