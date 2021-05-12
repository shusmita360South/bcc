<?php

if ( ! class_exists( 'ButterBean_Home' ) ) {	
	
	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Home {

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

			if ( intval( get_option( 'page_on_front' ) ) != $this->page_id && $this->page_id != 0 )
				return;

			$butterbean->register_manager(
				'banner',
				array(
					'label'     => 'Hero Banner',
					'post_type' => array( 'page' ),
					'context'   => 'normal',
					'priority'  => 'high'
				)
			);
			$butterbean->register_manager(
				'homebody',
				array(
					'label'     => 'Homepage Body',
					'post_type' => array( 'page' ),
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

			if ( intval( get_option( 'page_on_front' ) ) != $this->page_id && $this->page_id != 0 )
				return;

			$banner = $butterbean->get_manager( 'banner' );
			$banner->register_section(
		        'slideshow',
		        array(
		        	'label' => esc_html__( 'Slideshow' ),
					'icon'  => ''
				)
			);
			$banner->register_section(
		        'note',
		        array(
		        	'label' => esc_html__( 'Site Notices' ),
					'icon'  => ''
				)
			);
			


			// Gets the manager object we want to add sections to.
			$homebody = $butterbean->get_manager( 'homebody' );

			

			$homebody->register_section(
		        'about_section',
		        array(
		        	'label' => esc_html__( 'About' ),
					'icon'  => ''
				)
			);
			$homebody->register_section(
		        'homefeature_section',
		        array(
		        	'label' => esc_html__( 'Feature' ),
					'icon'  => ''
				)
			);
			
			$homebody->register_section(
		        'program_section',
		        array(
		        	'label' => esc_html__( 'Program' ),
					'icon'  => ''
				)
			);
			
			$homebody->register_section(
		        'getinvolve_section',
		        array(
		        	'label' => esc_html__( 'Get Involve' ),
					'icon'  => ''
				)
			);
			$homebody->register_section(
		        'subscribe_section',
		        array(
		        	'label' => esc_html__( 'Subscribe' ),
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

			if ( intval( get_option( 'page_on_front' ) ) != $this->page_id && $this->page_id != 0 )
				return;


			$banner = $butterbean->get_manager( 'banner' );
			$banner->register_setting(
				'hero_slider'
			);
			$banner->register_setting(
				'note_text1'
			);
			$banner->register_setting(
				'note_text2'
			);
			


			// Gets the manager object we want to add controls to.
			$homebody = $butterbean->get_manager( 'homebody' );

			

			$homebody->register_setting(
				'about_heading'
			);

			$homebody->register_setting(
				'about_short_description'
			);

			$homebody->register_setting(
				'about_button_link'
			);

			$homebody->register_setting(
				'about_button_text'
			);

			$homebody->register_setting(
				'about_blocks'
			);

			$homebody->register_setting(
				'home_feature'
			);

			$homebody->register_setting(
				'subscribe_heading'
			);
		
			$homebody->register_setting(
				'program_heading'
			);

			$homebody->register_setting(
				'program_short_description'
			);
			$homebody->register_setting(
				'getinvolve_heading'
			);

			$homebody->register_setting(
				'getinvolve_short_description'
			);


			$homebody->register_setting(
				'getinvolve_posts'
			);
			$homebody->register_setting(
				'subscribe_heading'
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

			if ( intval( get_option( 'page_on_front' ) ) != $this->page_id && $this->page_id != 0 )
				return;

			// Gets the manager object we want to add controls to.
			$banner = $butterbean->get_manager( 'banner' );

			$banner->register_control(
		        'hero_slider',
		        array(
		        	'type'    => 'heroslider',
		        	'section' => 'slideshow',
		        	'label'   => esc_html__( 'Slider' )
		        )
			);
			$banner->register_control(
		        'note_text1',
		        array(
		        	'type'    => 'text',
		        	'section' => 'note',
		        	'label'   => esc_html__( 'Site Notice (Below Header Menu & Above Hero Slider)' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			$banner->register_control(
		        'note_text2',
		        array(
		        	'type'    => 'text',
		        	'section' => 'note',
		        	'label'   => esc_html__( 'Site Notice (Below Hero Slider)' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			


			$homebody = $butterbean->get_manager( 'homebody' );


			$homebody->register_control(
		        'about_heading',
		        array(
		        	'type'    => 'text',
		        	'section' => 'about_section',
		        	'label'   => esc_html__( 'Heading' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			$homebody->register_control(
		        'about_short_description',
		        array(
		        	'type'    => 'textarea',
		        	'section' => 'about_section',
		        	'label'   => esc_html__( 'Short Description' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			
			$homebody->register_control(
		        'about_blocks',
		        array(
		        	'type'    => 'slider',
		        	'section' => 'about_section',
		        	'label'   => esc_html__( 'Slider' )
		        )
			);

			/* $homebody->register_control(
		        'about_blocks',
		        array(
		        	'type'    => 'multi_select',
		        	'section' => 'about_section',
		        	'label'   => esc_html__( 'About Blocks' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        	'choices' => get_dropdown_pages_and_categories()
		        )
			); */

			$homebody->register_control(
		        'about_button_link',
		        array(
		        	'type'    => 'select-group',
		        	'section' => 'about_section',
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

			$homebody->register_control(
		        'about_button_text',
		        array(
		        	'type'    => 'text',
		        	'section' => 'about_section',
		        	'label'   => esc_html__( 'Button Text' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			
	
			$homebody->register_control(
		        'home_feature',
		        array(
		        	'type'    => 'review',
		        	'section' => 'homefeature_section',
		        	'label'   => esc_html__( 'Feature' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			

			
			$homebody->register_control(
		        'subscribe_heading',
		        array(
		        	'type'    => 'text',
		        	'section' => 'subscribe_section',
		        	'label'   => esc_html__( 'Heading' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			
			$homebody->register_control(
		        'program_heading',
		        array(
		        	'type'    => 'text',
		        	'section' => 'program_section',
		        	'label'   => esc_html__( 'Heading' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			$homebody->register_control(
		        'program_short_description',
		        array(
		        	'type'    => 'textarea',
		        	'section' => 'program_section',
		        	'label'   => esc_html__( 'Short Description' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);
			
			$homebody->register_control(
		        'getinvolve_posts',
		        array(
		        	'type'    => 'multi_select',
		        	'section' => 'getinvolve_section',
		        	'label'   => esc_html__( 'Get Involve Blocks' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        	'choices' => get_dropdown_pages()
		        )
			);
			$homebody->register_control(
		        'getinvolve_heading',
		        array(
		        	'type'    => 'text',
		        	'section' => 'getinvolve_section',
		        	'label'   => esc_html__( 'Heading' ),
		        	'attr'    => array( 'class' => 'widefat' )
		        )
			);

			$homebody->register_control(
		        'getinvolve_short_description',
		        array(
		        	'type'    => 'textarea',
		        	'section' => 'getinvolve_section',
		        	'label'   => esc_html__( 'Short Description' ),
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

	ButterBean_Home::get_instance();
}



