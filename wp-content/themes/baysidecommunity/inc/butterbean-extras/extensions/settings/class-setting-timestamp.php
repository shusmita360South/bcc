<?php
/**
 * Timestamp setting class.  This is meant to be used in conjunction with the
 * `ButterBean_Timestamp_Control` or a sub-class that passes the appropriate values.
 *
 * @package    ButterBean
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock
 * @link       https://github.com/justintadlock/butterbean
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Date setting class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_Setting_Timestamp extends ButterBean_Setting {

	/**
	 * The type of setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'timestamp';

	/**
	 * Gets the posted value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function get_posted_value() {
		$field_name = $this->get_field_name();

		// Get the posted date.
		$year  = ! empty( $_POST[ "{$field_name}_year" ] )  ? zeroise( absint( $_POST[ "{$field_name}_year" ] ),  4 ) : '';
		$month = ! empty( $_POST[ "{$field_name}_month" ] ) ? zeroise( absint( $_POST[ "{$field_name}_month" ] ), 2 ) : '';
		$day   = ! empty( $_POST[ "{$field_name}_day" ] )   ? zeroise( absint( $_POST[ "{$field_name}_day" ] ),   2 ) : '';

		// Get the posted time.
		// $hour   = ! empty( $_POST[ "{$field_name}_hour" ] )    ? $this->validate_hour(   $_POST[ "{$field_name}_hour" ] )   : '00';
		// $minute = ! empty( $_POST[ "{$field_name}_minute" ] )  ? $this->validate_minute( $_POST[ "{$field_name}_minute" ] ) : '00';

		$date = "{$year}-{$month}-{$day}";
		// $time = "{$hour}:{$minute}";

		if ( $year && $month && $day && wp_checkdate( absint( $month ), absint( $day ), absint( $year ), $date ) ) {
			$timestamp = mktime( 0, 0, 0, absint( $month ), absint( $day ), absint( $year ) );

			return $timestamp;
		}

		return '';
	}

	/**
	 * Validates the hour.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  int|string  $hour
	 * @return string
	 */
	public function validate_hour( $hour ) {

		$hour = absint( $hour );

		return $hour < 0 || $hour > 23 ? zeroise( $hour, 2 ) : '00';
	}

	/**
	 * Validates the minute.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  int|string  $minute
	 * @return string
	 */
	public function validate_minute( $minute ) {

		$minute = absint( $minute );

		return $minute < 0 || $minute > 59 ? zeroise( $minute, 2 ) : '00';
	}
}
