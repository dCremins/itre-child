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

		<div id="content" role="main">
                	<div class='container<?php echo $fluid; ?>'>
                	<section class='l-main archive search archive-search' >

					<?php if (have_posts()) { ?>
							<h1>Results for: <?php echo esc_attr(get_search_query()); ?></h1>
							<?php the_widget( 'WP_Widget_Search' ); ?>
						<? while (have_posts()) : the_post(); ?>

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

									<?php the_excerpt(); ?>




								</div> <!-- / post -->

							<?php endwhile; ?>

									<?php page_navi(); ?>

							<?php } else { ?>
									<h1>Your search for "<?php echo esc_attr(get_search_query()); ?>" did not return any results, please try again.</h1>
									<?php the_widget( 'WP_Widget_Search' ); ?>

							<?php } ?>


                    </section>

										<?php if ( is_active_sidebar( 'page_sidebar' ) ):
											get_sidebar('page');
										endif; ?>

                   	</div>
				</div>

<?php /*?>			</div><?php */?>

<?php get_footer(); ?>





<?php /* <h1>Setting up your site and homepage</h1>

<p>To begin setting up your homepage, visit <a href="<?php echo site_url(); ?>/wp-admin">your site's admin panel</a>.</p>

<p>Visit '<a href="<?php echo site_url(); ?>/wp-admin/post-new.php?post_type=page">Pages->Add New</a>' to create a homepage.  On the right-hand side of the screen choose "Home Page" as the template.</p>

<p>Once you have created your "Home Page" you need to tell Wordpress to use that specific page as the site's homepage.  You can do so in '<a href="<?php echo site_url(); ?>/wp-admin/customize.php">Appearances->Customize</a>'.  Under 'Static Front Page' choose the page you just created.</p>
*/?>
