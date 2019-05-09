<?php
/**
 * Highlighted Posts widget
 */

class stnewsportal_recent_popular_tab_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'popular_recent_news_widget',
			'description'                 => __( 'Display Popular and Recent News', 'stnewsportal' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'ST:Popular and Recent News Tabs', 'stnewsportal' ), $widget_ops );
	}

	function form( $instance ) {
		// this form section will be updated later
	}	

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['number']   = absint( $new_instance['number'] );
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$number   = empty( $instance['number'] ) ? 3 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : 'featured';

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'post_status'         => $post_status,
			'no_found_rows'       => true,
		);

		// Display from category chosen.
		if ( $type == 'category' ) {
			$args['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query( $args );

		echo $before_widget;
		?>
<div class="popular_recent_news_tab_section">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#recent">Recent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#popular">Popular</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade" id="recent">
            <ul class="list-group">
                <?php 
				  $recent = new WP_Query('posts_per_page='. 5 .'&orderby=post_date&order=desc&post_status=publish');
				  $i=1;
				  if($recent->have_posts()): while ($recent->have_posts()): $recent->the_post();
				  ?>
                <li class="list-group-item d-flex justify-content-start align-items-center m-2">
                    <span class="badge badge-primary badge-pill px-2">
                        <?php echo $i; ?>
                    </span>
                    <span class="tab_content_title px-2">
                        <?php the_title(); ?>
                    </span>
                    <?php $i+=1; ?>
                </li>
                <?php endwhile; endif; wp_reset_query(); ?>
            </ul>
        </div>
        <?php 
		/**"
		 * FOR POPULAR POSTS
		 */
		 ?>
        <div class="tab-pane fade active show" id="popular">
            <ul class="list-group">
                <?php 
				$popular = new WP_Query( array('ignore_sticky_posts' => 1, 'posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'meta_value_num', 'meta_key' => 'stnewsportal_post_views_count', 'order' => 'desc'));
				if($popular->have_posts()): while ($popular->have_posts()) : $popular->the_post(); 
				 ?>
                <li class="list-group-item d-flex justify-content-start align-items-center m-2">
                    <span class="badge badge-primary badge-pill px-2">
                        <?php echo stnewsportal_get_post_views(get_the_ID()) ?>
                    </span>
                    <span class="tab_content_title px-2">
                        <?php the_title(); ?>
                    </span>
                </li>
                <?php endwhile; endif; wp_reset_query(); ?>

            </ul>
        </div>

    </div>
</div>
<?php
		echo $after_widget;
	}

}

//https://www.wpbeginner.com/wp-tutorials/how-to-track-popular-posts-by-views-in-wordpress-without-a-plugin/

//  for creating custom popular posts and we will have a look on it