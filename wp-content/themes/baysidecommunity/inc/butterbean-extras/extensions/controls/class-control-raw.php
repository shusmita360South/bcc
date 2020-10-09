<?php
/**
 * Raw control class.
 *
 * @package    ButterBean
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Datetime control class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_Control_Raw extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'raw';

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @globl  object  $wp_locale
	 * @return void
	 */
	public function to_json() {
		global $wp_locale;

		parent::to_json();

		$field_name = $this->get_field_name();

		// Year
		$this->json['value'] = json_encode( $this->get_value() );
	}
}
