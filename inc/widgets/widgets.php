<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage stnewsportal
 * @since      stnewsportal 1.0
 */
add_action( 'widgets_init', 'stnewsportal_widgets_init' );

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function stnewsportal_widgets_init() {

	/**
	 * Registering widget areas for front page
	 */
	// Registering main right sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'stnewsportal' ),
		'id'            => 'stnewsportal_right_sidebar',
		'description'   => esc_html__( 'Shows widgets at Right side.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'stnewsportal' ),
		'id'            => 'stnewsportal_left_sidebar',
		'description'   => esc_html__( 'Shows widgets at Left side.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Header sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Top Header Sidebar', 'stnewsportal' ),
		'id'            => 'stnewsportal_top_navbar_adds_section',
		'description'   => esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


	// registering the Front Page: Top featured news portal
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Top Featured News Section', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_top_featured_news_area',
		'description'   => esc_html__( 'Show widget just below menu. Suitable for Featured Top News', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Slider Area Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Main News Area', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_main_news_area',
		'description'   => esc_html__( 'This widget is for showing main news below featured news.', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Area beside slider Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Area beside Main News', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_area_beside_main_news',
		'description'   => esc_html__( 'Show Popular and recent posts', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Top Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Top Section', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_content_top_section',
		'description'   => esc_html__( 'Content Top Section', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Middle Left Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Middle Left Section', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_content_middle_left_section',
		'description'   => esc_html__( 'Content Middle Left Section', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Middle Right Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Middle Right Section', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_content_middle_right_section',
		'description'   => esc_html__( 'Content Middle Right Section', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Bottom Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Bottom Section', 'stnewsportal' ),
		'id'            => 'stnewsportal_front_page_content_bottom_section',
		'description'   => esc_html__( 'Content Bottom Section', 'stnewsportal' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Page Sidebar', 'stnewsportal' ),
		'id'            => 'stnewsportal_contact_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Contact Page Template.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Error 404 Page Sidebar', 'stnewsportal' ),
		'id'            => 'stnewsportal_error_404_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering advertisement above footer sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Advertisement Above The Footer', 'stnewsportal' ),
		'id'            => 'stnewsportal_advertisement_above_the_footer_sidebar',
		'description'   => esc_html__( 'Shows widgets just above the footer, suitable for TG: 728x90 Advertisement widget.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'stnewsportal' ),
		'id'            => 'stnewsportal_footer_sidebar_one',
		'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar two
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Two', 'stnewsportal' ),
		'id'            => 'stnewsportal_footer_sidebar_two',
		'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar three
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Three', 'stnewsportal' ),
		'id'            => 'stnewsportal_footer_sidebar_three',
		'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar four
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Four', 'stnewsportal' ),
		'id'            => 'stnewsportal_footer_sidebar_four',
		'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'stnewsportal' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_widget( 'stnewsportal_front_page_top_featured_news_area' );
	register_widget( 'stnewsportal_front_page_main_news_area' );
	register_widget( 'stnewsportal_recent_popular_tab_widget' );
	register_widget( 'stnewsportal_highlighted_posts_widget' );
	register_widget( 'stnewsportal_featured_posts_widget' );
	register_widget( 'stnewsportal_featured_posts_vertical_widget' );
	register_widget( 'stnewsportal_728x90_advertisement_widget' );
	register_widget( 'stnewsportal_300x250_advertisement_widget' );
	register_widget( 'stnewsportal_125x125_advertisement_widget' );
}

// Require file for Fetured Top News widget area.
require  STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-top-featured-news-widget.php';

// Require file for ST: Main news widget area .
require  STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-front-main-news-widget.php';

// Require file for recent and popular tab
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-recent-popular-tab-widget.php';

// Require file for TG: Highlighted Posts.
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-highlighted-posts-widget.php';

// // Require file for TG: Featured Posts (Style 1).
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-featured-posts-widget.php';

// // Require file for TG: Featured Posts (Style 2).
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-featured-posts-vertical-widget.php';

// // Require file for TG: 300x250 Advertisement.
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-300x250-advertisement-widget.php';

// // Require file for TG: 728x90 Advertisement.
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-728x90-advertisement-widget.php';

// // Require file for TG: 125x125 Advertisement.
require STNEWSPORTAL_WIDGETS_DIR . '/stnewsportal-125x125-advertisement-widget.php';