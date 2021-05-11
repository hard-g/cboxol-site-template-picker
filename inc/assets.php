<?php
/**
 * Handle plugin assets.
 */
namespace CBOX\OL\SiteTemplatePicker\Assets;

use const CBOX\OL\SiteTemplatePicker\VERSION;
use const CBOX\OL\SiteTemplatePicker\ROOT_FILE;

use function CBOX\OL\SiteTemplatePicker\Taxonomy\get_group_types;

/**
 * Register template picker assets.
 *
 * @return void
 */
function register_assets() {
	wp_register_style(
		'cboxol-site-template-picker-style',
		plugins_url( 'assets/css/site-template-picker.css', ROOT_FILE ),
		[],
		VERSION
	);

	wp_register_script(
		'cboxol-site-template-picker-script',
		plugins_url( 'assets/js/site-template-picker.js', ROOT_FILE ),
		[],
		VERSION,
		true
	);

	$all_categories = get_terms(
		[
			'taxonomy'   => 'cboxol_template_category',
			'hide_empty' => false,
		]
	);

	$category_map = [];
	foreach ( $all_categories as $cat ) {
		$category_map[ $cat->term_id ] = get_group_types( $cat->term_id );
	}

	wp_localize_script(
		'cboxol-site-template-picker-script',
		'SiteTemplatePicker',
		[
			'endpoint'    => rest_url( 'wp/v2/site-templates' ),
			'perPage'     => 6,
			'categoryMap' => $category_map,
			'messages'    => [
				'loading'   => esc_html__( 'Loading Templates...', 'cboxol-site-template-picker' ),
				'noResults' => esc_html__( 'No templates were found.', 'cboxol-site-template-picker' ),
			],
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\\register_assets', 20 );
