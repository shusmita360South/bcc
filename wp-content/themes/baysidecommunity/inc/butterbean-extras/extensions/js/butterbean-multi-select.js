( function() {

	/**
	 * Adds the multi_select view.
	 *
	 * @since  1.0.0
	 */
    butterbean.views.register_control( 'multi_select', {
        ready: function() {
            jQuery( '.butterbean-control select' ).selectize();
        }
    } );

}() );
