( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'location_to_lat_long', {

		// Adds custom events.
		events : {
			'click .js-butterbean-generate-lat-long' : 'generateLatLong'
		},

		generateLatLong: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				geocoder = new google.maps.Geocoder(),
				$target = $( e.currentTarget ),
				location = $target.parent().find( '.butterbean-location' ).val(),
				$latInput = $target.parent().find( '.butterbean-location-lat' ),
				$longInput = $target.parent().find( '.butterbean-location-long' );

			geocoder.geocode( { 'address': location }, function( results, status ) {
				if ( status === 'OK' ) {
					if ( results[0] ) {
						$latInput.val( results[0]['geometry']['location']['lat'] );
						$longInput.val( results[0]['geometry']['location']['lng'] );
					} else {
						window.alert('No results found');
					}
				} else {
					window.alert('Geocoder failed due to: ' + status);
				}
			});
		}
	} );

}() );
