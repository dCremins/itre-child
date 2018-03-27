<?php

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

		<div class='l-header'>
			<div class='container<?php echo $fluid; ?>'>
				<div class='page-lead'>

					<?php
						$first = true;
						$pageNum = 1;
					?>

					<?php if(is_author()): ?>

						<?php if (have_posts()): ?>

						    <?php the_post(); ?>

						    <?php $author = get_the_author_meta('display_name'); ?>
						    <?php $pageNum = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
						    <?php if($pageNum > 1){ $first = false; } ?>
							<h1>Posts From <?php echo $author; ?> <?php if(is_paged() && $first == false){ echo "&mdash; Page " . $pageNum;  }?></h1>

						<?php endif;?>

						<?php rewind_posts(); ?>

					<?php elseif(is_date()): ?>

						<?php
							if ( is_day() ) :
								$title = "Posts From <span>" . get_the_date() . "</span>";
							elseif ( is_month() ) :
								$title = "Posts From <span>" . get_the_date('F Y') . "</span>";
							elseif ( is_year() ) :
								$title = "Posts From <span>" . get_the_date('Y') . "</span>";
							endif;
						?>
						<?php $first = false; ?>
						<?php $pageNum = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
						<h1><?php echo $title; ?>  <?php if(is_paged() && $first == false){ echo "&mdash; Page " . $pageNum;  }?></h1>

					<?php elseif(is_tag()): ?>

						<?php $first = false; ?>

						<?php //if(!is_paged()) : ?>
							<?php $pageNum = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
							<h1>Posts Tagged &lsquo;<?php single_cat_title(); ?>&rsquo; <?php if(is_paged() && $first == false){ echo "&mdash; Page " . $pageNum;  }?></h1>
						<?php //endif; ?>


					<?php elseif(is_search()): ?>


					<h1>Results for: <?php echo esc_attr(get_search_query()); ?></h1>

					<?php else: ?>

						<?php $first = false; ?>

						<?php //if(!is_paged()) : ?>
							<?php $pageNum = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
							<h1><?php single_cat_title(); ?> Posts <?php if(is_paged() && $first == false){ echo "&mdash; Page " . $pageNum;  }?></h1>
						<?php //endif; ?>

					<?php endif; ?>

				</div>
			</div>
		</div>


				<div id="content" role="main">
                	<div class='container<?php echo $fluid; ?>'>
                	<section <?php /*class="blog" */ ?>  class='l-main archive'>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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

<?php /*?>			</div><?php */?>

<?php get_footer(); ?>





<?php /* <h1>Setting up your site and homepage</h1>

<p>To begin setting up your homepage, visit <a href="<?php echo site_url(); ?>/wp-admin">your site's admin panel</a>.</p>

<p>Visit '<a href="<?php echo site_url(); ?>/wp-admin/post-new.php?post_type=page">Pages->Add New</a>' to create a homepage.  On the right-hand side of the screen choose "Home Page" as the template.</p>

<p>Once you have created your "Home Page" you need to tell Wordpress to use that specific page as the site's homepage.  You can do so in '<a href="<?php echo site_url(); ?>/wp-admin/customize.php">Appearances->Customize</a>'.  Under 'Static Front Page' choose the page you just created.</p>
*/?>
