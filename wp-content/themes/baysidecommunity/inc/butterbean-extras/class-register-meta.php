<?php
/**
 * Slider control class.
 */
class VL_Meta_Register_Meta {
	/**
	 * Instance of this class
	 */
	protected static $instance = null;

	/**
	 * The meta data
	 *
	 * @var array
	 */
	public $data = array();

	/**
	 * Return an instance of this class
	 */
	public static function instance() {
		// If the single instance hasn't been set, set it now
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		// register controls
		add_action( 'butterbean_control_template', [ $this, 'butterbean_control_template' ], 10, 2 );
		add_action( 'butterbean_register', [ $this, 'register_control_types' ], 10, 2 );
	}

	/**
	 * Register a new template file for a custom control.
	 *
	 * @param string $located Path to a template file.
	 * @param string $slug Control type.
	 *
	 * @return string
	 */
	public function butterbean_control_template( $located, $slug ) {
		if ( 'multi_select' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-multi-select.php';
		}

		if ( 'editor' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-editor.php';
		}

		if ( 'slider' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-slider.php';
		}

		if ( 'galleryitem' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-galleryitem.php';
		}

		if ( 'membership' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-membership.php';
		}

		if ( 'dynamic' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-dynamic.php';
		}

		if ( 'heroslider' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-heroslider.php';
		}

		if ( 'technology' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-technology.php';
		}

		if ( 'review' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-review.php';
		}

		if ( 'multibutton' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-multibutton.php';
		}
		if ( 'multilocation' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-multilocation.php';
		}
		if ( 'feature_tiles' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-feature-tiles.php';
		}

		if ( 'attachment' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-attachment.php';
		}

		if ( 'location_to_lat_long' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-location-lat-long.php';
		}

		if ( 'timestamp' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-timestamp.php';
		}

		if ( 'raw' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-raw.php';
		}

		if ( 'categories' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-categories.php';
		}

		if ( 'pin' === $slug ) {
			return INCLUDE_FOLDER . 'butterbean-extras/extensions/tmpl/control-pin.php';
		}

		return $located;
	}

	/**
	 * Register Additional Control Types
	 */
	public function register_control_types( $butterbean, $post_type ) {
		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-multi-select.php' );
		$butterbean->register_control_type( 'multi_select', 'ButterBean_Control_Multi_Select' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-editor.php' );
		$butterbean->register_control_type( 'editor', 'ButterBean_Control_Editor' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-slider.php' );
		$butterbean->register_control_type( 'slider', 'ButterBean_Control_Slider' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-galleryitem.php' );
		$butterbean->register_control_type( 'galleryitem', 'ButterBean_Control_Galleryitem' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-membership.php' );
		$butterbean->register_control_type( 'membership', 'ButterBean_Control_Membership' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-dynamic.php' );
		$butterbean->register_control_type( 'dynamic', 'ButterBean_Control_Dynamic' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-heroslider.php' );
		$butterbean->register_control_type( 'heroslider', 'ButterBean_Control_Heroslider' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-technology.php' );
		$butterbean->register_control_type( 'technology', 'ButterBean_Control_Technology' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-multilocation.php' );
		$butterbean->register_control_type( 'multilocation', 'ButterBean_Control_Multilocation' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-review.php' );
		$butterbean->register_control_type( 'review', 'ButterBean_Control_Review' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-multibutton.php' );
		$butterbean->register_control_type( 'multibutton', 'ButterBean_Control_Multibutton' );


		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-feature-tiles.php' );
		$butterbean->register_control_type( 'feature_tiles', 'ButterBean_Control_Feature_Tiles' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-attachment.php' );
		$butterbean->register_control_type( 'attachment', 'ButterBean_Control_Attachment' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-location-lat-long.php' );
		$butterbean->register_control_type( 'location_to_lat_long', 'ButterBean_Control_Location_Lat_Long' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-timestamp.php' );
		$butterbean->register_control_type( 'timestamp', 'ButterBean_Control_Timestamp' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-raw.php' );
		$butterbean->register_control_type( 'raw', 'ButterBean_Control_Raw' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-categories.php' );
		$butterbean->register_control_type( 'categories', 'ButterBean_Control_Categories' );

		require_once( INCLUDE_FOLDER . 'butterbean-extras/extensions/controls/class-control-pin.php' );
		$butterbean->register_control_type( 'pin', 'ButterBean_Control_Pin' );
	}

}

VL_Meta_Register_Meta::instance();
