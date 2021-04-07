<?php

if ( ! class_exists( 'ButterBean_Blog' ) ) {

	/**
	 * Main ButterBean class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class ButterBean_Blog {

		/**
         * Post type name.
         *
         * @param string
         */
		protected $post_type = 'post';

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

			

		}

		/**
		 * Add new field to wp-admin/options-reading.php page
		 */
		public function register_setting() {
			register_setting( 'reading', 'page_for_' . $this->post_type, 'esc_attr' );

			add_settings_field(
				$this->post_type . '_display',
				'<label>' . __( 'Blog display page' , $this->post_type . '_display' ) . '</label>',
				array( $this, 'dropdown_page' ),
				'reading',
				'for_page'
			);
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
				'author',
				array(
					'label'     => 'Author',
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

			// Gets the author object we want to add sections to.
			$author = $butterbean->get_manager( 'author' );

			$author->register_section(
				'info',
				array(
					'label' => 'Info',
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
			$author = $butterbean->get_manager( 'author' );

			$author->register_setting(
				'author_info'
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

			// Gets the author object we want to add controls to.
			$author = $butterbean->get_manager( 'author' );

			$author->register_control(
		        'author_info',
		        array(
		        	'type'    => 'select',
		        	'section' => 'info',
		        	'label'   => esc_html__( 'Author' ),
		        	'attr'    => array( 'class' => 'widefat' ),
		        	'choices' => dropdown_leader_page()
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

	ButterBean_Blog::get_instance();
}

/**
 * Get leaderPosts WP_Query object list
 *
 * @param  int $post_per_page
 * @return WP_Query object
 */
function get_author($Id) {
	$leader_post_type = 'people';
	$array = array(
		'post__in' => array($Id) ,
		'post_type' => $leader_post_type ,
		'posts_per_page' =>  -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',

	);


	return new WP_Query( $array );
}

function get_blog() {
	$category_name  = 'blog';
	$array = array(
		'post_type'      => 'post',
		'posts_per_page' =>  -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'category_name' => $category_name
	);


	return new WP_Query( $array );
}
/**
 * Get Homepage post WP_Query object list
 *
 * @param  int $post_per_page
 * @return WP_Query object
 */
function get_homePosts($blogIds) {
	$array = array(
		'post__in' => $blogIds ,
		'posts_per_page' =>  -1,
		'orderby'        => 'date',
		'order'          => 'DESC'
	);


	return new WP_Query( $array );
}
/**
 * Get leader list pages
 *
 */
function dropdown_leader_page() {
	$leader_post_type = 'people';
	$array = array(
		'post_type' => $leader_post_type ,
		'posts_per_page' =>  -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC'
	);
	$posts = get_posts($array);

	$option = [];
	foreach ($posts as $post) {
		$option[$post->ID] = array($post->post_title);
	}

	return $option;
}

