<?php

if ( ! class_exists( 'ButterBean_Program' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Program {

		/**
         * Post type name.
         *
         * @param string
         */
		protected $post_type = 'programs';

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
			add_action( 'init', array( $this, 'program_group' ) );
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
				'<label>' . __( 'Program display page' , $this->post_type . '_display' ) . '</label>',
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
				"name"               => _x( "Program", "post type general name" ),
				"singular_name"      => _x( "Program", "post type singular name" ),
				"add_new"            => _x( "Add New", "service" ),
				"add_new_item"       => __( "Add New Program" ),
				"edit_item"          => __( "Edit Program" ),
				"new_item"           => __( "New Program" ),
				"all_items"          => __( "All Program" ),
				"view_item"          => __( "View Program" ),
				"search_items"       => __( "Search Program" ),
				"not_found"          => __( "No Program found" ),
				"not_found_in_trash" => __( "No Program found in the Trash" ),
				"parent_item_colon"  => "",
				"menu_name"          => __( "Program" )
			);

			$args = array(
				"labels"        => $labels,
				"description"   => "Program",
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
		public function program_group()  {
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

			register_taxonomy( 'program_group', 'programs', $args );

		}
		

		/**
		 * Add a post display state for special WC pages in the page list table.
		 *
		 * @param array   $post_states An array of post display states.
		 * @param WP_Post $post        The current post object.
		 */
		public function add_display_post_states( $post_states, $post ) {
			if ( intval( get_option( 'page_for_' . $this->post_type ) ) === $post->ID ) {
				$post_states['page_for_' . $this->post_type] = __( 'Program Page' );
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
				'body_logo'
			);
			$body->register_setting(
				'body_email'
			);
			$body->register_setting(
				'body_video'
			);
			$body->register_setting(
				'body_externalbtnlink'
			);
			$body->register_setting(
				'body_btntext'
			);
			$body->register_setting(
				'body_cost'
			);
			$body->register_setting(
				'body_intro'
			);
			
			$body->register_setting(
				'body_homefeatured'
			);
			$body->register_setting(
				'body_location'
			);
			$body->register_setting(
				'body_contact'
			);

			$body->register_setting(
				'body_map'
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
		        'body_logo',
		        array(
		        	'type'    => 'image',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Image' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			$body->register_control(
		        'body_video',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Video Iframe Embed Link' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			
			$body->register_control(
		        'body_email',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Contact Email' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        )
			);

			$body->register_control(
		        'body_externalbtnlink',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'External Button Link' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        )
			);
			$body->register_control(
		        'body_btntext',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Button Text' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        )
			);

			$body->register_control(
		        'body_cost',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Cost' ),
		        	'attr'    => array( 'class' => 'widefat' ),

		        )
			);
			$body->register_control(
		        'body_intro',
		        array(
		        	//'type'    => 'select-group',
		        	'type'    => 'textarea',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Intro' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        	
		        )
			);
			$body->register_control(
		        'body_contact',
		        array(
		        	'type'    => 'text',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Program Contact' ),
		        	'attr'    => array( 'class' => 'widefat datepicker' ),
		        	
		        )
			);
			
			
			$body->register_control(
		        'body_homefeatured',
		        array(
		        	'type'    => 'select-group',
		        	'section' => 'intro',
		        	'label'   => esc_html__( 'Add this program on Homepage feature' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        	'choices' => array(
		        		'1' => esc_html__( 'Yes' ),
		        		'0' => esc_html__( 'No' )
		        	)
		        )
			);
			

			$body->register_control(
		        'body_location',
		        array(
		        	'type'    => 'multilocation',
		        	'section' => 'location',
		        	'label'   => esc_html__( 'Location' ),
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

	ButterBean_Program::get_instance();
}

/**
 * Get program WP_Query object list
 *
 * @param  int $post_per_page 
 * @return WP_Query object
 */
function get_all_programs() {
	$array = array(
		'post_type'      => 'programs',
		'posts_per_page' =>  -1,
		'orderby'        => 'date',
		'order'          => 'ASC'
	);
	return new WP_Query( $array );
}

function get_three_programs($currentPost) {
	$array = array(
		'post_type'      => 'programs',
		'post__not_in' => array ($currentPost),
		'posts_per_page' =>  3,
		'orderby'        => 'date',
		'order'          => 'ASC'
	);
	return new WP_Query( $array );
}

function get_program( $programGroupId ) {
	$array = array(
		'post_type'      => 'programs',
		'posts_per_page' =>  -1,
		'orderby'        => 'date',
		'order'          => 'ASC',
		'tax_query' => array(
	        array(
	            'taxonomy' => 'program_group',
	            'terms' => $programGroupId,
	            'field' => 'term_id',
	        )
	    )
	);


	return new WP_Query( $array );
}




