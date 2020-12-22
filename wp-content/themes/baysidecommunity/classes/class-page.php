<?php

if ( ! class_exists( 'ButterBean_Page' ) ) {	
	
	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Page {

		/**
		 * The post type list
		 *
		 *
		 * @param  array  $post_types
		 */
		protected $post_types = array(
			'page'
			//'post'
		
		);

		/**
		 * The page id
		 *
		 *
		 * @param  int  $page_id
		 */
		protected $page_id;

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {
			// the page id
			$this->page_id = isset( $_GET['post'] ) ? $_GET['post'] : 0;

			// Register managers, sections, settings, and controls.
			// I'm separating these out into their own methods so that the code
			// is cleaner and easier to follow.  This is just an example, so feel
			// free to experiment.
			add_action( 'butterbean_register', array( $this, 'register_managers' ), 10, 2 );
			add_action( 'butterbean_register', array( $this, 'register_sections' ), 10, 2 );
			add_action( 'butterbean_register', array( $this, 'register_settings' ), 10, 2 );
			add_action( 'butterbean_register', array( $this, 'register_controls' ), 10, 2 );
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
			
			if ( !in_array( $post_type, $this->post_types ) )
				return;

			$butterbean->register_manager(
		        'body',
		        array(
		        	'label'     => esc_html__( 'Body' ),
		        	'post_type' => $this->post_types,
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

			if ( !in_array( $post_type, $this->post_types ) )
				return;

			// Gets the manager object we want to add sections to.
			
			$body = $butterbean->get_manager( 'body' );
			
			$body->register_section(
		        'content',
		        array(
		        	'label' => esc_html__( '2 Columns Block' ),
					'icon'  => ''
				)
			);
			$body->register_section(
		        'ctabottom_section',
		        array(
		        	'label' => esc_html__( 'CTA Bottom' ),
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

			if ( !in_array( $post_type, $this->post_types ) )
				return;

			// Gets the manager object we want to add settings to.
			

			$body = $butterbean->get_manager( 'body' );
			
			$body->register_setting(
				'body_content'
			);
			

			$body->register_setting(
				'ctabottom_heading'
			);

			$body->register_setting(
				'ctabottom_image'
			);

			$body->register_setting(
				'ctabottom_short_description'
			);

			$body->register_setting(
				'ctabottom_button_link'
			);

			$body->register_setting(
				'ctabottom_button_text'
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

			if ( !in_array( $post_type, $this->post_types ) )
				return;

			// Gets the banner object we want to add controls to.
			$body = $butterbean->get_manager( 'body' );
			
			$body->register_control(
		        'body_content',
		        array(
		        	'type'    => 'slider',
		        	'section' => 'content',
		        	'label'   => esc_html__( 'Slider' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			$body->register_control(
		        'ctabottom_heading',
		        array(
		        	'type'    => 'text',
		        	'section' => 'ctabottom_section',
		        	'label'   => esc_html__( 'Heading' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			$body->register_control(
		        'ctabottom_image',
		        array(
		        	'type'    => 'image',
		        	'section' => 'ctabottom_section',
		        	'label'   => esc_html__( 'image' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			$body->register_control(
		        'ctabottom_short_description',
		        array(
		        	'type'    => 'textarea',
		        	'section' => 'ctabottom_section',
		        	'label'   => esc_html__( 'Short Description' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			$body->register_control(
		        'ctabottom_button_link',
		        array(
		        	'type'    => 'select-group',
		        	'section' => 'ctabottom_section',
		        	'label'   => esc_html__( 'Button Link' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        	'choices' => array(
		        		'' => esc_html__( '- Select Page -' ),
		        		array(
			        		'label'   => esc_html__( 'Pages' ),
			        		'choices' => get_dropdown_pages()
		        		)
		        	)
		        )
			);

			$body->register_control(
		        'ctabottom_button_text',
		        array(
		        	'type'    => 'text',
		        	'section' => 'ctabottom_section',
		        	'label'   => esc_html__( 'Button Text' ),
		        	'attr'    => array( 'class' => 'widefat' )
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

	ButterBean_Page::get_instance();
}