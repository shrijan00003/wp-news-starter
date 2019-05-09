<?php
/**
 * Featured Posts widget
 */

class stnewsportal_featured_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_featured_posts widget_featured_meta',
			'description'                 => __( 'Display latest posts or posts of specific category.', 'stnewsportal' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'ST: Featured Posts (One by four)', 'stnewsportal' ), $widget_ops );
	}

	function form( $instance ) {
		$st_defaults['title']    = '';
		$st_defaults['text']     = '';
		$st_defaults['number']   = 4;
		$st_defaults['type']     = 'latest';
		$st_defaults['category'] = '';
		$st_defaults['sec_thumb'] = '';
		$st_defaults['sec_ex'] = '';
		$instance                = wp_parse_args( ( array ) $instance, $st_defaults );
		$title                   = esc_attr( $instance['title'] );
		$text                    = esc_textarea( $instance['text'] );
		$number                  = $instance['number'];
		$type                    = $instance['type'];
		$category                = $instance['category'];
		$sec_thumb        		 = $instance['sec_thumb'];
		$sec_ex           		 = $instance['sec_ex'];
		?>

<?php //desing preview ?>
<p>
    <?php _e( 'Layout will be as below:', 'stnewsportal' ) ?>
</p>
<div style="text-align: center;">
    <img src="<?php echo get_template_directory_uri() . '/img/style-1.jpg' ?>">
</div>

<?php //taking title ?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'stnewsportal' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"
        type="text" value="<?php echo $title; ?>" />
</p>

<?php //taking description ?>
<?php _e( 'Description', 'stnewsportal' ); ?>
<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>"
    name="<?php echo $this->get_field_name( 'text' ); ?>">
	<?php echo $text; ?>
</textarea>

<?php // number of post to show ?>
<p>
    <label
        for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'stnewsportal' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>"
        type="text" value="<?php echo $number; ?>" size="3" />
</p>

<?php // check box for lastest post or with category ?>
<p>
    <input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
        name="<?php echo $this->get_field_name( 'type' ); ?>"
        value="latest" /><?php _e( 'Show latest Posts', 'stnewsportal' ); ?>
    <br />
    <input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
        name="<?php echo $this->get_field_name( 'type' ); ?>"
        value="category" /><?php _e( 'Show posts from a category', 'stnewsportal' ); ?>
    <br />
</p>

<?php //selecting category ?>
<p>
    <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'stnewsportal' ); ?>
        :</label>
    <?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category,
			) ); ?>
</p>

<p>
    <?php _e( 'More options', 'stnewsportal' ) ?>
</p>
<p>
    <input type="checkbox" <?php checked( $sec_thumb, 'on' ) ?> id="<?php echo $this->get_field_id( 'sec_thumb' ); ?>"
        name="<?php echo $this->get_field_name( 'sec_thumb' ); ?>" /><?php _e( 'Show Thumbnail in secondary posts', 'stnewsportal' ); ?>
    <br />
    <input type="checkbox" <?php checked( $sec_ex, 'on' ) ?> id="<?php echo $this->get_field_id( 'sec_ex' ); ?>"
        name="<?php echo $this->get_field_name( 'sec_ex' ); ?>" /><?php _e( 'Show excerpt in secondary posts', 'stnewsportal' ); ?>
    <br />
</p>

<?php echo $instance['sec_thumb']; echo $instance['sec_ex']; ?>

<?php
	}//end of form

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		}
		$instance['number']   = absint( $new_instance['number'] );
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];
		$instance['sec_thumb'] = $new_instance['sec_thumb'];
		$instance['sec_ex'] = $new_instance['sec_ex'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$text     = isset( $instance['text'] ) ? $instance['text'] : '';
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';
		$sec_thumb = isset( $instance['sec_thumb'] ) ? $instance['sec_thumb'] : '';
		$sec_ex = isset( $instance['sec_ex'] ) ? $instance['sec_ex'] : '';

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'post_status'         => $post_status,
		);

		// Display from category chosen.
		if ( $type == 'category' ) {
			$args['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query( $args );

		echo $before_widget;
		?>
<?php
	
		if ( ! empty( $title ) ) {
			echo '<h3 class="widget-title-style-one"><span>' . esc_html( $title ) . '</span></h3>';
		}
		if ( ! empty( $text ) ) {
			?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
<div class="d-flex clearfix">
    <?php
		$i = 1;
		while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
			?>
    <?php if ( $i == 1 ) {
				$featured = 'stnewsportal-featured-post-medium img-thumbnail';
				$titleClasses = 'stnewsportal-featured-post-big-title';
			} else {
				$featured = 'stnewsportal-featured-post-small img-thumbnail float-left';
				$titleClasses = 'stnewsportal-featured-post-small-title';
			} ?>
    <?php if ( $i == 1 ) {
				echo '<div class="first-post col-md-6 p-2">';
			} elseif ( $i == 2 ) {
				echo '<div class="following-post col-md-6">';
			} ?>
    <div class="single-article  border-bottom <?php if ($i!=1) echo "d-flex my-2"?>">
        <?php
				if ( has_post_thumbnail() ) {
					$image           = '';
					$thumbnail_id    = get_post_thumbnail_id( $post->ID );
					$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
					$title_attribute = get_the_title( $post->ID );
					if ( empty( $image_alt_text ) ) {
						$image_alt_text = $title_attribute;
					}
					$image .= '<figure>';
					$image .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
					$image .= get_the_post_thumbnail( $post->ID, $featured, array(
							'title' => esc_attr( $title_attribute ),
							'alt'   => esc_attr( $image_alt_text ),
						) ) . '</a>';
					$image .= '</figure>';

				}
					if($i==1){
						echo $image;
					}else if($sec_thumb==="on"){
						echo $image;
					}else{
						echo null;
					}
				?>
        <?php if($i!=1) $articleContentClasses="px-3 py-3" ?>
        <div class="article-content <?php echo $articleContentClasses?>">
            <h3 class="entry-title <?php echo $titleClasses ?> ">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php if ( $i == 1 ): ?>
            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>
            <?php endif; ?>
        </div>

    </div>
    <?php if ( $i == 1 ) {
				echo '</div>';
			} ?>
    <?php
			$i ++;
		endwhile;
		if ( $i > 2 ) {
			echo '</div>';
		}
		// Reset Post Data
		wp_reset_query();
		?>
</div>
<!-- </div> -->
<?php
		echo $after_widget;
	}

}