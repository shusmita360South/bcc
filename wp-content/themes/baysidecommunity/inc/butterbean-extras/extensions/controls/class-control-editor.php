<?php
/**
 * TinyMCE control class.
 */
class ButterBean_Control_Editor extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'editor';

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		// Enqueue the main plugin script.
		//wp_enqueue_script( 'butterbean-editor', plugin_dir_url( __DIR__ ) . '/js/butterbean-editor.js', array( 'butterbean' ), '', true );
		wp_enqueue_script( 'butterbean-editor', get_template_directory_uri() . '/inc/butterbean-extras/extensions/js/butterbean-editor.js', array( 'butterbean' ), '', true );
		// add extra data
		$data = array(
			'includes_url' => includes_url(),
		);
		wp_localize_script( 'butterbean-editor', 'butterbeanEditorParams', $data );
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->get_value();
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

		$this->attr['class'] .= ' editor';
		$this->attr['id'] = $this->get_field_name();

		return $this->attr;
	}
}
