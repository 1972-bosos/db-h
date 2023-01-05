<?php
/**
 * Dock B Hamburg functions and definitions
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '2.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function dock_b_hamburg_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'dock-b-hamburg', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'admin-menu'  => 'Kopfzeile-Admin',
			'member-menu' => 'Kopfzeile-Midglied',
			'main-menu'   => 'Kopfzeile',
			'footer-menu' => 'Fußzeile'
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'dock_b_hamburg_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'dock_b_hamburg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function dock_b_hamburg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dock_b_hamburg_content_width', 1320 );
}
add_action( 'after_setup_theme', 'dock_b_hamburg_content_width', 0 );

/**
 * Register widget area.
 */
function dock_b_hamburg_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dock-b-hamburg' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dock-b-hamburg' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dock_b_hamburg_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dock_b_hamburg_scripts() {
	// Styles
	wp_enqueue_style( 'dock-b-hamburg-main-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'dock-b-hamburg-app-style', get_stylesheet_directory_uri() . '/dist/app.css', array(), null, 'all' );
	wp_style_add_data( 'dock-b-hamburg-style', 'rtl', 'replace' );
	// Scripts
	wp_enqueue_script( 'dock-b-hamburg-app-script', get_template_directory_uri() . '/dist/app.js', array('jquery'), null, true );
	wp_enqueue_script( 'dock-b-hamburg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dock_b_hamburg_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

