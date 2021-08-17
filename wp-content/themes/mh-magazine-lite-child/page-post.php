<?php /* Template Name: Bài viết */ ?>
<?php
// set up or arguments for our custom query
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$query_args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'order'      => 'DESC',
    'paged' => $paged
);
// create a new instance of WP_Query
$the_query = new WP_Query( $query_args );

$popularpostbyview = array(
    'meta_key'  => 'wpb_post_views_count', // set custom meta key
    'orderby'    => 'meta_value_num',
    'order'      => 'DESC',
    'posts_per_page' => 5
);

// Invoke the query
$prime_posts = new WP_Query( $popularpostbyview );
?>
<?php get_header(); ?>
<div class="mh-wrapper mh-clearfix">
    <div id="main-content" class="mh-content page-post" role="main" itemprop="mainContentOfPage">
        <h3>Bài viết mới nhất</h3>
        <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
            <figure class="mh-loop-thumb">
                <a href="<?php the_permalink(); ?>"><?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('mh-magazine-lite-post');
                    } else {
                        echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="' . esc_html__('No Image', 'mh-magazine-lite') . '" />';
                    } ?>
                </a>
            </figure>
            <div class="mh-loop-content mh-clearfix">
                <header class="mh-loop-header">
                    <h3 class="entry-title mh-loop-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="mh-meta mh-loop-meta">
                        <?php mh_magazine_lite_loop_meta(); ?>
                        <span class="mh-meta-comments"><i class="fa fa-eye"></i>
                            <?php echo wpp_get_views(get_the_ID()); ?>
                        </span>
                    </div>
                </header>
                <div class="mh-loop-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
            <br>
        <?php endwhile; ?>
        <?php endif; ?>
        <h3>Bài viết nhiều tương tác nhất</h3>
        <?php if ( $prime_posts->have_posts() ) : while ( $prime_posts->have_posts() ) : $prime_posts->the_post(); // run the loop ?>
            <figure class="mh-loop-thumb">
                <a href="<?php the_permalink(); ?>"><?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('mh-magazine-lite-post');
                    } else {
                        echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="' . esc_html__('No Image', 'mh-magazine-lite') . '" />';
                    } ?>
                </a>
            </figure>
            <div class="mh-loop-content mh-clearfix">
                <header class="mh-loop-header">
                    <h3 class="entry-title mh-loop-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="mh-meta mh-loop-meta">
                        <?php mh_magazine_lite_loop_meta(); ?>
                        <span class="mh-meta-comments"><i class="fa fa-eye"></i>
                            <?php echo wpp_get_views(get_the_ID()); ?>
                        </span>
                    </div>
                </header>
                <div class="mh-loop-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
            <br>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <?php
        wp_list_categories(['show_count'=> true,]);
    ?>
</div>

<?php get_footer(); ?>
