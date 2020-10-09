( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'multibutton', {

		// Adds custom events.
		events : {
			'click .js-butterbean-multibutton-handlediv' : 'multibuttonClose',

			'click .js-butterbean-multibutton-add'    : 'multibuttonAdd',
			'click .js-butterbean-multibutton-remove' : 'multibuttonRemove',

			'change .js-butterbean-multibutton-title' : 'multibuttonTitleUpdate',

			'click .butterbean-add-media'    : 'showmodal',
			'click .butterbean-change-media' : 'showmodal',
			'click .butterbean-remove-media' : 'removemedia'
		},

		ready: function() {
			var $ = jQuery,
				_this = this;

			$( '.butterbean-multibuttons' ).sortable({
				opacity: 0.6,
				revert: 200,
				cursor: 'move',
				handle: '.butterbean-multibutton-sortable-handle',
				stop: function( e, ui ) {
					_this.multibuttonUpdateOrder();
				}
			});
		},

		multibuttonClose: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$multibutton = $target.parents( '.butterbean-multibutton' );

			$multibutton.toggleClass( 'closed' );
		},

		multibuttonAdd: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$multibuttonTemplate = $( '.butterbean-multibutton-clonable' ),
				index = $( '.butterbean-multibutton' ).last().index() + 1, // items are 0 indexed
				multibuttonName = 'Shop Online Button ' + (index + 1),
				settingName = this.model.attributes.field_name,
				$multibuttonsContainer = $( '.butterbean-multibuttons' );

			cloneHtml = $multibuttonTemplate.prop( 'outerHTML' );

			cloneHtml = cloneHtml.replace( /_multibutton_name_/g, multibuttonName );
			cloneHtml = cloneHtml.replace( /_setting_name_/g, settingName );
			cloneHtml = cloneHtml.replace( /_index_/g, index );

			$clone = $( cloneHtml ).appendTo( $multibuttonsContainer ).removeClass( 'butterbean-multibutton-clonable' );
		},

		multibuttonRemove: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$multibutton = $target.parents( '.butterbean-multibutton' );

			$multibutton.remove();
		},

		multibuttonTitleUpdate: function( e ) {
			var $ = jQuery,
				$target = $( e.currentTarget ),
				$multibutton = $target.parents( '.butterbean-multibutton' ),
				$headingTitle = $multibutton.find( 'h2 .-multibutton-title' );

				$headingTitle.text( $target.val() );
		},

		multibuttonUpdateOrder: function() {
			var $ = jQuery;

			$( '.butterbean-multibuttons .butterbean-multibutton' ).each( function( i ) {
				var indexText = i + 1;
				$( this ).find( 'h2 span' ).text( 'Shop Online Button ' + indexText );
				$( this ).find( 'input.index' ).val( i );
			});
		},

		// Executed when the show modal button is clicked.
		showmodal : function( e ) {

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$imageIdInput = $target.parents( '.butterbean-multibutton' ).find( '.butterbean-img-id-input' ),
				$image = $target.parents( '.butterbean-multibutton' ).find( '.butterbean-img' );

			// If we already have a media modal, open it.
			if ( ! _.isUndefined( this.media_modal ) ) {

				// Update the image variables.
				this.media_modal.options.data.image_id_input = $imageIdInput;

				// Update the image src.
				this.media_modal.options.data.image_element = $image;

				// Open.
				this.media_modal.open();
				return;
			}

			// Create a new media modal.
			this.media_modal = wp.media( {
				data     : {
					image_id_input : $imageIdInput,
					image_element  : $image,
				},
				frame    : 'select',
				multiple : false,
				editing  : true,
				title    : this.model.get( 'l10n' ).choose,
				library  : { type : 'image' },
				button   : { text:  this.model.get( 'l10n' ).set }
			} );

			// Runs when an image is selected in the media modal.
			this.media_modal.on( 'select', function() {

				// Gets the JSON data for the first selection.
				var media = this.media_modal.state().get( 'selection' ).first().toJSON();

				// Check if it is a svg file
				if (media.sizes) {
					// Size of image to display.
					var size = this.model.attributes.size;

					// URL of image
					var imageURL = media.sizes[ size ] ? media.sizes[ size ]['url'] : media.url;
				} else {
					// URL of image
					var imageURL = media.url;
				}

				// Update the image id input
				this.media_modal.options.data.image_id_input.val( media.id );

				// Update the image src
				this.media_modal.options.data.image_element.attr( 'src', imageURL );
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
