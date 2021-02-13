<?php
/**
 * "Template Site" related functionality.
 */

namespace CBOX\OL\SiteTemplatePicker\Sites;

/**
 * When a site is deleted, move its template into "Trash".
 *
 * @param \WP_Site $site Deleted site object.
 * @return void
 */
function trash_site_template( $site ) {
	$switched    = false;
	$template_id = get_site_meta( $site->id, '_site_template_id', true );

	if ( ! $template_id ) {
		return;
	}

	if ( ! \cbox_is_main_site() ) {
		switch_to_blog( \cbox_get_main_site_id() );
		$switched = true;
	}

	wp_trash_post( $template_id );

	if ( $switched ) {
		restore_current_blog();
	}
}
add_action( 'wp_uninitialize_site', __NAMESPACE__ . '\\trash_site_template', 20, 1 );
