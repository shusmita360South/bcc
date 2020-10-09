<?php
/**
 * RevoPT Settings Page
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since RevoPT 1.0.0
 */

/**
 * Class for adding a new field to the options-reading.php page
 */
class Add_Settings_Field {
	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'admin_init' , array( $this , 'register_fields' ) );
		add_action( 'admin_menu', array( $this, 'theme_options' ) );
		
		// call register settings function
		add_action( 'admin_init', array( $this, 'theme_options_settings' ) );
	}

	public function theme_options_settings() {
		//register our settings
		register_setting( 'theme_settings_group', 'google_api_key' );
		register_setting( 'theme_settings_group', 'google_analytics' );
		register_setting( 'theme_settings_group', 'facebook_pixel' );
		register_setting( 'theme_settings_group', 'custom_javascript' );
		register_setting( 'theme_settings_group', 'after_custom_javascript' );
	}

	public function theme_options() {
		add_options_page( 
			'Theme Options',
			'Theme Options',
			'manage_options',
			'theme-options.php',
			array(
				$this,
				'custom_theme_options'
			)
		);
	}

	public function custom_theme_options($data) { ?>
		<div class="wrap">
			<h1><?php echo __( 'Theme Options' ) ?></h1>
			<form method="post" action="options.php">
			    <?php settings_fields( 'theme_settings_group' ); ?>
			    <?php do_settings_sections( 'theme_settings_group' ); ?>
				<h2><?php echo __( 'Before Body tag' ) ?></h2>
			    <table class="form-table">
					<tr valign="top">
				        <th scope="row"><?php echo __( 'Google Api Key' ) ?></th>
				        <td><input type="text" name="google_api_key" class="large-text" value="<?php echo esc_attr( get_option('google_api_key') ); ?>"></td>
			        </tr>
					<tr valign="top">
				        <th scope="row"><?php echo __( 'Google Analytics' ) ?></th>
				        <td><textarea name="google_analytics" class="large-text code" rows="10" cols="50"><?php echo esc_attr( get_option('google_analytics') ); ?></textarea></td>
			        </tr>
			        <tr valign="top">
				        <th scope="row"><?php echo __( 'Facebook Pixel Code' ) ?></th>
				        <td><textarea name="facebook_pixel" class="large-text code" rows="10" cols="50"><?php echo esc_attr( get_option('facebook_pixel') ); ?></textarea></td>
			        </tr>
			        <tr valign="top">
				        <th scope="row"><?php echo __( 'Custom Javascript' ) ?></th>
				        <td><textarea name="custom_javascript" class="large-text code" rows="10" cols="50"><?php echo esc_attr( get_option('custom_javascript') ); ?></textarea></td>
			        </tr>
			    </table>
			    <h2><?php echo __( 'After Body tag' ) ?></h2>
			    <table class="form-table">
			        <tr valign="top">
				        <th scope="row"><?php echo __( 'Custom Javascript' ) ?></th>
				        <td><textarea name="after_custom_javascript" class="large-text code" rows="10" cols="50"><?php echo esc_attr( get_option('after_custom_javascript') ); ?></textarea></td>
			        </tr>
			    </table>

			    <?php submit_button(); ?>
			</form>
		</div>
	<?php
	}

	/**
	 * Add new fields to wp-admin/options-reading.php page
	 */
	public function register_fields() {
		add_settings_section(  
	        'for_page',
	        'Display for page',
	        array( $this, 'my_section_options_callback' ),
	        'reading'
	    );

		add_settings_section(  
	        'contact',
	        'Contact',
	        array( $this, 'my_section_options_callback' ),
	        'general'
	    );

		add_settings_field(
			'contact_email',
			'<label>' . __( 'Email' , 'contact_email' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_email')
		);

		add_settings_field(
			'contact_address',
			'<label>' . __( 'Street Address' , 'contact_address' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_address')
		);

		add_settings_field(
			'contact_suburb',
			'<label>' . __( 'Suburb' , 'contact_suburb' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_suburb')
		);

		add_settings_field(
			'contact_postcode',
			'<label>' . __( 'Postcode' , 'contact_postcode' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_postcode')
		);

		add_settings_field(
			'contact_state',
			'<label>' . __( 'State' , 'contact_state' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_state')
		);

		add_settings_field(
			'contact_phone',
			'<label>' . __( 'Phone' , 'contact_phone' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_phone')
		);
		add_settings_field(
			'contact_phonecare',
			'<label>' . __( 'Pastoral Care Phone' , 'contact_phonecare' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_phonecare')
		);
		add_settings_field(
			'contact_phonemedia',
			'<label>' . __( 'Media Enquiries' , 'contact_phonemedia' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'contact_phonemedia')
		);
		add_settings_field(
			'next_church_onine',
			'<label>' . __( 'Next Bayside Community Online' , 'next_church_onine' ) . '</label>',
			array( $this, 'text_field' ),
			'general',
			'contact',
			array('name'=>'next_church_onine')
		);
		add_settings_field(
			'event_header_image',
			'<label>' . __( 'Page Header Image' , 'event_header_image' ) . '</label>',
			array( $this, 'media_field' ),
			'general',
			'contact',
			array('name'=>'event_header_image')
		);

	
		
		register_setting( 'general', 'contact_email', 'esc_attr' );
		register_setting( 'general', 'contact_address', 'esc_attr' );
		register_setting( 'general', 'contact_suburb', 'esc_attr' );
		register_setting( 'general', 'contact_postcode', 'esc_attr' );
		register_setting( 'general', 'contact_state', 'esc_attr' );
		register_setting( 'general', 'contact_phone', 'esc_attr' );
		register_setting( 'general', 'contact_phonecare', 'esc_attr' );
		register_setting( 'general', 'contact_phonemedia', 'esc_attr' );
		register_setting( 'general', 'next_church_onine', 'esc_attr' );
		register_setting( 'general', 'event_header_image', 'esc_attr' );
		
	}

	public function my_section_options_callback() {}

	/**
	 * HTML for extra settings
	 */
	public function text_field($args) {
		printf('<input name="%1$s" type="email" id="%1$s" value="%2$s" class="regular-text ltr">' , $args['name'], get_option($args['name']));
	}
	public function textarea_field($args) {
		printf('<input name="%1$s" type="textarea" id="%1$s" value="%2$s" class="regular-text ltr">' , $args['name'], get_option($args['name']));
	}
	public function editor_field($args){
	    extract( $args );

     	$class = (!empty($class))?$class:'';

     	$settings = array(
        	'textarea_name' => $args['name'], 
        	'quicktags' => false,
        	'editor_class' => $class
     	);

     	wp_editor(get_option($args['name']), $args['name'], $settings );

     	echo (!empty($desc))?'<br/><span class="description">'.$desc.'</span>':'';
	}
	public function media_field($args) {
		printf('<input name="%1$s" type="text" id="%1$s" value="%2$s" class="regular-text ltr"><input id="upload_image_button" class="button" type="button" value="Upload Image" />' , $args['name'], get_option($args['name']));
	}
	
}

// Let's do this thang!
new Add_Settings_Field();


