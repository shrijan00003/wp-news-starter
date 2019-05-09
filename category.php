<?php
/**
* A Simple Category Template
*/
 
get_header(); ?>

<section id="primary" class="site-content row">
    <div id="content" role="main" class="col-md-8 text-justify">

        <?php 
        if ( have_posts() ) : ?>
        <header class="category-header">
            <h1 class="category-title"><?php single_cat_title( '', true ); ?></h1>
        </header>
        <?php
 
        while ( have_posts() ) : the_post(); ?>
        <div class="category-single-news-section bg-light row py-3">
            <div class="col-md-3">
                <div class="category-single-post-thumbnail">
                    <?php if(has_post_thumbnail()): ?>
                    <a class="img-fluid" href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                    <?php else: ?>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title_attribute(); ?>">
                        <img src="<?php echo STNEWSPORTAL_IMAGE_URL.'/default-image.png' ?>" alt="default image">
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="category-single-content-section">
                    <h2>
                        <a href="<?php the_permalink() ?>" rel="bookmark"
                            title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?>
                        </a>
                    </h2>
                    <div><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></div>
                    <div class="entry">
                        <?php the_excerpt(); ?>
                        <p class="postmetadata">
                            <?php
                                comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed');
                                ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <?php endwhile;  ?>
        <div class="pagination-div row">
            <div class="col-md-12 my-3">
                <?php stnewsportal_numeric_posts_nav();  ?>
            </div>
        </div>
        <?php  else: ?>
        <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>
</section>


<?php get_sidebar(); ?>
<?php get_footer(); ?>