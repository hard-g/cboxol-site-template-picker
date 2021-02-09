<?php
/**
 * Helper methods.
 */

namespace CBOX\OL\SiteTemplatePicker\Functions;

use const CBOX\OL\SiteTemplatePicker\ROOT_DIR;

/**
 * Render a view.
 *
 * @param string $name Name of the view.
 * @param array  $data Data passed to the view.
 * @return void
 *
 * @throws \Exception
 */
function view( $name = '', array $data = [] ) {
	$path = ROOT_DIR . '/views/' . $name;

	if ( ! file_exists( $path ) ) {
		throw new \Exception( sprintf( 'Unable to locate view file: %s', $path ) );
	}

	extract( $data, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	require $path;
}
