<?php
/**
 * Projeto Alpina functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Projeto_Alpina
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


// codyhouse
function codyframe_register_styles() {

  $theme_version = wp_get_theme()->get( 'Version' );

  wp_enqueue_style( 'codyframe', get_template_directory_uri() . '/main/assets/css/style.css', array(), $theme_version );
}

add_action( 'wp_enqueue_scripts', 'codyframe_register_styles' );

function codyframe_register_scripts() {

  $theme_version = wp_get_theme()->get( 'Version' );

  wp_enqueue_script( 'codyframe', get_template_directory_uri() . '/main/assets/js/scripts.js', array(), $theme_version, true );
}

add_action( 'wp_enqueue_scripts', 'codyframe_register_scripts' );

// no-js support
function codyframe_js_support() {
  ?>
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <?php
}

add_action( 'wp_print_scripts', 'codyframe_js_support');

// codyhouse

if ( ! function_exists( 'projeto_alpina_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function projeto_alpina_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Projeto Alpina, use a find and replace
		 * to change 'projeto-alpina' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'projeto-alpina', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'projeto-alpina' ),
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
				'projeto_alpina_custom_background_args',
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
add_action( 'after_setup_theme', 'projeto_alpina_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function projeto_alpina_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'projeto_alpina_content_width', 640 );
}
add_action( 'after_setup_theme', 'projeto_alpina_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function projeto_alpina_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'projeto-alpina' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'projeto-alpina' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'projeto_alpina_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function projeto_alpina_scripts() {
	wp_enqueue_style( 'projeto-alpina-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'projeto-alpina-style', 'rtl', 'replace' );

	wp_enqueue_script( 'projeto-alpina-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'projeto_alpina_scripts' );

add_action( 'init', 'create_post_type_cpts' );
     //criação CPT
function create_post_type_cpts() {

$labels = array(
 'name' => _x('carousels', 'post type general name'),
 'singular_name' => _x('carousel', 'post type singular name'),
 'add_new' => _x('Adicionar Novo', 'carousel'),
 'add_new_item' => __('Adicionar Novo carousel'),
 'edit_item' => __('Editar carousel'),
 'new_item' => __('Novo carousels'),
 'all_items' => __('Todos os carousels'),
 'view_item' => __('Ver carousel'),
 'search_items' => __('Pesquisar carousels'),
 'not_found' =>  __('Nenhum carousel Encontrado'),
 'not_found_in_trash' => __('Nenhum carousel na Lixeira'),
 'parent_item_colon' => '',
 'menu_name' => 'carousels'
);

register_post_type( 'carousels', array(
 'labels' => $labels,
 'public' => true,
 'publicly_queryable' => true,
 'show_ui' => true,
 'show_in_menu' => true,
 'has_archive' => 'carousels',
 'rewrite' => array(
  'slug' => 'carousels',
  'with_front' => false,
 ),
 'capability_type' => 'post',
 'has_archive' => true,
 'hierarchical' => false,
 'menu_position' => null,
 'supports' => array('title','revisions')
 )
);

}
//criação meta box

add_filter( 'rwmb_meta_boxes', function ( $meta_boxes ) {
    $meta_boxes[] = [
        'title'  => 'A demo meta box',
		 'id'         => 'carousels',
		'post_types' => array( 'carousels' ),
        'fields' => [
            
				array(
					'id'               => 'carousels_imagem',
					'name'             => 'Imagem carousels ',
					'type'             => 'image_advanced',
				
					// Delete image from Media Library when remove it from post meta?
					// Note: it might affect other posts if you use same image for multiple posts
					'force_delete'     => false,
				
					// Maximum image uploads.
					'max_file_uploads' => 1,
				
					// Do not show how many images uploaded/remaining.
					'max_status'       => false,
				
					// Image size that displays in the edit page. Possible sizes small,medium,large,original
					'image_size'       => 'thumbnail',
				),
				
            
            
        ],
    ];
    return $meta_boxes;
});

