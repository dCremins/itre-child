<?php
require(get_template_directory() .'/includes/layout.php');

function page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
		return;

	echo '<nav class="pagination">';

		echo paginate_links( array(
			'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) );

	echo '</nav>';
} /* end page navi */


get_header(); ?>

		<div class='l-header'>
			<div class='container<?php echo $fluid; ?>'>
				<div class='page-lead'>

					<?php
						$first = true;
						$pageNum = 1;
					?>
					<h1>Results for: <?php echo esc_attr(get_search_query()); ?></h1>
				</div>
			</div>
		</div>


				<div id="content" role="main">
                	<div class='container<?php echo $fluid; ?>'>
                	<section class='l-main archive'>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<div class="blog-post clearfix">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<div class="meta">
                                    <p>
                                    <?php
		                	echo get_the_date('F j, Y','','', FALSE);
		                	echo ' | ';
		                	the_category( ', ' );;
		                	?>
		                    </p>
                                    </div>

									<?php

									$theme = get_option('ncstate_theme');

									$excerpt = get_the_excerpt();

									if (!$theme['opt-continue-reading'] && substr($excerpt, -34) != 'aria-hidden="true"></span></a></p>') {
			              $excerpt .= '...' . '<p><a href="'. get_permalink($post) .'">Continue reading "'. get_the_title($post) .'"<span class="glyphicon glyphicon-thin-arrow" aria-hidden="true"></span></a></p>';
			            }

									echo $excerpt;


									?>




								</div> <!-- / post -->

							<?php endwhile; ?>

									<?php page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


                    </section>

                    <?php get_sidebar('postlist'); ?>

                   	</div>
				</div>


<?php get_footer(); ?>
