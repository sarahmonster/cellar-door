<?php
/**
 * Cellar Door functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cellar_Door
 */

if ( ! function_exists( 'cellardoor_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cellardoor_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Cellar Door, use a find and replace
	 * to change 'cellar-door' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cellar-door', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 400,
		'width'       => 400,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'cellardoor-feature', 1000, 600, true );
	add_image_size( 'cellardoor-card', 650, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'cellar-door' ),
	) );

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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cellardoor_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'cellardoor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cellardoor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cellardoor_content_width', 1200 );
}
add_action( 'after_setup_theme', 'cellardoor_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cellardoor_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cellar-door' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'First Footer Widget Area', 'cellar-door' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Second Footer Widget Area', 'cellar-door' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Third Footer Widget Area', 'cellar-door' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cellardoor_widgets_init' );

/**
 * Register Google Fonts
 */
 function cellardoor_fonts_url() {
     $fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Arvo, translate this to 'off'. Do not translate
	 * into your own language.
	 */
 	$serif = esc_html_x( 'on', 'Domine font: on or off', 'cellardoor' );

	/* Translators: If there are characters in your language that are not
	 * supported by Poppins, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$sans = esc_html_x( 'on', 'Poppins font: on or off', 'cellardoor' );

	$font_families = array();

	if ( 'off' !== $serif ) {
		$font_families[] = 'Domine:400,700';
		$font_families[] = 'Lora:400i,700i';
	}

	if ( 'off' !== $sans ) {
		$font_families[] = 'Poppins:300,400,500,600,700';
	}

	if ( 'off' !== $serif || 'off' !== $sans ) {
 		$query_args = array(
 			'family' => urlencode( implode( '|', $font_families ) ),
 			'subset' => urlencode( 'latin,latin-ext' ),
 		);

 		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
 	}

 	return $fonts_url;

 }

 /**
  * Enqueue Google Fonts for Editor Styles
  */
 function cellardoor_editor_styles() {
     add_editor_style( array( 'editor-style.css', cellardoor_fonts_url() ) );
 }
 add_action( 'after_setup_theme', 'cellardoor_editor_styles' );

 /**
  * Enqueue Google Fonts for custom headers
  */
 function cellardoor_admin_scripts( $hook_suffix ) {
	 wp_enqueue_style( 'cellardoor-fonts', cellardoor_fonts_url(), array(), null );
 }
 add_action( 'admin_print_styles-appearance_page_custom-header', 'cellardoor_admin_scripts' );

/**
 * Enqueue scripts and styles.
 */
function cellardoor_scripts() {

	wp_enqueue_style( 'cellardoor-fonts', cellardoor_fonts_url(), array(), null );

	wp_enqueue_style( 'cellardoor-style', get_stylesheet_uri() );

	wp_enqueue_script( 'cellardoor-main', get_template_directory_uri() . '/assets/js/cellar-door.js', array( 'jquery' ), time(), true );

	wp_enqueue_script( 'cellardoor-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'cellardoor-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cellardoor_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functionality for categories.
 */
require get_template_directory() . '/inc/categories.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * SVG icon functionality.
 */
require get_template_directory() . '/inc/svg-icons.php';
