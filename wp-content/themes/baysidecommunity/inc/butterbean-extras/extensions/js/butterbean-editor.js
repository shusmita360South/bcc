( function() {

	/**
	 * Adds the editor view.
	 *
	 * @since  1.0.0
	 */
    butterbean.views.register_control( 'editor', {
        ready: function() {
            if ( 'undefined' !== typeof tinyMCE ) {
                tinyMCE.init({
                    selector: '#' + this.model.get( 'field_name' ),
                    menubar: false,
                    statusbar: false,
                    height: 250,
                    content_css: butterbeanEditorParams.includes_url + 'js/tinymce/skins/wordpress/wp-content.css',
                    plugins: [
                        'wordpress lists wplink charmap',
                        'wpview paste'
                    ],
                    style_formats: [
                        { title: 'Heading 3', block: 'h3' },
                        { title: 'Heading 4', block: 'h4' },
                        { title: 'Paragraph', block: 'p' },
                    ],
                    toolbar: 'undo redo | styleselect | bold italic | bullist numlist outdent indent | link',
                });
            }
        }
    } );

}() );
