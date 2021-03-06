<?php
/**
 * Highlighted Posts widget
 */

class stnewsportal_front_page_top_featured_news_area extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_top_featured_news  widget_featured_meta',
			'description'                 => __( 'Top featured news suitable for featured news to display', 'stnewsportal' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'ST: Featured Top News Section', 'stnewsportal' ), $widget_ops );
	}

	function form( $instance ) {
		$st_defaults['number']   = 3;
		$st_defaults['type']     = 'latest';
		$st_defaults['category'] = 'featured';
		$instance                = wp_parse_args( ( array ) $instance, $st_defaults );
		$number                  = $instance['number'];
		$type                    = $instance['type'];
		$category                = $instance['category'];
		?>
<p>
    <label
        for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'stnewsportal' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>"
        type="text" value="<?php echo $number; ?>" size="3" />
</p>

<p>
    <input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
        name="<?php echo $this->get_field_name( 'type' ); ?>"
        value="latest" /><?php _e( 'Show latest Posts', 'stnewsportal' ); ?>
    <br />
    <input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
        name="<?php echo $this->get_field_name( 'type' ); ?>"
        value="category" /><?php _e( 'Show posts from a category', 'stnewsportal' ); ?>
    <br /></p>

<p>
    <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'stnewsportal' ); ?>
        :</label>
    <?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category,
			) ); ?>
</p>
<?php
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
<div class="widget_highlighted_featured_news_section">
    <?php $featured = 'stnewsportal-highlighted-post'; ?>
    <?php
			$i = 1;
			while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
				?>
    <div class="single-article top-featured-single-article m-2">
        <h1 class="entry-title top-featured-title text-center m-2 p-2">
            <a class="entry-title-link" href="<?php the_permalink(); ?>"
                title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h1>
        <?php
					if ( has_post_thumbnail() ) {
						$image           = '';
						$thumbnail_id    = get_post_thumbnail_id( $post->ID );
						$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
						$title_attribute = get_the_title( $post->ID );
						if ( empty( $image_alt_text ) ) {
							$image_alt_text = $title_attribute;
						}
						$image .= '<figure class="highlights-featured-image text-center img-fluid">';
						$image .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
						$image .= get_the_post_thumbnail( $post->ID, $featured, array(
								'title' => esc_attr( $title_attribute ),
								'alt'   => esc_attr( $image_alt_text ),
							) ) . '</a>';
						$image .= '</figure>';
						echo $image;
					} else {
						?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/highlights-featured-image.png">
        </a>
        <?php }
					?>
        <div class="article-content ">

            <div class="below-entry-meta text-center">
                <?php
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
							$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() )
							);
							printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'stnewsportal' ), esc_url( get_permalink() ), esc_attr( get_the_time() ), $time_string
							);
							?>
                <span class="byline"><span class="author vcard mx-2"><i class="fa fa-user"></i><a class="url fn n  px-2"
                            href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                            title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
                <span class="comments"><i
                        class="fa fa-comment px-2"></i><?php comments_popup_link( '0', '1', '%' ); ?></span>
            </div>
            <div class="excerpt-content top-featured-excerpt m-2 p-2 text-center">
                <?php the_excerpt(); ?>
            </div>
        </div>

    </div>
    <?php
				$i ++;
			endwhile;
			// Reset Post Data
			wp_reset_query();
			?>
</div>
<?php
		echo $after_widget;
	}

}