( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'feature_tiles', {

		// Adds custom events.
		events : {
			'click .js-butterbean-tile-handlediv' : 'tileClose',

			'click .js-butterbean-tile-add'    : 'tileAdd',
			'click .js-butterbean-tile-remove' : 'tileRemove',

			'click .butterbean-add-media'    : 'showmodal',
			'click .butterbean-change-media' : 'showmodal',
			'click .butterbean-remove-media' : 'removemedia'
		},

		ready: function() {
			var $ = jQuery,
				_this = this;

			$( '.butterbean-tiles' ).sortable({
				opacity: 0.6,
				revert: 200,
				cursor: 'move',
				handle: '.butterbean-tile-sortable-handle',
				stop: function( e, ui ) {
					_this.tileUpdateOrder();
				}
			});
		},

		tileClose: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$tile = $target.parents( '.butterbean-tile' );

			$tile.toggleClass( 'closed' );
		},

		tileAdd: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$tileTemplate = $( '.butterbean-tile-clonable' ),
				index = $( '.butterbean-tile' ).last().index() + 1, // items are 0 indexed
				tileName = 'tile ' + (index + 1),
				settingName = this.model.attributes.field_name,
				$tilesContainer = $( '.butterbean-tiles' );

			cloneHtml = $tileTemplate.prop( 'outerHTML' );

			cloneHtml = cloneHtml.replace( /_tile_name_/g, tileName );
			cloneHtml = cloneHtml.replace( /_setting_name_/g, settingName );
			cloneHtml = cloneHtml.replace( /_index_/g, index );

			$clone = $( cloneHtml ).appendTo( $tilesContainer ).removeClass( 'butterbean-tile-clonable' );
		},

		tileRemove: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$tile = $target.parents( '.butterbean-tile' );

			$tile.remove();
		},

		tileUpdateOrder: function() {
			var $ = jQuery;

			$( '.butterbean-tiles .butterbean-tile' ).each( function( i ) {
				var indexText = i + 1;
				$( this ).find( 'h2 span' ).text( 'tile ' + indexText );
				$( this ).find( 'input.index' ).val( i );
			});
		},

		// Executed when the show modal button is clicked.
		showmodal : function( e ) {

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$imageIdInput = $target.parents( '.butterbean-tile' ).find( '.butterbean-img-id-input' ),
				$image = $target.parents( '.butterbean-tile' ).find( '.butterbean-img' );

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
				library  : { type : 'image' },
				title    : this.model.get( 'l10n' ).choose,
				button   : { text:  this.model.get( 'l10n' ).set }
			} );

			// Runs when an image is selected in the media modal.
			this.media_modal.on( 'select', function() {

				// Gets the JSON data for the first selection.
				var media = this.media_modal.state().get( 'selection' ).first().toJSON();

				// Size of image to display.
				var size = this.model.attributes.size;

				// URL of image
				var imageURL = media.sizes[ size ] ? media.sizes[ size ]['url'] : media.url;

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
