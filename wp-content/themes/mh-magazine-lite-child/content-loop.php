<?php /* Loop Template used for index/archive/search */ ?>
<article <?php post_class('mh-loop-item mh-clearfix'); ?>>
	<figure class="mh-loop-thumb">
		<a href="<?php the_permalink(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-magazine-lite-medium');
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
            <p class="loop-tag"><?php the_tags('<b>Tags:</b> ', ', ' ); ?></p>
		</div>
	</div>
</article>