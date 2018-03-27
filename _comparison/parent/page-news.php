<?php
/*
Template Name: News/Blog
*/
require 'includes/layout.php';


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


			<?php if ( ! get_field('hide_title') ): ?>
			<div class='l-header'>
				<div class='container<?php echo $fluid; ?>'>
					<div class='page-lead'>
						<h1><?php echo get_the_title() ?></h1>
						<?php
							$ancestors = get_post_ancestors(get_the_ID());
							$parent_post = get_post(end($ancestors));

							if(get_field('section_description')) {
								echo "<p>" . get_field('section_description') . "</p>";
							}
						?>
					</div>
				</div>
			</div>
            <?php endif; ?>


				<div id="content" role="main">

                    <?php
                    /* use extended content stuff */
					/* memo to self - I should figure out how to do this with template_part */


							    while ( have_posts() ) : the_post();
									$content = get_the_content();
									if(!empty( $content ) ) {
										echo '<div class="container' . $fluid .'"><div class="mod-generic">';
											the_content();
										echo '</div></div>';
									}
							    endwhile;



							if ( have_rows('extended_content') || have_posts() ):



							     // loop through the rows of ACF data

							    while ( have_rows('extended_content',$post->ID) ) : the_row();

									if( get_row_layout() == 'basic' ):
										include 'modules/extended_basic.php';
									elseif( get_row_layout() == 'banner' ):
										include 'modules/extended_banner.php';
									elseif( get_row_layout() == 'page_title' ):
										include 'modules/extended_title.php';
									elseif( get_row_layout() == 'automenu' ):
										include 'modules/extended_automenu.php';
									endif;
								endwhile;


							else :
								//No content
							endif;
				?>



				<div class='container<?php echo $fluid; ?>'>

                	<section <?php /*class="blog" */ ?>  class='l-main archive'>

					<?php


						/* default WP query */
						query_posts('post_type=post&post_status=publish&paged='. get_query_var('paged'));

							if (have_posts()) : while (have_posts()) : the_post(); ?>

									<div class="blog-post clearfix">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<div class="meta">
                                    						<p>
						                                    	<?php
								                	echo get_the_date('F j, Y','','', FALSE);
								                	echo ' | ';
								                	echo '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) .'">';
								                	the_author();
								                	echo '</a>';
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
