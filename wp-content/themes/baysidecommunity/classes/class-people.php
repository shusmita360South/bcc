<?php

if ( ! class_exists( 'ButterBean_People' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_People {

		/**
         * Post type name.
         *
         * @param string
         */
		protected $post_type = 'people';

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
			add_action( 'admin_init' , array( $this , 'register_setting' ) );
			add_filter( 'display_post_states', array( $this , 'add_display_post_states' ), 10, 2 );

			add_action( 'template_redirect', array( $this, 'template_redirect_single_page' ) );
		}

		/**
		 * Add new field to wp-admin/options-reading.php page
		 */
		public function register_setting() {
			register_setting( 'reading', 'page_for_' . $this->post_type, 'esc_attr' );

			add_settings_field(
				$this->post_type . '_display',
				'<label>' . __( 'People display page' , $this->post_type . '_display' ) . '</label>',
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
				"name"               => _x( "Peoples", "post type general name" ),
				"singular_name"      => _x( "Peoples", "post type singular name" ),
				"add_new"            => _x( "Add New", "service" ),
				"add_new_item"       => __( "Add New People" ),
				"edit_item"          => __( "Edit People" ),
				"new_item"           => __( "New People" ),
				"all_items"          => __( "All Peoples" ),
				"view_item"          => __( "View People" ),
				"search_items"       => __( "Search Peoples" ),
				"not_found"          => __( "No Peoples found" ),
				"not_found_in_trash" => __( "No Peoples found in the Trash" ),
				"parent_item_colon"  => "",
				"menu_name"          => __( "Peoples" )
			);

			$args = array(
				"labels"        => $labels,
				"description"   => "Peoples",
				"public"        => true,
				"hierarchical"  => true,
				"supports"      => array( "title", "thumbnail" ),
				"menu_icon"     => "dashicons-grid-view",
				"has_archive"   => true,
				"show_in_menu"  => true,
				//'taxonomies'    => array( 'category' )
			);

			register_post_type( $this->post_type, $args );
		}

		/**
		 * Add a post display state for special WC pages in the page list table.
		 *
		 * @param array   $post_states An array of post display states.
		 * @param WP_Post $post        The current post object.
		 */
		public function add_display_post_states( $post_states, $post ) {
			if ( intval( get_option( 'page_for_' . $this->post_type ) ) === $post->ID ) {
				$post_states['page_for_' . $this->post_type] = __( 'People Page' );
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
					'label' => 'Intro',
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
				'body_subtitle'
			);
			$body->register_setting(
				'body_phone'
			);
			$body->register_setting(
				'body_email'
			);
			$body->register_setting(
				'body_linkedinlink'
			);
			$body->register_setting(
				'body_bio'
			);
			$body->register_setting(
				'body_biolong'
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
		        'body_subtitle',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Subtitle' ),
		        	'attr'    => array( 'class' => 'widefat' ),

		        )
			);

			$body->register_control(
		        'body_phone',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Phone' ),
		        	'attr'    => array( 'class' => 'widefat' ),

		        )
			);

			$body->register_control(
		        'body_email',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Email' ),
		        	'attr'    => array( 'class' => 'widefat' ),

		        )
			);

			$body->register_control(
		        'body_linkedinlink',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Linkedin Link' ),
		        	'attr'    => array( 'class' => 'widefat' ),

		        )
			);

			$body->register_control(
		        'body_bio',
		        array(
		        	'type'    => 'textarea',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Bio' ),
		        	'attr'    => array( 'class' => 'widefat' ),

		        )
			);
			$body->register_control(
		        'body_biolong',
		        array(
		        	'type'    => 'textarea',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Bio Long' ),
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

	ButterBean_People::get_instance();
}

/**
 * Get people WP_Query object list
 *
 * @param  int $post_per_page 
 * @return WP_Query object
 */
function get_people() {
	$array = array(
		'post_type'      => 'people',
		'posts_per_page' =>  -1,
		'orderby'        => 'date',
		'order'          => 'DESC',

	);


	return new WP_Query( $array );
}