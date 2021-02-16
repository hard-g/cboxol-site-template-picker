import { buildQueryString } from './util';

export async function getTemplates( categroy ) {
	const endpoint = 'https://mbcc.test/wp-json/wp/v2/site-templates';
	const query = buildQueryString({
		_fields: [ 'id', 'title', 'excerpt', 'featured_media', 'template-category', 'site_id', 'image', 'categories' ],
	} );

	const response = await fetch( endpoint + '?' + query )
	const items = await response.json();

	if ( ! response.ok ) {
		throw new Error( items.message );
	}

	const total = Number( response.headers.get('X-WP-Total') );
	const totalPages = Number( response.headers.get('X-WP-TotalPages') );

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

export async function getTemplateCategories() {
	const endpoint = 'https://mbcc.test/wp-json/wp/v2/template-category';
	const query = buildQueryString({
		_fields: [ 'id', 'name', 'count' ],
		per_page: 100,
		order: 'desc',
		orderby: 'count',
		hide_empty: true,
	} );

	const response = await fetch( endpoint + '?' + query )
	const items = await response.json();

	if ( ! response.ok ) {
		throw new Error( items.message );
	}

	return items;
}
