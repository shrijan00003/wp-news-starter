<?php
/**
 * Template to show the front page.
 *
 * @package    St-Newsportal
 * @subpackage stnewsportal
 * @since      stnewsportal 1.0
 */
get_header();

// Do not display the front pages sidebar areas when the Page Builder Template is activated
if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) : ?>
<div class="front-page-top-featured-news-widget-section row">
    <div class="top-featured-news-wrapper col-md-12">
        <?php
			if ( is_active_sidebar( 'stnewsportal_front_page_top_featured_news_area' ) ) {
				if ( ! dynamic_sidebar( 'stnewsportal_front_page_top_featured_news_area' ) ):
				endif;
			}
			?>
    </div>

</div>
<?php endif; ?>

<?php  

// // Do not display the front pages sidebar areas when the Page Builder Template is activated
if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) : ?>
<div class="front_page_main_with_recent_tab_section d-flex clearfix">
    <div class="widget_main_news_area col-md-8">
        <?php
			if ( is_active_sidebar( 'stnewsportal_front_page_main_news_area' ) ) {
				if ( ! dynamic_sidebar( 'stnewsportal_front_page_main_news_area' ) ):
				endif;
			}
			?>
    </div>

    <div class="widget_recent_popular_tab col-md-4">
        <?php
			if ( is_active_sidebar( 'stnewsportal_front_page_area_beside_main_news' ) ) {
				if ( ! dynamic_sidebar( 'stnewsportal_front_page_area_beside_main_news' ) ):
				endif;
			}
			?>
    </div>
</div>
<?php endif; ?>

<div class="main-content-section clearfix">
    <div id="primary">
        <div id="content" class="clearfix">

            <?php
				// Do not display the front pages sidebar areas when the Page Builder Template is activated
				if ( is_front_page() && ! is_page_template( 'page-templates/page-builder.php' ) ) :

					if ( is_active_sidebar( 'stnewsportal_front_page_content_top_section' ) ) {
						if ( ! dynamic_sidebar( 'stnewsportal_front_page_content_top_section' ) ):
						endif;
					}

					if ( is_active_sidebar( 'stnewsportal_front_page_content_middle_left_section' ) || is_active_sidebar( 'stnewsportal_front_page_content_middle_right_section' ) ) {
						?>
            <div class="st-one-half">
                <?php
							if ( ! dynamic_sidebar( 'stnewsportal_front_page_content_middle_left_section' ) ):
							endif;
							?>
            </div>

            <div class="st-one-half st-one-half-last">
                <?php
							if ( ! dynamic_sidebar( 'stnewsportal_front_page_content_middle_right_section' ) ):
							endif;
							?>
            </div>

            <div class="clearfix"></div>
            <?php
					}

					if ( is_active_sidebar( 'stnewsportal_front_page_content_bottom_section' ) ) {
						if ( ! dynamic_sidebar( 'stnewsportal_front_page_content_bottom_section' ) ):
						endif;
					}

				endif; // Do not display the front pages sidebar areas when the Page Builder Template is activated

				if ( get_theme_mod( 'stnewsportal_hide_blog_front', 0 ) == 0 ): ?>

            <div class="article-container">
                <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>

                <?php
								if ( is_front_page() && is_home() ) {
									get_template_part( 'content', '' );
								} else if ( is_front_page() ) {
									get_template_part( 'content', 'page' );
								}
								?>

                <?php endwhile; ?>

                <?php get_template_part( 'navigation', 'none' ); ?>

                <?php else : ?>

                <?php get_template_part( 'no-results', 'none' ); ?>

                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>