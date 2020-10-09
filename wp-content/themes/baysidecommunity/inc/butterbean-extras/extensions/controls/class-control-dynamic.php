<?php
/**
 * Dynamic control class.
 */
class ButterBean_Control_Dynamic extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'dynamic';

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
	public $size = 'small';

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
				'toggle_panel'       => esc_html__( 'Toggle panel',      'butterbean' ),
				'image'              => esc_html__( 'Image',             'butterbean' ),
				'upload'             => esc_html__( 'Add image',         'butterbean' ),
				'set'                => esc_html__( 'Set as image',      'butterbean' ),
				'choose'             => esc_html__( 'Choose image',      'butterbean' ),
				'change'             => esc_html__( 'Change image',      'butterbean' ),
				'remove'             => esc_html__( 'Remove image',      'butterbean' ),
				'heading'            => esc_html__( 'Heading',           'butterbean' ),
				'short_description'  => esc_html__( 'Short Description', 'butterbean' ),
				'videoid'			 => esc_html__( 'Video ID',        	 'butterbean' ),
				'remove_dynamic'     => esc_html__( 'Remove Block', 	 'butterbean' ),
				'add_dynamic'        => esc_html__( 'Add Block',    	 'butterbean' )
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'butterbean-dynamic', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-dynamic.js', array( 'butterbean' ), 2, true );
		wp_enqueue_style( 'butterbean-dynamic', get_template_directory_uri() . '/inc/butterbean-extras/extensions/css/butterbean-dynamic.css', array(), 2 );
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

		$value_array = $this->get_value();

		if ( $value_array ) {
			foreach ( $value_array as $value ) {
				if ( $value['image_id'] ) {
					$image = wp_get_attachment_image_src( absint( $value['image_id'] ), $this->size );
				} else {
					$image = false;
				}

				$value['image_src'] = $image ? esc_url( $image[0] ) : '';

				$this->json['dynamics'][] = $value;
			}
		} else {
			$this->json['dynamics'] = array(
				array(
					'image' => '',
					'videoid' => '',
					'heading' => '',
					'short_description' => ''
				),
			);
		}

		$this->json['name'] = $this->get_field_name( $this->setting );
	}
}

function butterbean_sanitize_dynamic( $data ) {
	if ( ! $data || ! is_array( $data ) ) {
		$data = array();

		return $data;
	}

	usort( $data, function ( $item1, $item2 ) {
	    if ( $item1['index'] == $item2['index'] ) return 0;

	    return $item1['index'] < $item2['index'] ? -1 : 1;
	});

	return $data;
}
