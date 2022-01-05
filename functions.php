<?php

/**
 * Vacarme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Vacarme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '0.1.0');
}

if (!function_exists('vacarme_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function vacarme_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Vacarme, use a find and replace
		 * to change 'vacarme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('vacarme', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'vacarme'),
			)
		);

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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'vacarme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
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
endif;
add_action('after_setup_theme', 'vacarme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vacarme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('vacarme_content_width', 640);
}
add_action('after_setup_theme', 'vacarme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vacarme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'vacarme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'vacarme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'vacarme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function vacarme_scripts()
{
	wp_enqueue_style("bootstrap-style", 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), null);
	wp_enqueue_style("leaflet-style", 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), null);
	wp_enqueue_style('vacarme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('vacarme-style', 'rtl', 'replace');
	wp_enqueue_style('dynamic-map-style', get_template_directory_uri() . '/css/dynamic-map.css', array(), null);

	wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
	wp_enqueue_script('leaflet-script', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), null, true);
	wp_enqueue_script('vacarme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('dynamic-map-script', get_template_directory_uri() . '/js/dynamic-map.js', array(), null, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	add_filter('script_loader_tag', 'add_sctipt_attributes', 10, 3);
}
add_action('wp_enqueue_scripts', 'vacarme_scripts');

function admin_bar_fullscreen_handle()
{
	if (is_admin_bar_showing()) {
?>
		<style>
			.fullscreen-page body {
				padding-bottom: 32px;
			}

			.navbar.fixed-top {
				margin-top: 32px
			}
		</style>
<?php
	}
}
add_action('wp_head', 'admin_bar_fullscreen_handle');

function add_style_attributes($html, $handle)
{
	if ('bootstrap-style' === $handle) {
		return str_replace('media="all"', 'integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"', $html);
	}
	if ('leaflet-style' === $handle) {
		return str_replace('media="all"', 'integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""', $html);
	}

	return $html;
}
add_filter('style_loader_tag', 'add_style_attributes', 10, 2);


function add_sctipt_attributes($tag, $handle, $src)
{
	if ('bootstrap-script' === $handle) {
		return '<script src="' . $src . '" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>' . "\n";
	}
	if ('leaflet-script' == $handle) {
		return '<script src="' . $src . '" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>' . "\n";
	}

	return $tag;
}

function add_menu_link_class($atts, $item, $args)
{
	if (property_exists($args, 'link_class')) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args)
{
	if (property_exists($args, 'list_item_class')) {
		$classes[] = $args->list_item_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
