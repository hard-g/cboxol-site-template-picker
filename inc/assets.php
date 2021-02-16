<?php
/**
 * Handle plugin assets.
 */
namespace CBOX\OL\SiteTemplatePicker\Assets;

use const CBOX\OL\SiteTemplatePicker\VERSION;
use const CBOX\OL\SiteTemplatePicker\ROOT_FILE;

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

	wp_localize_script(
		'cboxol-site-template-picker-script',
		'SiteTemplatePicker',
		[
			'endpoint' => rest_url( 'wp/v2/site-templates' ),
			'messages' => [
				'loading'   => esc_html__( 'Loading Templates...', 'cboxol-site-template-picker' ),
				'noResults' => esc_html__( 'No templates were found.', 'cboxol-site-template-picker' ),
			],
		]
	);
}
add_action( 'init', __NAMESPACE__ . '\\register_assets' );
