/**
 * Remove squared button style
 *
 * @since Bayside Community 1.0
 */
/* global wp */
wp.domReady( function() {
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
} );
