<?php
/**
 * Categories control class.
 */
class ButterBean_Control_Categories extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @var    string
	 */
	public $type = 'categories';

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

		$this->taxonomy = $args['taxonomy'];
	}

	/**
	 * Enqueue scripts/styles for the control.
	 */
	public function enqueue() {
		// Enqueue the main plugin script.
		wp_enqueue_script( 'butterbean-categories', plugin_dir_url( __DIR__ ) . '/js/butterbean-categories.js', array( 'butterbean' ), '', true );
	}

	/**
	 * Get categories array
	 */
	public function get_categories() {
		$categories = [];
		$chosen_categories = $this->get_chosen_categories();

		$the_categories = get_terms( array(
			'taxonomy' => $this->taxonomy,
		));

		if ( $the_categories && ! is_wp_error( $the_categories ) ) {
			foreach ( $the_categories as $category ) {
				if ( ! isset( $chosen_categories[ $category->name ] ) ) {
					$categories[ $category->name ] = $category->term_id;
				}
			}
		}

		// array_unique( $chosen_categories, $categories );

		return $categories;
	}

	/**
	 * Get chosen categories array
	 */
	public function get_chosen_categories() {
		$categories = [];
		$category_ids = $this->get_value();

		if ( ! $category_ids ) {
			return [];
		}

		$ids_array = explode( ',', $category_ids );

		$the_categories = get_terms( array(
			'taxonomy' => $this->taxonomy,
			'include' => $ids_array,
		));

		if ( $the_categories && ! is_wp_error( $the_categories ) ) {
			foreach ( $the_categories as $category ) {
				$categories[ $category->name ] = $category->term_id;
			}
		}

		return $categories;
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->get_value();
		$this->json['categories'] = $this->get_categories();
		$this->json['chosen_categories'] = $this->get_chosen_categories();
	}
}
