<?php
/**
 * Slider control class.
 */
class ButterBean_Control_Location_Lat_Long extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'location_to_lat_long';

	/**
	 * Array of text labels to use for the media upload frame.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

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
				'generate'  => esc_html__( 'Generate Lat/Long', 'butterbean' ),
				'latitude'  => esc_html__( 'Latitude',          'butterbean' ),
				'longitude' => esc_html__( 'Longitude',         'butterbean' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAI2tO8BNLSxPhrHazs2xn-P-2wXs0t3bg', '', true );

		wp_enqueue_script( 'butterbean-location-lat-long', plugin_dir_url( __DIR__ ) . '/js/butterbean-location-lat-long.js', array( 'butterbean', 'google-maps-api' ), '', true );
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['l10n'] = $this->l10n;

		$post_id = $this->manager->post_id;
		$meta_name = $this->settings['default'];
		$lat_meta_name = $meta_name . '_latitude';
		$long_meta_name = $meta_name . '_longitude';

		$lat_input_name = "butterbean_{$this->manager->name}_setting_" . $lat_meta_name;
		$long_input_name = "butterbean_{$this->manager->name}_setting_" . $long_meta_name;

		$lat = get_post_meta( $post_id, $lat_meta_name, true );
		$long = get_post_meta( $post_id, $long_meta_name, true );

		$this->json['lat'] = $lat;
		$this->json['long'] = $long;
		$this->json['lat_input_name'] = $lat_input_name;
		$this->json['long_input_name'] = $long_input_name;
	}
}
