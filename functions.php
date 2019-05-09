<?php
/**
 * stnewsportal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package stnewsportal
 */

if ( ! function_exists( 'stnewsportal_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function stnewsportal_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on stnewsportal, use a find and replace
		 * to change 'stnewsportal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'stnewsportal', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'stnewsportal' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'stnewsportal_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'stnewsportal_setup' );

/**
 * Add Editor style sheet
 */

 function stnewsportal_add_editor_style(){
	 add_editor_style('/dist/editor-style.css');
 }
 add_action('admin_init', 'stnewsportal_add_editor_style');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stnewsportal_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'stnewsportal_content_width', 1140 );
}
add_action( 'after_setup_theme', 'stnewsportal_content_width', 0 );



/**
 * Enqueue scripts and styles.
 */
function stnewsportal_scripts() {
	wp_enqueue_style( 'stnewsportal-bs-style', get_template_directory_uri().'/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'stnewsportal-main-style', get_template_directory_uri().'/dist/css/main.min.css' );
	// wp_enqueue_style( 'stnewsportal-fontawesome-style', get_template_directory_uri().'/fonts/font-awesome/css/font-awesome.min.css' );
	// wp_register_style('stnewsportal-fontawesome-style', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, true);
	wp_enqueue_style('stnewsportal-fontawesome-style');
	wp_enqueue_style( 'stnewsportal-style', get_stylesheet_uri() );

	//popper js
	wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js',false, true);
	wp_enqueue_script( 'popper');
//jqyery
	wp_enqueue_script('jquery',  get_template_directory_uri().'/src/js/jquery.min.js', array('jquery'), microtime(), true);
	//bootstrap
	wp_enqueue_script('stnewsportal-bs-js',  get_template_directory_uri().'/src/js/bootstrap.js', array('jquery'), microtime(), true);
	//bootsrap hover
	wp_enqueue_script('bootstrap-hover-js',  get_template_directory_uri().'/src/js/bootstrap-hover.js', array('jquery'), microtime(), true);
	
	//scroll to top
	wp_enqueue_script('scroll-top-js',  get_template_directory_uri().'/src/js/nav-scroll.js', array('jquery'), microtime(), true);

	wp_enqueue_script( 'stnewsportal-skip-link-focus-fix', get_template_directory_uri() . '/src/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'stnewsportal_scripts' );

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
 * Adding Widget Area.
 */
// require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Bootstrap Nav Walker.
 */
require get_template_directory() . '/inc/bs-wp-navwalker.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Define Directory Location Constants
 */
define( 'STNEWSPORTAL_PARENT_DIR', get_template_directory() );
define( 'STNEWSPORTAL_CHILD_DIR', get_stylesheet_directory() );

define( 'STNEWSPORTAL_INCLUDES_DIR', STNEWSPORTAL_PARENT_DIR . '/inc' );
define( 'STNEWSPORTAL_SRC_DIR', STNEWSPORTAL_PARENT_DIR . '/src' );
define( 'STNEWSPORTAL_CSS_DIR', STNEWSPORTAL_PARENT_DIR . '/css' );
define( 'STNEWSPORTAL_JS_DIR', STNEWSPORTAL_PARENT_DIR . '/js' );
define( 'STNEWSPORTAL_LANGUAGES_DIR', STNEWSPORTAL_PARENT_DIR . '/languages' );

define( 'STNEWSPORTAL_ADMIN_DIR', STNEWSPORTAL_INCLUDES_DIR . '/admin' );
define( 'STNEWSPORTAL_WIDGETS_DIR', STNEWSPORTAL_INCLUDES_DIR . '/widgets' );
define( 'STNEWSPORTAL_ELEMENTOR_DIR', STNEWSPORTAL_INCLUDES_DIR . '/elementor' );
define( 'STNEWSPORTAL_ELEMENTOR_WIDGETS_DIR', STNEWSPORTAL_ELEMENTOR_DIR . '/widgets' );

define( 'STNEWSPORTAL_ADMIN_IMAGES_DIR', STNEWSPORTAL_ADMIN_DIR . '/images' );

/**
 * Define URL Location Constants
 */
define( 'STNEWSPORTAL_PARENT_URL', get_template_directory_uri() );
define( 'STNEWSPORTAL_CHILD_URL', get_stylesheet_directory_uri() );

define( 'STNEWSPORTAL_INCLUDES_URL', STNEWSPORTAL_PARENT_URL . '/inc' );
define( 'STNEWSPORTAL_CSS_URL', STNEWSPORTAL_PARENT_URL . '/css' );
define( 'STNEWSPORTAL_JS_URL', STNEWSPORTAL_PARENT_URL . '/dist/js' );
define( 'STNEWSPORTAL_LANGUAGES_URL', STNEWSPORTAL_PARENT_URL . '/languages' );
define( 'STNEWSPORTAL_IMAGE_URL', STNEWSPORTAL_PARENT_URL . '/src/images' );


define( 'STNEWSPORTAL_ADMIN_URL', STNEWSPORTAL_INCLUDES_URL . '/admin' );
define( 'STNEWSPORTAL_WIDGETS_URL', STNEWSPORTAL_INCLUDES_URL . '/widgets' );
define( 'STNEWSPORTAL_ELEMENTOR_URL', STNEWSPORTAL_INCLUDES_URL . '/elementor' );
define( 'STNEWSPORTAL_ELEMENTOR_WIDGETS_URL', STNEWSPORTAL_ELEMENTOR_URL . '/widgets' );

define( 'STNEWSPORTAL_ADMIN_IMAGES_URL', STNEWSPORTAL_ADMIN_URL . '/images' );


/**
 * Adding Widget Area.
 */
require STNEWSPORTAL_WIDGETS_DIR . '/widgets.php';

/**
 * @param int PostId
 * @description	function to set post views
 * 
 */
function stnewsportal_set_post_views($postId){
	$count_key = 'stnewsportal_post_views_count';
    $count = get_post_meta($postId, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postId, $count_key);
        add_post_meta($postId, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postId, $count_key, $count);
    }
}

/**
 * 
 */
function stnewsportal_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    stnewsportal_set_post_views($post_id);
}
add_action( 'wp_head', 'stnewsportal_track_post_views');


/**
 * @param Int post id
 * @description to get the post views of specific post
 */
function stnewsportal_get_post_views($postID){
    $count_key = 'stnewsportal_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

/**
 * @desc Pagination with numeric value
 */
function stnewsportal_numeric_posts_nav() {
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul class="pagination">' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="page-item page-link">%s</li>' . "\n",get_previous_posts_link('<< अघिल्लो ')  );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="page-item active"' : '';
 
        printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li class="page-item">…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="page-item active"' : '';
        printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="page-item">…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="page-item page-link">%s</li>' . "\n", get_next_posts_link('थप >>') );
 
    echo '</ul></div>' . "\n";
 
}

/**
 * @desc To get the custom length of the excerpt as by default wordpress return 55 character
 * @param int length
 * @return number of character in excerpt
 */

function stnewsportal_custom_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'stnewsportal_custom_excerpt_length', 999 );

/**
 * @desc Image Uploader using with admin panel for different widgets
 * @param null
 * @return null
 */
function stnewsportal_image_uploader() {
	wp_enqueue_media();
	wp_enqueue_script( 'stnewsportal-widget-image-upload', STNEWSPORTAL_JS_URL . '/image-uploader.js', false, microtime(), true );
	
}

add_action( 'admin_enqueue_scripts', 'stnewsportal_image_uploader' );