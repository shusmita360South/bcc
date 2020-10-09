<?php
/**
 * Multi Select control class.
 */
class ButterBean_Control_Multi_Select extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'multi_select';

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
				''  => esc_html__( '', 'butterbean' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		wp_enqueue_script( 'selectize', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/selectize.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'butterbean-multi-select', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-multi-select.js', array( 'butterbean', 'selectize' ), '', true );
		wp_enqueue_style( 'butterbean-multi-select', get_template_directory_uri() . '/inc/butterbean-extras/extensions/css/butterbean-multi-select.css', array(), '' );
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

		$value = get_post_meta( $post_id, $meta_name, true );

		// ensure the data gets saved as an array
		$input_name = "butterbean_{$this->manager->name}_setting_" . $meta_name . '[]';
		$this->json['input_name'] = $input_name;
	}
}

function butterbean_sanitize_multi_select( $data_array ) {
	if ( ! $data_array || ! is_array( $data_array ) ) {
		$data_array = array();
	}

	$data = json_encode( $data_array );

	return $data;
}
