( function( api ) {

	// Extends our custom "bootstrap-photography" section.
	api.sectionConstructor['bootstrap-photography'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
