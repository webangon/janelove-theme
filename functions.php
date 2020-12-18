<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

if ( ! function_exists( 'janelove_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function janelove_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change 'janelove' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'janelove', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo' );
 
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_attr__( 'Primary', 'janelove' ),
		) );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'janelove_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'janelove_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function janelove_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'janelove_content_width', 640 );
}
add_action( 'after_setup_theme', 'janelove_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function janelove_widgets_init() {
	register_sidebar( array(
		'name'          => esc_attr__( 'Sidebar', 'janelove' ),
		'id'            => 'sidebar-1',
		'description'   => esc_attr__( 'Add widgets here.', 'janelove' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-head"><h3 class="widgetsidetit">',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'janelove_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function janelove_scripts() {

	wp_enqueue_style('janelove-style', get_stylesheet_uri() );	
	wp_enqueue_style( 'janelove-default', get_template_directory_uri() . '/assets/css/default.css');
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css');
	wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/assets/css/fontawesome-all.css');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ); 
	}
	wp_enqueue_script('janelove-script',get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '', true);
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '', true);
	wp_enqueue_style('dashicons');

}
add_action( 'wp_enqueue_scripts', 'janelove_scripts' );

/*Gutenberg style*/

// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'janelove_gutenberg_editor_assets');

function janelove_gutenberg_editor_assets() {
  // Load the theme styles within Gutenberg.
  wp_enqueue_style('janelove-gutenberg-editor', get_template_directory_uri() . '/assets/css/gutenberg.css');
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Functions which loaded from plugin.
 */
require get_template_directory() . '/inc/plug-dependent.php';

/**
 * Load plugin recommendation.
 */
 
require_once get_template_directory() . '/inc/plugin-recommendations.php';

