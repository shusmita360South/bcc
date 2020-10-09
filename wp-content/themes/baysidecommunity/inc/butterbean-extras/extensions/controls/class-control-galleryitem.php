<?php
/**
 * Galleryitem control class.
 */
class ButterBean_Control_Galleryitem extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'galleryitem';

	/**
	 * Array of text labels to use for the media upload frame.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Image size to display.  If the size isn't found for the image,
	 * the full size of the image will be output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $size = 'large';

	/**
	 * Creates a new control object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $name
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $name, $args = array() ) {
		parent::__construct( $manager, $name, $args );

		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'notice'               => esc_html__( 'Selection will be available after saving', 'butterbean' ),
				'toggle_panel'         => esc_html__( 'Toggle panel',         'butterbean' ),
				'image'                => esc_html__( 'Image',                'butterbean' ),
				'upload'               => esc_html__( 'Add image',            'butterbean' ),
				'set'                  => esc_html__( 'Set as image',         'butterbean' ),
				'choose'               => esc_html__( 'Choose image',         'butterbean' ),
				'change'               => esc_html__( 'Change image',         'butterbean' ),
				'remove'               => esc_html__( 'Remove image',         'butterbean' ),
				'placeholder'          => esc_html__( 'No image selected',    'butterbean' ),
				'subheading'           => esc_html__( 'Heading',           'butterbean' ),
				'heading'              => esc_html__( 'Content',              'butterbean' ),
			
				'subtitle'          => esc_html__( 'Subtitle',          'butterbean' ),
				'artist'         => esc_html__( 'Artist',         'butterbean' ),
				'remove_slide'         => esc_html__( 'Remove Slide',         'butterbean' ),
				'add_slide'            => esc_html__( 'Add Slide',            'butterbean' )
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'butterbean-galleryitem', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-galleryitem.js', array( 'butterbean' ), 2, true );
		wp_enqueue_style( 'butterbean-galleryitem', get_template_directory_uri() . '/inc/butterbean-extras/extensions/css/butterbean-galleryitem.css', array(), 2 );
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['l10n'] = $this->l10n;
		$this->json['size'] = $this->size;
		
		$choices = array();

		if ( $posts = get_posts(array('numberposts' => -1)) ) {
			foreach ( $posts as $post ) {
				$choices['Posts'][$post->ID] = $post->post_title;
			}
		}

		if ( $pages = get_pages() ) {
			foreach ( $pages as $page ) {
				$choices['Pages'][$page->ID] = $page->post_title;
			}
		}

		if ( $collection = get_posts(array('numberposts' => -1, 'post_type' => 'collection')) ) {
			foreach ( $collection as $item ) {
				$choices['Collection'][$item->ID] = $item->post_title;
			}
		}
		
		$this->json['choices'] = $choices;

		$value_array = $this->get_value();

		$this->json['galleryitems'][] = array(
			'index' => -1,
			'image_id' => '',
			'image_src' => '',
			'image_link' => '',
			'subheading' => '',
			'heading' => '',
			'subtitle' => '',
			'artist' => ''
		);

		if ( $value_array ) {
			foreach ( $value_array as $value ) {
				if ( $value['image_id'] ) {
					$image = wp_get_attachment_image_src( absint( $value['image_id'] ), $this->size );
				} else {
					$image = false;
				}

				$value['image_src'] = $image ? esc_url( $image[0] ) : '';
				
				$this->json['galleryitems'][] = $value;
			}
		}

		$this->json['name'] = $this->get_field_name( $this->setting );
	}	
}

function butterbean_sanitize_galleryitem( $galleryitem_data ) {
	if ( ! $galleryitem_data || ! is_array( $galleryitem_data ) ) {
		$galleryitem_data = array();

		return $galleryitem_data;
	}

	usort( $galleryitem_data, function ( $item1, $item2 ) {
	    if ( $item1['index'] == $item2['index'] ) return 0;

	    return $item1['index'] < $item2['index'] ? -1 : 1;
	});

	return $galleryitem_data;
}
