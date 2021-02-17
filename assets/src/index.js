/**
 * Internal dependencies
 */
import { getSiteTemplates } from './api';

const templatePicker = document.querySelector('.site-template-picker');
const templateCategories = document.querySelector('#site-template-categories');
const messages = window.SiteTemplatePicker.messages;

function renderTemplate( { id, title, excerpt, image, categories } ) {
	return `
	<button type="button" class="site-template-component" data-template-id="${ id }">
		<div class="site-template-component__image">
			${ image
				? `<img src="${ image }" alt="${ title }">`
				: `<svg fill="currentColor" width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>`
			}
			${ excerpt ? `<div class="site-template-component__description">${ excerpt }</div>` : `` }
		</div>
		<div class="site-template-component__meta">
			<span class="site-template-component__category">${ categories.join( ', ' ) }</span>
			<div class="site-template-component__name">${ title }</div>
		</div>
	</button>
	`;
}

function init() {
	getSiteTemplates().then( ( { templates } ) => {
		const compiled = templates.map( ( template ) => renderTemplate( template ) ).join('');
		templatePicker.innerHTML = compiled;
	} );
}

init();

templateCategories.addEventListener( 'blur', function( event ) {
	const category = ( event.target.value !== '0' ) ? event.target.value : null;

	templatePicker.innerHTML = `<p>${ messages.loading }</p>`;

	getSiteTemplates( category ).then( ( { templates } ) => {
		if ( ! templates.length ) {
			templatePicker.innerHTML = `<p>${ messages.noResults }</p>`;
			return;
		}

		const compiled = templates.map( ( template ) => renderTemplate( template ) ).join('');
		templatePicker.innerHTML = compiled;
	} );
} )
