( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'heroslider', {

		// Adds custom events.
		events : {
			'click .js-butterbean-heroslide-handlediv' : 'heroslideClose',

			'click .js-butterbean-heroslide-add'    : 'heroslideAdd',
			'click .js-butterbean-heroslide-remove' : 'heroslideRemove',
			'click .js-butterbean-heroslide-disable' : 'heroslideDisable',

			'change .js-butterbean-heroslide-title' : 'heroslideTitleUpdate',

			'click .butterbean-add-media'    : 'showmodal',
			'click .butterbean-change-media' : 'showmodal',
			'click .butterbean-remove-media' : 'removemedia'
		},

		ready: function() {
			var $ = jQuery,
				_this = this;

			$( '.butterbean-heroslides' ).sortable({
				opacity: 0.6,
				revert: 200,
				cursor: 'move',
				handle: '.butterbean-heroslide-sortable-handle',
				stop: function( e, ui ) {
					_this.heroslideUpdateOrder();
				}
			});
		},

		heroslideClose: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$heroslide = $target.parents( '.butterbean-heroslide' );

			$heroslide.toggleClass( 'closed' );
		},

		heroslideAdd: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$heroslideTemplate = $( '.butterbean-heroslide-clonable' ),
				index = $( '.butterbean-heroslide' ).last().index() + 1, // items are 0 indexed
				heroslideName = 'Slide ' + index,
				settingName = this.model.attributes.field_name,
				$heroslidesContainer = $( '.butterbean-heroslides' );

			cloneHtml = $heroslideTemplate.prop( 'outerHTML' );

			cloneHtml = cloneHtml.replace( /_heroslide_name_/g, heroslideName );
			cloneHtml = cloneHtml.replace( /_setting_name_/g, settingName );
			cloneHtml = cloneHtml.replace( /_index_/g, index );

			$clone = $( cloneHtml ).appendTo( $heroslidesContainer ).removeClass( 'butterbean-heroslide-clonable' );
		},

		heroslideRemove: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$heroslide = $target.parents( '.butterbean-heroslide' );

			$heroslide.remove();
		},

		heroslideDisable: function( e ) {
			var $ = jQuery,
				$target = $( e.currentTarget ),
				$heroslide = $target.parents( '.butterbean-heroslide' ),
				$heading = $heroslide.find( 'h2 .-heroslide-number' )
				headingText = $heading.text(),
				disabledBracketsText = this.model.get( 'l10n' ).disabled_brackets,
				disabledBracketsTextRegex = this.model.get( 'l10n' ).disabled_brackets.replace( /[\(\){}]/g, '\\$&' ), // escape brackets
				re = '';

			if ( $heroslide.hasClass( 'butterbean-heroslide-disabled' ) ) {
				$heroslide.removeClass( 'butterbean-heroslide-disabled' );

				// removed the disabled text
				re = new RegExp( disabledBracketsTextRegex, 'g' );
				headingText = headingText.replace( re, '' );
				$heading.text( headingText );
			} else {
				$heroslide.addClass( 'butterbean-heroslide-disabled closed' );

				// add the disabled text
				$heading.text( headingText + ' ' + disabledBracketsText );
			}
		},

		heroslideTitleUpdate: function( e ) {
			var $ = jQuery,
				$target = $( e.currentTarget ),
				$heroslide = $target.parents( '.butterbean-heroslide' ),
				$headingTitle = $heroslide.find( 'h2 .-heroslide-title' );

				$headingTitle.text( $target.val() );
		},

		heroslideUpdateOrder: function() {
			var $ = jQuery;

			$( '.butterbean-heroslides .butterbean-heroslide' ).each( function( i ) {
				var indexText = i + 1;
				$( this ).find( 'h2 span' ).text( 'Slide ' + indexText );
				$( this ).find( 'input.index' ).val( i );
			});
		},

		// Executed when the show modal button is clicked.
		showmodal : function( e ) {

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$imageIdInput = $target.parents( '.butterbean-heroslide' ).find( '.butterbean-img-id-input' ),
				$image = $target.parents( '.butterbean-heroslide' ).find( '.butterbean-img' );

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
