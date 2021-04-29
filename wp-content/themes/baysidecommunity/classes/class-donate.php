<?php

if ( ! class_exists( 'ButterBean_Donate' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Donate {

		/**
         * Post type name.
         *
         * @param string
         */
		protected $post_type = 'donates';

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
			add_action( 'butterbean_register', array( $this, 'register_managers' ), 10, 2 );
			add_action( 'butterbean_register', array( $this, 'register_sections' ), 10, 2 );
			add_action( 'butterbean_register', array( $this, 'register_settings' ), 10, 2 );
			add_action( 'butterbean_register', array( $this, 'register_controls' ), 10, 2 );

			// Admin init
			add_action( 'init', array( $this, 'register_post' ) );
			add_action( 'init', array( $this, 'donate_group' ) );
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
				'<label>' . __( 'Donate display page' , $this->post_type . '_display' ) . '</label>',
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
		// function template_redirect_single_page()
		// {
		//   	global $wp_query;
		  
		// 	$post_type = get_query_var( "post_type" );
			
		// 	if ( is_single() && $this->post_type == $post_type ) {
		// 		$wp_query->set_404();
		// 		status_header(404);
		// 	}
		// }

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
				"name"               => _x( "Donate", "post type general name" ),
				"singular_name"      => _x( "Donate", "post type singular name" ),
				"add_new"            => _x( "Add New", "service" ),
				"add_new_item"       => __( "Add New Donate" ),
				"edit_item"          => __( "Edit Donate" ),
				"new_item"           => __( "New Donate" ),
				"all_items"          => __( "All Donate" ),
				"view_item"          => __( "View Donate" ),
				"search_items"       => __( "Search Donate" ),
				"not_found"          => __( "No Donate found" ),
				"not_found_in_trash" => __( "No Donate found in the Trash" ),
				"parent_item_colon"  => "",
				"menu_name"          => __( "Donate" )
			);

			$args = array(
				"labels"        => $labels,
				"description"   => "Donate",
				"public"        => true,
				"hierarchical"  => true,
				"supports"      => array( "title","editor", "thumbnail" ),
				"menu_icon"     => "dashicons-grid-view",
				"has_archive"   => true,
				"show_in_menu"  => true
			);

			register_post_type( $this->post_type, $args );
		}

		// Register Custom Taxonomy
		public function donate_group()  {
			$labels = array(
				'name'                       => _x( 'Groups', 'Taxonomy General Name', 'text_domain' ),
				'singular_name'              => _x( 'Group', 'Taxonomy Singular Name', 'text_domain' ),
				'menu_name'                  => __( 'Groups', 'text_domain' ),
				'all_items'                  => __( 'All Groups', 'text_domain' ),
				'parent_item'                => __( 'Parent Group', 'text_domain' ),
				'parent_item_colon'          => __( 'Parent Group:', 'text_domain' ),
				'new_item_name'              => __( 'New Group Name', 'text_domain' ),
				'add_new_item'               => __( 'Add New Group', 'text_domain' ),
				'edit_item'                  => __( 'Edit Group', 'text_domain' ),
				'update_item'                => __( 'Update Group', 'text_domain' ),
				'separate_items_with_commas' => __( 'Separate Groups with commas', 'text_domain' ),
				'search_items'               => __( 'Search Groups', 'text_domain' ),
				'add_or_remove_items'        => __( 'Add or remove Groups', 'text_domain' ),
				'choose_from_most_used'      => __( 'Choose from the most used Groups', 'text_domain' ),
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

			register_taxonomy( 'donate_group', 'donates', $args );

		}
		

		/**
		 * Add a post display state for special WC pages in the page list table.
		 *
		 * @param array   $post_states An array of post display states.
		 * @param WP_Post $post        The current post object.
		 */
		public function add_display_post_states( $post_states, $post ) {
			if ( intval( get_option( 'page_for_' . $this->post_type ) ) === $post->ID ) {
				$post_states['page_for_' . $this->post_type] = __( 'Donate Page' );
			}

		    return $post_states;
		}

		/**
		 * Registers managers.  In this example, we're registering a single manager.
		 * A manager is essentially our "tabbed meta box".  It needs to have
		 * sections and controls added to it.
		 *
		 * @param  object  $butterbean  Instance of the `ButterBean` object.
		 * @param  string  $post_type
		 * @return void
		 */
		public function register_managers( $butterbean, $post_type ) {		
			if ( $post_type !== $this->post_type )
				return;

			$butterbean->register_manager(
				'body',
				array(
					'label'     => 'Body',
					'post_type' => array( $this->post_type ),
					'context'   => 'normal',
					'priority'  => 'high'
				)
			);
			
			
		}

		/**
		 * Registers sections.
		 *
		 * @param  object  $butterbean  Instance of the `ButterBean` object.
		 * @param  string  $post_type
		 * @return void
		 */
		public function register_sections( $butterbean, $post_type ) {
			if ( $post_type !== $this->post_type )
				return;

			
			// Gets the body object we want to add sections to.
			$body = $butterbean->get_manager( 'body' );

			$body->register_section(
				'intro',
				array(
					'label' => 'Info',
					'icon'  => ''
				)
			);
			
			$body->register_section(
				'location',
				array(
					'label' => 'Locations',
					'icon'  => ''
				)
			);
			
			
			
		}

		/**
		 * Registers settings.
		 *
		 * @param  object  $butterbean  Instance of the `ButterBean` object.
		 * @param  string  $post_type
		 * @return void
		 */
		public function register_settings( $butterbean, $post_type ) {

			if ( $post_type !== $this->post_type )
				return;

			
			// Gets the manager object we want to add settings to.
			$body = $butterbean->get_manager( 'body' );


			$body->register_setting(
				'body_donate_amount'
			);

			
			
		}

		/**
		 * Registers controls.
		 *
		 * @param  object  $butterbean  Instance of the `ButterBean` object.
		 * @param  string  $post_type
		 * @return void
		 */
		public function register_controls( $butterbean, $post_type ) {

			if ( $post_type !== $this->post_type )
				return;

			// Gets the body object we want to add controls to.
			$body = $butterbean->get_manager( 'body' );
			

			$body->register_control(
		        'body_donate_amount',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Donate Amount' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        )
			);
			
			


			

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

	ButterBean_Donate::get_instance();
}

/**
 * Get donate WP_Query object list
 *
 * @param  int $post_per_page 
 * @return WP_Query object
 */
function get_all_donates() {
	$array = array(
		'post_type'      => 'donates',
		'posts_per_page' =>  -1,
		'orderby'        => 'date',
		'order'          => 'ASC'
	);
	return new WP_Query( $array );
}

function get_three_donates($currentPost) {
	$array = array(
		'post_type'      => 'donates',
		'post__not_in' => array ($currentPost),
		'posts_per_page' =>  3,
		'orderby'        => 'date',
		'order'          => 'ASC'
	);
	return new WP_Query( $array );
}

function get_donate( $donateGroupId ) {
	$array = array(
		'post_type'      => 'donates',
		'posts_per_page' =>  -1,
		'orderby'        => 'date',
		'order'          => 'ASC',
		'tax_query' => array(
	        array(
	            'taxonomy' => 'donate_group',
	            'terms' => $donateGroupId,
	            'field' => 'term_id',
	        )
	    )
	);


	return new WP_Query( $array );
}




