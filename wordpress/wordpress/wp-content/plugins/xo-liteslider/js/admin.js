jQuery( function ( $ ) {
	$( '#xo-slider-slide' ).each( function ( i, e ) {
		var wrapper = $( e );
		var count = wrapper.find( '.slide' ).length;

		// Add slide.
		wrapper.find( '.slide-header-append-button' ).click( function () {
			count++;
			var parent = $( this ).parents( '.slide' );
			var clone = parent.clone( true, true ).hide();

			// Bug countermeasures where select values are not cloned
			parent.find( 'select' ).each( function ( i, e ) { clone.find( "[name='" + $(this).attr('name') + "']" ).val( $(this).val() ); });

			clone.find( 'input, select, textarea, label' ).each( function ( i, e ) {
				var attrname = $( this ).attr( 'name' );
				if ( attrname ) {
					$( this ).attr(
						'name',
						attrname.replace(
							/^(xo_slider_slides)\[(.+?)\]/,
							'$1[' + count + ']'
						)
					);
				}
				var attrfor = $( this ).attr( 'for' );
				if ( attrfor ) {
					$( this ).attr(
						'for',
						attrfor.replace(
							/^(xo_slider_slides)\[(.+?)\]/,
							'$1[' + count + ']'
						)
					);
				}
				var attrid = $( this ).attr( 'id' );
				if ( attrid ) {
					$( this ).attr(
						'id',
						attrid.replace(
							/^(xo_slider_slides)\[(.+?)\]/,
							'$1[' + count + ']'
						)
					);
				}
			} );

			clone.find( 'input, textarea, label' ).each( function ( i, e ) {
				$( this ).val( '' );
			} );

			clone.find( 'img' ).remove();
			clone.find( '.filename' ).remove();
			clone.find( '.message' ).show();
			parent.after( clone.fadeIn( 'normal' ) );
		} );

		// Delete slide.
		wrapper.find( '.slide-header-remove-button' ).click( function () {
			var slide = $( this ).parents( '.slide' );
			slide.fadeOut( 'normal', function () {
				$( this ).remove();
			} );
		} );

		// Opening and closing the slide panel.
		wrapper.find( '.slide-header-toggle-button' ).click( function () {
			var slide = $( this ).parents( '.slide' );
			slide.toggleClass( 'closed' );
		} );

		// Sort slide.
		wrapper.find( '.slide-repeat' ).sortable( {
			handle: '.slide-header',
		} );

		// Set image.
		wrapper.find( '.slide-image' ).click( function ( e ) {
			e.preventDefault();
			var custom_uploader_file;
			var outputImage = $( this )
				.parent()
				.parent()
				.find( '.slide-image' );
			var outputMediaType = $( this ).parent().find( '.slide-media-type' );
			var outputId = $( this ).parent().find( '.slide-media-id' );
			var outputLink = $( this ).parent().find( '.slide-media-link' );

			if ( custom_uploader_file ) {
				custom_uploader_file.open();
				return;
			}

			custom_uploader_file = wp.media( {
				title: messages.title,
				button: { text: messages.button },
				library: { type: 'image,video' },
				multiple: false,
				frame: 'post',
			} );

			//custom_uploader_file.on( 'select', function () {
			custom_uploader_file.on( 'close', function () {
				if ( 'embed' == custom_uploader_file.state().get( 'id' ) ) {
					var embed = custom_uploader_file.state().props.toJSON();
					embed.url = embed.url || '';
					var mat = embed.url.match( /[\/?=]([a-zA-Z0-9_\-]{11})[&\?]?/ );
					if ( mat[1] ) {
						outputMediaType.val( 'youtube' );
						outputId.val( '0' );
						outputLink.val( embed.url );
						outputImage.find( '.message' ).hide();
						outputImage.find( 'img' ).remove();
						outputImage.prepend( '<img src="http://img.youtube.com/vi/' + mat[1] + '/default.jpg">' );
						outputImage.append( '<div class="filename"><div>' + embed.url + '</div></div>' );
					}
				} else {
					var images = custom_uploader_file.state().get( 'selection' );
					images.each( function ( file ) {
						var attachment = file.toJSON();
						if ( 'image' == attachment.type ) {
							outputMediaType.val( 'image' );
							outputId.val( attachment.id );
							outputLink.val( '' );
							outputImage.find( '.message' ).hide();
							outputImage.find( 'img' ).remove();
							outputImage.prepend( '<img src="' + attachment.sizes.thumbnail.url + '">' );
							outputImage.find( '.filename' ).remove();
						} if ( 'video' == attachment.type ) {
							outputMediaType.val( 'video' );
							outputId.val( attachment.id );
							outputLink.val( '' );
							outputImage.find( '.message' ).hide();
							outputImage.find( 'img' ).remove();
							outputImage.prepend( '<img src="' + attachment.image.src + '">' );
							outputImage.find( '.filename' ).remove();
							outputImage.append( '<div class="filename"><div>' + attachment.filename + '</div></div>' );
						}
					} );
				}
			} );
			custom_uploader_file.open();
		} );

		// Delete image.
		wrapper.find( '.slide-image-clear' ).click( function ( e ) {
			e.preventDefault();
			$( this ).parent().find( '.slide-media-id' ).val( '' );
			$( this ).parent().find( 'img' ).remove();
			$( this ).parent().find( '.filename' ).remove();
			$( this ).parent().find( '.message' ).show();
		} );

		// Slide panel tab.
		wrapper.find( '.slide-panel-tabs' ).click( function ( e ) {
			var target = $( e.target );
			if ( target.hasClass( 'nav-tab-link' ) ) {
				panelId = target.data( 'type' );
				wrapper = target.parents( '.slide-panel-wrapper' ).first();
				$( '.tabs-panel-active', wrapper )
					.removeClass( 'tabs-panel-active' )
					.addClass( 'tabs-panel-inactive' );
				$( '.tabs-' + panelId, wrapper )
					.removeClass( 'tabs-panel-inactive' )
					.addClass( 'tabs-panel-active' );
				$( '.tabs', wrapper ).removeClass( 'tabs' );
				target.parent().addClass( 'tabs' );
			}
			return false;
		} );
	} );

	// Parameter panel tab.
	$( '#xo-slider-parameter .parameter-panel-tabs' ).click( function ( e ) {
		var target = $( e.target );
		if ( target.hasClass( 'nav-tab-link' ) ) {
			panelId = target.data( 'type' );
			wrapper = target.parents( '.parameter-panel-wrapper' ).first();
			$( '.tabs-panel-active', wrapper )
				.removeClass( 'tabs-panel-active' )
				.addClass( 'tabs-panel-inactive' );
			$( '.tabs-' + panelId, wrapper )
				.removeClass( 'tabs-panel-inactive' )
				.addClass( 'tabs-panel-active' );
			$( '.tabs', wrapper ).removeClass( 'tabs' );
			target.parent().addClass( 'tabs' );
		}
		return false;
	} );

	// Select template.
	$( '#template-select' ).change( function () {
		const templateId = $( '#template-select' ).val();
		$( '#xo-slider-template .template-description' )
			.removeClass( 'active' )
			.addClass( 'inactive' );
		$( '#xo-slider-template .template-description-' + templateId )
			.removeClass( 'inactive' )
			.addClass( 'active' );
	} );
} );
