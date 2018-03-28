<?php

require(get_template_directory() .'/includes/layout.php');
get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post(); ?>
    <div class='container<?php echo $fluid; ?>'>
        <header class='l-header has-date page-lead'>
            <h1><?php echo get_the_title() ?></h1>
        </header>
        <section class='l-main post'>
            <?php
						if(class_exists('acf')) {
							if (get_field('video_id')) { ?>
                <div class="featured-video">
                    <iframe width="960" height="720"
                            src="<?php echo '//www.youtube.com/embed/' . get_field('video_id') . ''; ?>"
                            frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            <?php } elseif (has_post_thumbnail()) { ?>
                <picture>
                    <?php
										echo the_post_thumbnail(get_post_thumbnail_id($post->ID), 'featured-desktop', array( 'class' => 'img-responsive' ));
										?>
                    <p class="wp-caption-text"><?php echo get_post(get_post_thumbnail_id())->post_content; ?></p>
                </picture>
            <?php }
						} elseif (has_post_thumbnail()) { ?>
                <picture>
                    <?php
										echo the_post_thumbnail(get_post_thumbnail_id($post->ID), 'featured-desktop', array( 'class' => 'img-responsive' ));
										?>
                    <p class="wp-caption-text"><?php echo get_post(get_post_thumbnail_id())->post_content; ?></p>
                </picture>
            <?php }; ?>
            <div class="meta">
                <p>
                    <?php echo get_the_date('F j, Y');?>
                </p>
            </div>
            <?php the_content(); ?>
        </section>
        <?php get_sidebar(); ?>
    </div>
<!-- Related Posts -->
    <?php
    $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
      $tag_ids = array();
      foreach ($tags as $individual_tag) {
          $tag_ids[] = $individual_tag->term_id;
      }
      $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=> 3, // Number of related posts to display.
        'ignore_sticky_posts'=> 1
      );
      $my_query = new wp_query($args);
    	if ((! $my_query==null) && ($my_query->have_posts())) { ?>
        <section class='related-stories blue-bg'>
          <div class='container<?php echo $fluid; ?>'>
            <h3>RELATED STORIES</h3>
            <?php
            while ($my_query->have_posts()) {
              $my_query->the_post();
              ?>
              <div class='rs-story'>
              	<div class='rs-wrapper'>
                	<h4><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></h4>
                  <?php the_excerpt(); ?>
                </div>
							</div>
            <?php }
            $post = $orig_post;
            wp_reset_query();
            ?>
          </div>
        </section>
    	<?php }
			}
    };
}; ?>

<?php get_footer(); ?>
