<?php

/*
Template Name: Sidebar Content Page
*/

require 'includes/layout.php';
get_header(); ?>

<?php if ( has_post_thumbnail() ): ?>

			<div class="extended-banner default-template">
				<?php the_post_thumbnail( 'banner-lg-desktop' ); ?>
			</div>

<?php endif; ?>

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

            <?php if(get_field('automenu')){ include 'modules/extended_automenu.php'; } /* else { echo '<!-- nope -->'; } */ ?>





		<div class='container<?php echo $fluid; ?>'>
			<?php if ( is_active_sidebar( 'page_sidebar' ) ) { ?>
				<section role="main" class='l-main archive'>
			<?php } else { ?>
				<section role="main" class='l-main'>
			<?php } ?>

					<?php


							//if ( have_rows('page_content') || have_posts() ):
							if ( /*have_rows('extended_content') ||*/ have_posts() ):
							    // get WP content
							    while ( have_posts() ) : the_post();
									$content = get_the_content();
									if(!empty( $content ) ) {
											the_content();
									}
							    endwhile;

							    
							else :
								//No content
							endif;
					?>
				</section>
				<?php if ( is_active_sidebar( 'page_sidebar' ) ):
					get_sidebar('page');
				endif; ?>

		<!-- container div -->
		</div>

<?php get_footer(); ?>
