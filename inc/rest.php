<?php
/**
 * Extend WP REST API.
 */

namespace CBOX\OL\SiteTemplatePicker\Rest;

/**
 * Register custom response fields.
 *
 * @return void
 */
function register_fields() {
	register_rest_field(
		'cboxol_site_template',
		'site_id',
		[
			'get_callback' => function( $object ) {
				return (int) get_post_meta( $object['id'], '_template_site_id', true );
			},
			'schema'       => array(
				'description' => __( 'Template site ID.', 'cboxol-site-template-picker' ),
				'type'        => 'integer',
			),
		]
	);

	register_rest_field(
		'cboxol_site_template',
		'image',
		[
			'get_callback' => function( $object ) {
				return wp_get_attachment_image_url( $object['featured_media'], 'medium_large' );
			},
			'schema'       => array(
				'description' => __( 'Template site image.', 'cboxol-site-template-picker' ),
				'type'        => 'string',
			),
		]
	);

	register_rest_field(
		'cboxol_site_template',
		'categories',
		[
			'get_callback' => function( $object ) {
				$data = [];

				foreach ( $object['template_category'] as $term_id ) {
					$term   = get_term_by( 'id', $term_id, 'cboxol_template_category' );
					$data[] = $term ? $term->name : '';
				}

				return $data;
			},
			'schema'       => array(
				'description' => __( 'Template site categories.', 'cboxol-site-template-picker' ),
				'type'        => 'array',
				'items'       => [
					'type' => 'integer',
				],
			),
		]
	);
}
add_action( 'rest_api_init', __NAMESPACE__ . '\\register_fields' );
