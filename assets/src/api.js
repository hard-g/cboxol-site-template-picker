/**
 * Internal dependencies
 */
import { buildQueryString } from './util';

const endpoint = window.SiteTemplatePicker.endpoint;
const perPage = window.SiteTemplatePicker.perPage;

export async function getSiteTemplates( category, page = 1 ) {
	const query = buildQueryString( {
		_fields: [ 'id', 'title', 'excerpt', 'featured_media', 'template_category', 'site_id', 'image', 'categories' ],
		template_category: category,
		per_page: Number( perPage ),
		page,
	} );

	const response = await fetch( endpoint + '?' + query )
	const items = await response.json();

	if ( ! response.ok ) {
		throw new Error( items.message );
	}

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

	return {
		templates,
		prev: page > 1 ? page - 1 : null,
		next: totalPages > page ? page + 1 : null,
	};
}
