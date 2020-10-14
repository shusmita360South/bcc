<?php
/**
 * Bayside Community functions and definitions
 *
 * @link https://360south.com.au
 *
 * @package WordPress
 * @subpackage Bayside_Church
 * @since Bayside Community 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baysidecommunity_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'baysidecommunity-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Bayside Community, use a find and replace
	 * to change 'baysidecommunity' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'baysidecommunity' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', baysidecommunity_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new BaysideCommunity_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'baysidecommunity_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-baysidecommunity-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';


// Custom script loader class.
require get_template_directory() . '/classes/class-baysidecommunity-script-loader.php';



/**
 * Register and Enqueue Styles.
 */
function baysidecommunity_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'baysidecommunity-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'baysidecommunity-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	//wp_add_inline_style( 'baysidecommunity-style', baysidecommunity_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'baysidecommunity-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );
	wp_enqueue_style( 'baysidecommunity-vendor-style', get_template_directory_uri() . '/assets/css/vendor.css', [], $theme_version, 'all' );

	wp_enqueue_style( 'baysidecommunity-custom-style', get_template_directory_uri() . '/assets/css/bayside.css', [], $theme_version, 'all' );


}

add_action( 'wp_enqueue_scripts', 'baysidecommunity_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function baysidecommunity_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	

	wp_enqueue_script( 'baysidecommunity-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'baysidecommunity-js', 'async', true );

	wp_enqueue_script( 'baysidecommunity-vendor-js', get_template_directory_uri() . '/assets/js/vendor.js', array(), $theme_version, false );
	wp_enqueue_script( 'baysidecommunity-app-js', get_template_directory_uri() . '/assets/js/app.js', array(), $theme_version, false );

	if (is_page_template( 'page-contact.php' ) || is_page_template( 'page-registration.php') ) {
		wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js', array(), '1.0', true );
	}

}

add_action( 'wp_enqueue_scripts', 'baysidecommunity_register_scripts' );

/**
 * Register and Enqueue Scripts ADMIN.
 */
function baysidecommunity_load_admin_scripts(){ 
	$theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_media();
    wp_register_script('baysidecommunity-admin-script','https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('baysidecommunity-admin-script'); 
    wp_enqueue_script( 'baysidecommunity-vendor-media-js', get_template_directory_uri() . '/assets/js/admin-media-upload.js', array(), $theme_version, false );

    wp_enqueue_style( 'baysidecommunity-admin-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', [], $theme_version, 'all' );

}
add_action( 'admin_enqueue_scripts', 'baysidecommunity_load_admin_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function baysidecommunity_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'baysidecommunity_skip_link_focus_fix' );



/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function baysidecommunity_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'baysidecommunity' ),
		'expanded' => __( 'Desktop Expanded Menu', 'baysidecommunity' ),
		'mobile'   => __( 'Mobile Menu', 'baysidecommunity' ),
		'footer'   => __( 'Footer Menu', 'baysidecommunity' ),
		'social'   => __( 'Social Menu', 'baysidecommunity' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'baysidecommunity_menus' );



if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function baysidecommunity_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'baysidecommunity' ) . '</a>';
}

add_action( 'wp_body_open', 'baysidecommunity_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baysidecommunity_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'baysidecommunity' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'baysidecommunity' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'baysidecommunity' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'baysidecommunity' ),
			)
		)
	);

}

add_action( 'widgets_init', 'baysidecommunity_sidebar_registration' );


/**
 * Enqueue classic editor styles.
 */
function baysidecommunity_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'baysidecommunity_classic_editor_styles' );




/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function baysidecommunity_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'baysidecommunity_read_more_tag' );


/*=======================================================================
===================Bayside custom======================================
=======================================================================*/

