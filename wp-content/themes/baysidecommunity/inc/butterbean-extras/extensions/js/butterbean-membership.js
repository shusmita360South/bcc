( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'membership', {

		// Adds custom events.
		events : {
			'click .js-butterbean-membership-handlediv' : 'membershipClose',

			'click .js-butterbean-membership-add'    : 'membershipAdd',
			'click .js-butterbean-membership-remove' : 'membershipRemove',

			'change .js-butterbean-membership-title' : 'membershipTitleUpdate',

			'click .butterbean-add-media'    : 'showmodal',
			'click .butterbean-change-media' : 'showmodal',
			'click .butterbean-remove-media' : 'removemedia'
		},

		ready: function() {
			var $ = jQuery,
				_this = this;

			$( '.butterbean-memberships' ).sortable({
				opacity: 0.6,
				revert: 200,
				cursor: 'move',
				handle: '.butterbean-membership-sortable-handle',
				stop: function( e, ui ) {
					_this.membershipUpdateOrder();
				}
			});
		},

		membershipClose: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$membership = $target.parents( '.butterbean-membership' );

			$membership.toggleClass( 'closed' );
		},

		membershipAdd: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$membershipTemplate = $( '.butterbean-membership-clonable' ),
				index = $( '.butterbean-membership' ).last().index() + 1, // items are 0 indexed
				membershipName = 'Slide ' + (index + 1),
				settingName = this.model.attributes.field_name,
				$membershipsContainer = $( '.butterbean-memberships' );

			cloneHtml = $membershipTemplate.prop( 'outerHTML' );

			cloneHtml = cloneHtml.replace( /_membership_name_/g, membershipName );
			cloneHtml = cloneHtml.replace( /_setting_name_/g, settingName );
			cloneHtml = cloneHtml.replace( /_index_/g, index );

			$clone = $( cloneHtml ).appendTo( $membershipsContainer ).removeClass( 'butterbean-membership-clonable' );
		},

		membershipRemove: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$membership = $target.parents( '.butterbean-membership' );

			$membership.remove();
		},

		membershipTitleUpdate: function( e ) {
			var $ = jQuery,
				$target = $( e.currentTarget ),
				$membership = $target.parents( '.butterbean-membership' ),
				$headingTitle = $membership.find( 'h2 .-membership-title' );

				$headingTitle.text( $target.val() );
		},

		membershipUpdateOrder: function() {
			var $ = jQuery;

			$( '.butterbean-memberships .butterbean-membership' ).each( function( i ) {
				var indexText = i + 1;
				$( this ).find( 'h2 span' ).text( 'Slide ' + indexText );
				$( this ).find( 'input.index' ).val( i );
			});
		},

		// Executed when the show modal button is clicked.
		showmodal : function( e ) {

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$imageIdInput = $target.parents( '.butterbean-membership' ).find( '.butterbean-img-id-input' ),
				$image = $target.parents( '.butterbean-membership' ).find( '.butterbean-img' );

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
