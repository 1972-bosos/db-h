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
 * Enqueue scripts and styles.
 */
function dock_b_hamburg_scripts() {
	// Styles
	wp_enqueue_style( 'dock-b-hamburg-main-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'dock-b-hamburg-app-style', get_stylesheet_directory_uri() . '/dist/app.css', array(), null, 'all' );
	// Scripts
	wp_enqueue_script( 'dock-b-hamburg-app-script', get_template_directory_uri() . '/dist/app.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'dock_b_hamburg_scripts' );

/**
 * Register post type
 */
function register_custum_post() {
	//Pages top banners
	$args = array(
        'public'   => true,
        'label'    => 'Seiten-Top-Banner',
        'supports' => array( 'title' ),
		'rewrite'  => array( 'slug' => 'seiten-top-banner' )
    );
	register_post_type( 'pages-top-banners', $args );
	//Story in numbers
	$args = array(
        'public'   => true,
        'label'    => 'Geschichte',
        'supports' => array( 'title' ),
		'rewrite'  => array( 'slug' => 'geschichte-in-zahlen' )
    );
	register_post_type( 'story-in-numbers', $args );
	//Group meeting
	$args = array(
        'public'     => true,
        'label'      => 'Gruppentreffen',
        'supports'   => array( 'title' ),
		'rewrite'    => array( 'slug' => 'gruppentreffen' ),
		'supports'   => array( 'title', 'editor' ),
		'taxonomies' => array( 'category' ),
    );
	register_post_type( 'group-meeting', $args );
}
add_action( 'init', 'register_custum_post' );

/*  
* Register shortcodes
*/
//Story in numbers
function story_in_numbers_shortcode($attr) {
	ob_start();
	get_template_part( 'template-parts/content', 'story-in-numbers' );
	return ob_get_clean();
}
add_shortcode('story_in_numbers', 'story_in_numbers_shortcode');
//Registration section
function registration_shortcode($attr) {
	ob_start();
	get_template_part( 'template-parts/content', 'registration' );
	return ob_get_clean();
}
add_shortcode('registration', 'registration_shortcode');
//Registration form
function registration_form_shortcode($attr) {
	ob_start();
	get_template_part( 'template-parts/content', 'registration-form' );
	return ob_get_clean();
}
add_shortcode('registration_form', 'registration_form_shortcode');
//Meetings
function meetings_shortcode($attr) {
	ob_start();
	get_template_part( 'template-parts/content', 'meetings' );
	return ob_get_clean();
}
add_shortcode('meetings', 'meetings_shortcode');
//Invitations
function invitations_shortcode($attr) {
	ob_start();
	get_template_part( 'template-parts/content', 'invitation-form' );
	return ob_get_clean();
}
add_shortcode('invitations', 'invitations_shortcode');
//Meetings list
function meetings_list_shortcode($attr) {
	ob_start();
	get_template_part( 'template-parts/content', 'meetings-list' );
	return ob_get_clean();
}
add_shortcode('meetings_list', 'meetings_list_shortcode');

/*
* Retrieves the attachment ID from the file URL
*/
function pippin_get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
    return $attachment[0]; 
}

/**
* Switch Show text before more
*/
function showBeforeMore($fullText){
    if(@strpos($fullText, '<!--more-->')){
        $morePos = strpos($fullText, '<!--more-->');
        print substr($fullText,0,$morePos);
    } else {
        print $fullText;
    }
}

/**
* Manage sections columns for top pages banners
*/
function page_sections_columns($columns) {
    $post_type = get_post_type();
    if ( $post_type == 'pages-top-banners' ) {
        $columns = array(
            'cb'    => $columns['cb'],
			'title' => __( 'Title' ),
      		'image' => __( 'Bild', 'data' ),
      		'page'  => __( 'Seiten', 'data' ),
			'date'  => __( 'Datum' ) 
        );
        return $columns;
    } else {
		$columns = array(
            'cb'    => $columns['cb'],
			'title' => __( 'Title' ),
			'date'  => __( 'Datum' ) 
        );
        return $columns;
	}
}
add_filter( 'manage_posts_columns',  'page_sections_columns' );

function data_sections_column( $column, $post_id ) {
	//Image
	if ( 'image' === $column ) {
		$image_url = get_field('top_banner_picture');
		echo '<img src="' . $image_url . '"width="150">';
	}
	//Page
	if ( 'page' === $column ) {
		if ( get_field('top_banner_on_page') ) {
			$pages_url = get_field('top_banner_on_page');
			foreach( $pages_url as $page_url ) { 
				echo get_the_title($page_url); ?> <br>
			<?php }
		} else {
			echo "Seite wurde nicht ausgewählt";
		}
	}
}
add_action( 'manage_posts_custom_column', 'data_sections_column', 10, 2);

/*
* Second logo
*/
function second_logo_customize_register($wp_customize){
	$wp_customize->add_setting('second_logo');
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'second_logo', array(
    	'label'    => __('zusätzliches Logo', 'store-front'),
    	'section'  => 'title_tagline',
    	'settings' => 'second_logo',
    	'priority' => 8,
	)));
}
add_action('customize_register', 'second_logo_customize_register');