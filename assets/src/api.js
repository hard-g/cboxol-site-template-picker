/**
 * Internal dependencies
 */
import { buildQueryString } from './util';

const endpoint = window.SiteTemplatePicker.endpoint;

export async function getSiteTemplates( category ) {
	const query = buildQueryString({
		_fields: [ 'id', 'title', 'excerpt', 'featured_media', 'template_category', 'site_id', 'image', 'categories' ],
		template_category: category
	} );

	const response = await fetch( endpoint + '?' + query )
	const items = await response.json();

	if ( ! response.ok ) {
		throw new Error( items.message );
	}

	const total = Number( response.headers.get( 'X-WP-Total' ) );
	const totalPages = Number( response.headers.get( 'X-WP-TotalPages' ) );

	const templates = items.map( ( item ) => {
		return {
			id: item.site_id,
			title: item.title.rendered,
			excerpt: item.excerpt.rendered,
			image: item.image,
			categories: item.categories,
		};
	} );

	return { templates, total, totalPages };
}
