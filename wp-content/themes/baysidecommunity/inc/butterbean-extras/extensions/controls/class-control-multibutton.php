<?php
/**
 * Multibutton control class.
 */
class ButterBean_Control_Multibutton extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'multibutton';

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
				'buttontext'            => esc_html__( 'Button Text',           'butterbean' ),
				'buttonlink'			 => esc_html__( 'Button Link',        	 'butterbean' ),
				'remove_multibutton'     => esc_html__( 'Remove Block', 	 'butterbean' ),
				'add_multibutton'        => esc_html__( 'Add Block',    	 'butterbean' )
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'butterbean-multibutton', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-multibutton.js', array( 'butterbean' ), 2, true );
		wp_enqueue_style( 'butterbean-multibutton', get_template_directory_uri() . '/inc/butterbean-extras/extensions/css/butterbean-multibutton.css', array(), 2 );
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
				$this->json['multibuttons'][] = $value;
			}
		} else {
			$this->json['multibuttons'] = array(
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

function butterbean_sanitize_multibutton( $data ) {
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
