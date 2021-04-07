<?php
/**
 * Feature Tiles control class.
 */
class ButterBean_Control_Feature_Tiles extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'feature_tiles';

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
				'toggle_panel'       => esc_html__( 'Toggle panel',       'butterbean' ),
				'image'              => esc_html__( 'Image',              'butterbean' ),
				'upload'             => esc_html__( 'Add image',          'butterbean' ),
				'set'                => esc_html__( 'Set as image',       'butterbean' ),
				'choose'             => esc_html__( 'Choose image',       'butterbean' ),
				'change'             => esc_html__( 'Change image',       'butterbean' ),
				'remove'             => esc_html__( 'Remove image',       'butterbean' ),
				'placeholder'        => esc_html__( 'No image selected',  'butterbean' ),
				'title'              => esc_html__( 'Title',              'butterbean' ),
				'content'            => esc_html__( 'Content',            'butterbean' ),
				'link'               => esc_html__( 'Link',               'butterbean' ),
				'link_image'         => esc_html__( 'Link Image?',        'butterbean' ),
				'apply_shade'        => esc_html__( 'Apply Shade?',       'butterbean' ),
				'remove_tile'       => esc_html__( 'Remove Tile',         'butterbean' ),
				'add_tile'          => esc_html__( 'Add Tile',            'butterbean' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'butterbean-feature-tiles', plugin_dir_url( __DIR__ ) . '/js/butterbean-feature-tiles.js', array( 'butterbean' ), '', true );

		wp_enqueue_style( 'butterbean-feature-tiles', plugin_dir_url( __DIR__ ) . '/css/butterbean-feature-tiles.css', array(), '' );
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

				$this->json['tiles'][] = $value;
			}
		} else {
			$this->json['tiles'] = array(
				array(
					'image_id' => '',
					'image_src' => '',
					'title' => '',
					'link' => '',
				),
			);
		}

		$this->json['name'] = $this->get_field_name( $this->setting );
	}
}

function butterbean_sanitize_feature_tiles( $tile_data ) {
	if ( ! $tile_data || ! is_array( $tile_data ) ) {
		$tile_data = array();

		return $tile_data;
	}

	usort( $tile_data, function ( $item1, $item2 ) {
	    if ( $item1['index'] == $item2['index'] ) return 0;

	    return $item1['index'] < $item2['index'] ? -1 : 1;
	});

	return $tile_data;
}
