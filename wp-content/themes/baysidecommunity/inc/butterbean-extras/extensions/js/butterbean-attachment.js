( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'attachment', {

		// Adds custom events.
		events : {
			'click .js-butterbean-attachment-handlediv' : 'attachmentClose',

			'click .js-butterbean-attachment-add-media'    : 'showmodal',
			'click .js-butterbean-attachment-remove' : 'attachmentRemove',
		},

		ready: function() {
			var $ = jQuery,
				_this = this;
		},

		attachmentClose: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$attachment = $target.parents( '.butterbean-attachment' );

			$attachment.toggleClass( 'closed' );
		},

		attachmentRemove: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$attachIdInput = $target.parents( '.butterbean-attachment' ).find( '.butterbean-attachment-id' ),
				$filename = $target.parents( '.butterbean-attachment' ).find( '.butterbean-attachment-filename' );

			$attachIdInput.attr('value', '');
			$filename.attr('value', '');
		},

		// Executed when the show modal button is clicked.
		showmodal : function( e ) {
			var $ = jQuery,
				$target = $( e.currentTarget ),
				$attachIdInput = $target.parents( '.butterbean-attachment' ).find( '.butterbean-attachment-id' ),
				$filename = $target.parents( '.butterbean-attachment' ).find( '.butterbean-attachment-filename' );

			e.preventDefault();

			// If we already have a media modal, open it.
			if ( ! _.isUndefined( this.media_modal ) ) {
				// Update the image variables.
				this.media_modal.options.data.attach_id_input = $attachIdInput;

				// Update the image src.
				this.media_modal.options.data.filename_element = $filename;

				// Open
				this.media_modal.open();
				return;
			}

			// Create a new media modal.
			this.media_modal = wp.media( {
				data     : {
					attach_id_input : $attachIdInput,
					filename_element  : $filename,
				},
				frame    : 'select',
				multiple : false,
				editing  : true,
				title    : this.model.get( 'l10n' ).choose,
				button   : { text:  this.model.get( 'l10n' ).set }
			} );

			// Runs when an image is selected in the media modal.
			this.media_modal.on( 'select', function() {

				// Gets the JSON data for the first selection.
				var media = this.media_modal.state().get( 'selection' ).first().toJSON();

				// URL of media
				var mediaURL = media.url;

				// Update the image id input
				this.media_modal.options.data.attach_id_input.val( media.id );

				// Update the image src
				this.media_modal.options.data.filename_element.val( mediaURL );
			}, this );

			// Opens the media modal.
			this.media_modal.open();
		},

		// Executed when the remove media button is clicked.
		removemedia : function( e ) {

			// Updates the model for the view.
			this.model.set( { src : '', alt : '', value : '' } );
		}
	} );

}() );
