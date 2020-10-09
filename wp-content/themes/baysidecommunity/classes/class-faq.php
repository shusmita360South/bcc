<?php

if ( ! class_exists( 'ButterBean_Faq' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Faq {

		/**
         * Post type name.
         *
         * @param string
         */
		protected $post_type = 'faq';

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {		
			// Register managers, sections, settings, and controls.
			// I'm separating these out into their own methods so that the code
			// is cleaner and easier to follow.  This is just an example, so feel
			// free to experiment.
			
			// Admin init
			add_action( 'init', array( $this, 'register_post' ) );
			add_action( 'init', array( $this, 'faq_category' ) );
			add_action( 'admin_init' , array( $this , 'register_setting' ) );
			add_filter( 'display_post_states', array( $this , 'add_display_post_states' ), 10, 2 );

			//add_action( 'template_redirect', array( $this, 'template_redirect_single_page' ) );
		}

		/**
		 * Add new field to wp-admin/options-reading.php page
		 */
		public function register_setting() {
			register_setting( 'reading', 'page_for_' . $this->post_type, 'esc_attr' );

			add_settings_field(
				$this->post_type . '_display',
				'<label>' . __( 'Faq display page' , $this->post_type . '_display' ) . '</label>',
				array( $this, 'dropdown_page' ),
				'reading',
				'for_page'
			);
		}

		/**
		 * No access to single podcast page.
		 *
		 * @return void
		 */
		function template_redirect_single_page()
		{
		  	global $wp_query;
		  
			$post_type = get_query_var( "post_type" );
			
			if ( is_single() && $this->post_type == $post_type ) {
				$wp_query->set_404();
				status_header(404);
			}
		}

		/**
		 * HTML for extra settings
		 */
		public function dropdown_page() {
			echo wp_dropdown_pages(
				array(
					'name'              => 'page_for_' . $this->post_type,
					'echo'              => 0,
					'show_option_none'  => __( '&mdash; Select &mdash;' ),
					'option_none_value' => '0',
					'selected'          => get_option( 'page_for_' . $this->post_type ),
				)
			);
		}

		/**
		 * Register service post type
		 *
		 * @return void
		 */
		public function register_post() {

			$labels = array(
				"name"               => _x( "FAQ", "post type general name" ),
				"singular_name"      => _x( "FAQ", "post type singular name" ),
				"add_new"            => _x( "Add New", "service" ),
				"add_new_item"       => __( "Add New FAQ" ),
				"edit_item"          => __( "Edit FAQ" ),
				"new_item"           => __( "New FAQ" ),
				"all_items"          => __( "All FAQ" ),
				"view_item"          => __( "View FAQ" ),
				"search_items"       => __( "Search FAQ" ),
				"not_found"          => __( "No FAQ found" ),
				"not_found_in_trash" => __( "No FAQ found in the Trash" ),
				"parent_item_colon"  => "",
				"menu_name"          => __( "FAQ" )
			);

			$args = array(
				"labels"        => $labels,
				"description"   => "FAQ",
				"public"        => true,
				"hierarchical"  => true,
				"supports"      => array( "title", "thumbnail","editor" ),
				"menu_icon"     => "dashicons-grid-view",
				"has_archive"   => false,
				"show_in_menu"  => true,
				//'taxonomies'    => array( 'category' )
			);

			register_post_type( $this->post_type, $args );
		}

		/**
		 * Register faq category taxonomy
		 *
		 * @return void
		 */
		public function faq_category()  {
			$labels = array(
				'name'                       => _x( 'Category', 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( 'Category', 'text_domain' ),
				'all_items'                  => __( 'All Category', 'text_domain' ),
				'parent_item'                => __( 'Parent Category', 'text_domain' ),
				'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
				'new_item_name'              => __( 'New Category Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New Category', 'text_domain' ),
				'edit_item'                  => __( 'Edit Category', 'text_domain' ),
				'update_item'                => __( 'Update Category', 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate Category with commas', 'text_domain' ),
				'search_items'               => __( 'Search Category', 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove Category', 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used Category', 'text_domain' ),
			);

			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);

			register_taxonomy( 'faq_category', 'faq', $args );
		}
		

		/**
		 * Add a post display state for special WC pages in the page list table.
		 *
		 * @param array   $post_states An array of post display states.
		 * @param WP_Post $post        The current post object.
		 */
		public function add_display_post_states( $post_states, $post ) {
			if ( intval( get_option( 'page_for_' . $this->post_type ) ) === $post->ID ) {
				$post_states['page_for_' . $this->post_type] = __( 'Faq Page' );
			}

		    return $post_states;
		}

		

		

		/**
		 * Returns the instance.
		 *
		 * @return object
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function __construct() {}
	}

	ButterBean_Faq::get_instance();
}

/**
 * Get faq WP_Query object list
 *
 * @param  int $post_per_page 
 * @return WP_Query object
 */
function get_faq($category_name, $category_id ) {
	
	$array = array(
		'post_type'      => 'faq',
		'posts_per_page' =>  -1,
		'orderby'        => 'menu_order',
		'tax_query' => array(
	        array(
	            'taxonomy' => 'faq_category',
	            'terms' => $category_id,
	            'field' => 'term_id',
	        )
	    )

	);


	return new WP_Query( $array );
}