if ( ! function_exists( 'baysidecommunity_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function baysidecommunity_setup() {
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        add_image_size( '1920x920', 1920, 920, true );
        add_image_size( '1920x420', 1920, 420, true );
        add_image_size( '700x300', 700, 300, true );
        add_image_size( '620x350', 620, 350, true );
        add_image_size( '460x440', 460, 440, true );
        add_image_size( '460x300', 460, 300, true );
        add_image_size( '460x260', 460, 260, true );
        add_image_size( '460x330', 460, 330, true );
        add_image_size( '300x300', 300, 300, true );
        


        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_editor_style( 'assets/css/editor.css' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'menu-1' => __( 'Primary', 'baysidecommunity' ),
                'footer' => __( 'Footer Menu', 'baysidecommunity' )
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'baysidecommunity_setup' );

/**
 * Print meta box value
 *
 * @param string  The meta box name.
 * @param int     The post id.
 */
function the_field( $control, $post_id = null ) {
	echo get_field( $control, $post_id );
}

/**
 * Return meta box value
 *
 * @param string  The meta box name.
 * @param int     The post id.
 */
function get_field( $control, $post_id = null ) {
	if ($post_id) {
		return get_post_meta( $post_id, $control, true );
	} else {
		return get_post_meta( get_the_ID(), $control, true );
	}
}
/**
 * Get option list pages
 *
 */
function get_dropdown_pages() {
	$pages = get_pages();

	$option = [];
	foreach ($pages as $page) {
		$option[$page->ID] = array($page->post_title);
	}

	return $option;
}


/**
 * Get option list pages
 *
 */
function get_dropdown_posts() {
	$posts = get_posts();

	$option = [];
	foreach ($posts as $post) {
		$option[$post->ID] = array($post->post_title);
	}

	return $option;
}

function contact_submission($subject)
{
	if ( isset( $_POST ) && ! empty( $_POST ) )
	{
		$post = array(
			'type'  		=> sanitize_text_field( $_POST['type'] ),
			'message'  		=> sanitize_text_field( $_POST['message'] ),
			'fname'  		=> sanitize_text_field( $_POST['fname'] ),
			'cemail'    	=> sanitize_email( $_POST['cemail'] ),
			'recaptcha' 	=> $_POST['g-recaptcha-response']
		);

		$_SESSION['type'] 			= $post['type'];
		$_SESSION['message'] 		= $post['message'];
		$_SESSION['fname'] 			= $post['fname'];
		$_SESSION['cemail'] 		= $post['cemail'];

		$submission = array();

		$post_data = http_build_query(
		    array(
		        'secret'   => "6LccwS8UAAAAAEF1lq8lc7Y6Wsmnol1EWtQBmQHm",
		        'response' => $post['recaptcha'],
		        'remoteip' => $_SERVER['REMOTE_ADDR']
		    )
		);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $post_data
		    )
		);

		$context  = stream_context_create( $opts );
		$response = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify', false, $context );
		$result   = json_decode( $response );

		if( !$result->success )
			$submission['recaptcha'] = 'Gah! CAPTCHA verification failed. Please try again.';


		if ( empty( $submission ) )
		{
			// send enquiry email
			$sent = contact_submission_email( $post, $subject );

			if ( $sent )
			{
				unset( $_SESSION['type'] );
				unset( $_SESSION['message'] );
				unset( $_SESSION['fname'] );
				unset( $_SESSION['cemail'] );
				$submission['success'] = 1;
			} else {
				$submission['error']   = 'An error was encountered while submitting your enquiry. Please try again later.';
			}
		}

		return $submission;
	}
}

function contact_submission_email( $post, $subject)
{
	$subject = get_bloginfo( 'name' ) . ':'.$subject;
	$contactEmail = get_option('contact_email');
	$contactEmail = explode(",",$contactEmail);

	$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>'. $subject .'</title>
		</head>
		<body>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="300" align="left" valign="top"><strong>First Name:</strong></td>
					<td align="left" valign="top">' . $post['fname'] . '</td>
				</tr>
				<tr><td>&nbsp;</td><td></td></tr>
				
				<tr>
					<td width="300" align="left" valign="top"><strong>Email address:</strong></td>
					<td align="left" valign="top">' . $post['cemail'] . '</td>
				</tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<tr>
					<td width="300" align="left" valign="top"><strong>Enquiry Type:</strong></td>
					<td align="left" valign="top">' . $post['type'] . '</td>
				</tr>
				<tr><td>&nbsp;</td><td></td></tr>
				<tr>
					<td width="300" align="left" valign="top"><strong>Message</strong></td>
					<td align="left" valign="top">' . $post['message'] . '</td>
				</tr>
				<tr><td>&nbsp;</td><td></td></tr>

			</table>
		</body>
		</html>';

	$headers = array(
		'MIME-Version: 1.0',
		'Content-type: text/html; charset=iso-8859-1',
		sprintf( 'From: %1$s <%2$s>', get_bloginfo( 'name' ), $contactEmail ? $contactEmail[0] : get_bloginfo( 'admin_email' ) ),
		'Bcc: 360@360south.com.au',
		'Reply-To: ' . $post['fname'] . ' <' . $post['cemail'] . '>'
	);

	$message = rawurldecode( $message );

	return wp_mail( $contactEmail ? $contactEmail : get_bloginfo( 'admin_email' ), $subject, $message, $headers );
}

/** Butterbean include folder */
define('BUTTERBEAN', get_template_directory_uri() . '/inc/butterbean/');

/** include folder */
define('INCLUDE_FOLDER', get_template_directory() . '/inc/');

/** classes folder */
define('CLASSES_FOLDER', get_template_directory() . '/classes/');

/**
 * Load ButterBean.
 */
require INCLUDE_FOLDER . 'butterbean/butterbean.php';

/**
 * Load ButterBean Extensions.
 */
require INCLUDE_FOLDER . 'butterbean-extras/class-register-meta.php';

/**
 * Setting class.
 */
require CLASSES_FOLDER . 'class-setting.php';

/**
 * Collections class.
 */
require CLASSES_FOLDER . 'class-programs.php';

/**
 * People class.
 */
require CLASSES_FOLDER . 'class-people.php';

/**
 * Home class.
 */
require CLASSES_FOLDER . 'class-home.php';

/**
 * Page class.
 */
require CLASSES_FOLDER . 'class-page.php';


/**
 * Connect class.
 */
require CLASSES_FOLDER . 'class-gallery.php';

/**
 * Connect class.
 */
require CLASSES_FOLDER . 'class-faq.php';

/**
 * blog class.
 */
require CLASSES_FOLDER . 'class-blog.php';


