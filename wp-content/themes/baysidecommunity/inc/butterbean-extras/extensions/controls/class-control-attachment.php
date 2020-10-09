<?php
/**
 * Attachment control class.
 */
class ButterBean_Control_Attachment extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'attachment';

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
				'toggle_panel'       => esc_html__( 'Toggle panel',           'butterbean' ),
				'attachment'         => esc_html__( 'Attachment',             'butterbean' ),
				'upload'             => esc_html__( 'Add Attachment',         'butterbean' ),
				'set'                => esc_html__( 'Set as Attachment',      'butterbean' ),
				'choose'             => esc_html__( 'Choose Attachment',      'butterbean' ),
				'change'             => esc_html__( 'Change Attachment',      'butterbean' ),
				'remove'             => esc_html__( 'Remove Attachment',      'butterbean' ),
				'placeholder'        => esc_html__( 'No attachment selected', 'butterbean' ),
				'remove_attachment'  => esc_html__( 'Remove Attachment',      'butterbean' ),
				'add_attachment'     => esc_html__( 'Add Attachment',         'butterbean' ),
				'title'              => esc_html__( 'Title',                  'butterbean' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		// Enqueue the main plugin script.
		wp_enqueue_script( 'butterbean-attachment', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-attachment.js', array( 'butterbean' ), '', true );
		wp_enqueue_style( 'butterbean-attachment', get_template_directory_uri() . '/inc/butterbean-extras/extensions/css/butterbean-attachment.css', array(), '' );

		// add extra data
		$data = array(
			'includes_url' => includes_url(),
		);
		wp_localize_script( 'butterbean-attachment', 'butterbeanAttachmentParams', $data );
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['l10n'] = $this->l10n;

		if ($this->json['value']) {
			$this->json['filename'] = wp_get_attachment_url($this->json['value']);
		} else {
			$this->json['filename'] = '';
		}

		$this->json['name'] = $this->get_field_name( $this->setting );
	}

	/**
	 * Gets the attributes for the control.
	 * Sets the new id attribute, as it's required for TinyMCE to function properly.
	 * Sets new class .tinymce for easier js initialization.
	 *
	 * @return array
	 */
	public function get_attr() {
		$this->attr = parent::get_attr();

		return $this->attr;
	}
}