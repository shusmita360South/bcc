( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
	butterbean.views.register_control( 'pin', {

		// Adds custom events.
		events : {
			'click .js-butterbean-pin-handlediv' : 'pinClose',

			'click .js-butterbean-pin-add'    : 'pinAdd',
			'click .js-butterbean-pin-remove' : 'pinRemove',

			'change .js-butterbean-pin-title' : 'pinTitleUpdate',

			'click .butterbean-add-media'    : 'showmodal',
			'click .butterbean-change-media' : 'showmodal',
			'click .butterbean-remove-media' : 'removemedia',
			'click .butterbean-add-media-icon'    : 'showmodalIcon',
			'click .butterbean-change-media-icon' : 'showmodalIcon',
			'click .butterbean-remove-media-icon' : 'removemediaIcon'
		},

		ready: function() {
			var $ = jQuery,
				_this = this;

			var $children = $( '.butterbean-pins' ).children();

			$( ".target-pin" ).draggable({
				containment: "#butterbean-pin-image-container",
				scroll: false,
			    drag: function(event, ui) {
			        var index  = $(this).index() - 1;

			        $children.eq(index).find( '.butterbean-pos-x-input' ).val(parseInt(ui.position.left));
			        $children.eq(index).find( '.butterbean-pos-y-input' ).val(parseInt(ui.position.top));
			    }
			});

			$( '.butterbean-pins' ).sortable({
				opacity: 0.6,
				revert: 200,
				cursor: 'move-icon',
				handle: '.butterbean-pin-sortable-handle',
				stop: function( e, ui ) {
					_this.pinUpdateOrder();
				}
			});

			$( '.js-butterbean-pin-iconid' ).each(function() {
				$(this).val($(this).attr('data-value'));
			});
		},

		pinClose: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$pin = $target.parents( '.butterbean-pin' );

			$pin.toggleClass( 'closed' );
		},

		pinAdd: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$pinTemplate = $( '.butterbean-pin-clonable' ),
				index = $( '.butterbean-pin' ).last().index() + 1, // items are 0 indexed
				pinName = 'Pin ' + (index + 1),
				settingName = this.model.attributes.field_name,
				$pinsContainer = $( '.butterbean-pins' ),
				$imageContainer = $( '.butterbean-pin-image-container' ),
				pinHtml = '<div class="target-pin" style="top: 0; left: 0;"></div>';

			cloneHtml = $pinTemplate.prop( 'outerHTML' );

			cloneHtml = cloneHtml.replace( /_pin_name_/g, pinName );
			cloneHtml = cloneHtml.replace( /_setting_name_/g, settingName );
			cloneHtml = cloneHtml.replace( /_index_/g, index );

			$( pinHtml ).appendTo( $imageContainer );

			$clone = $( cloneHtml ).appendTo( $pinsContainer ).removeClass( 'butterbean-pin-clonable' );
			
			$( ".target-pin" ).draggable({
				containment: "#butterbean-pin-image-container",
				scroll: false,
			    drag: function(event, ui) {
			        var index  = $(this).index() - 1;

			        $pinsContainer.children().eq(index).find( '.butterbean-pos-x-input' ).val(parseInt(ui.position.left));
			        $pinsContainer.children().eq(index).find( '.butterbean-pos-y-input' ).val(parseInt(ui.position.top));
			    }
			});
		},

		pinRemove: function( e ) {
			e.preventDefault();

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$pin = $target.parents( '.butterbean-pin' );

			var index = $pin.index();

			$( '.target-pin' ).eq(index).remove();

			$pin.remove();
		},

		pinTitleUpdate: function( e ) {
			var $ = jQuery,
				$target = $( e.currentTarget ),
				$pin = $target.parents( '.butterbean-pin' ),
				$headingTitle = $pin.find( 'h2 .-pin-title' );

				$headingTitle.text( $target.val() );
		},

		pinUpdateOrder: function() {
			var $ = jQuery;

			$( '.butterbean-pins .butterbean-pin' ).each( function( i ) {
				var indexText = i + 1;
				$( this ).find( 'h2 span' ).text( 'Pin ' + indexText );
				$( this ).find( 'input.index' ).val( i );
			});
		},

		// Executed when the show modal button is clicked.
		showmodal : function( e ) {
			this.showmodalDo( e, 'image' );
		},

		showmodalIcon : function( e ) {
			this.showmodalDo( e, 'icon' );
		},

		showmodalDo : function( e, type ) {

			var $ = jQuery,
				$target = $( e.currentTarget ),
				$imageIdInput = $target.parents( '.butterbean-pin-image' ).find( '.butterbean-img-id-input' ),
				$image = $target.parents( '.butterbean-pin-image' ).find( '.butterbean-img-src' );
				$iconIdInput = $target.parents( '.butterbean-pin' ).find( '.butterbean-icon-id-input' ),
				$icon = $target.parents( '.butterbean-pin' ).find( '.butterbean-icon-src' );

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
					icon_id_input : $iconIdInput,
					icon_element  : $icon,
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

				
				if ( 'image' == type ) {
					// Update the image id input
					this.media_modal.options.data.image_id_input.val( media.id );

					// Update the image src
					this.media_modal.options.data.image_element.attr( 'src', imageURL );
				} else  {
					// Update the image id input
					this.media_modal.options.data.icon_id_input.val( media.id );

					// Update the image src
					this.media_modal.options.data.icon_element.attr( 'src', imageURL );
				}
				
				console.log($iconIdInput);
				console.log($icon);

				
			}, this );

			// Opens the media modal.
			this.media_modal.open();
		},

		// Executed when the remove media button is clicked.
		removemedia : function( e ) {

			// Updates the model for the view.
			this.model.set( { img_src : '', img_id : '' } );
		}
	} );

}() );
