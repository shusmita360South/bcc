<?php
/**
 * Multilocation control class.
 */
class ButterBean_Control_Multilocation extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'multilocation';

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
				
				'heading'            => esc_html__( 'Heading',           'butterbean' ),
				'date'  => esc_html__( 'Date', 'butterbean' ),
				'datetext'  => esc_html__( 'Date Text', 'butterbean' ),
				'starttime'			 => esc_html__( 'Start Time',        	 'butterbean' ),
				'endtime'			 => esc_html__( 'End Time',        	 'butterbean' ),
				'address'			 => esc_html__( 'Address',        	 'butterbean' ),
				'remove_multilocation'     => esc_html__( 'Remove Location', 	 'butterbean' ),
				'add_multilocation'        => esc_html__( 'Add Location',    	 'butterbean' )
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'butterbean-multilocation', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-multilocation.js', array( 'butterbean' ), 2, true );
		wp_enqueue_style( 'butterbean-multilocation', get_template_directory_uri() . '/inc/butterbean-extras/extensions/css/butterbean-multilocation.css', array(), 2 );
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

				$this->json['multilocations'][] = $value;
			}
		} else {
			$this->json['multilocations'] = array(
				array(
					'heading' => '',
					'date' => '',
					'datetext' => '',
					'starttime' => '',
					'endtime' => '',
					'address' => ''
				),
			);
		}

		$this->json['name'] = $this->get_field_name( $this->setting );
	}
}

function butterbean_sanitize_multilocation( $data ) {
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
