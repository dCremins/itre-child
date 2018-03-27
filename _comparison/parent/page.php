<?php

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
			
				<section role="main" class='l-main'>
			
                
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

							     // loop through the rows of ACF data

/*	August 2015: this functionality was removed from simple pages to make it easier for people
	that are migrating to the theme. Extended fields all moved to page-extended.php */

							    /*while ( have_rows('extended_content',$post->ID) ) : the_row();
								
									if( get_row_layout() == 'basic' ):
										include 'modules/extended_basic.php'; 
									elseif( get_row_layout() == 'banner' ):
										include 'modules/extended_banner.php'; 
									elseif( get_row_layout() == 'page_title' ):
										include 'modules/extended_title.php';
									elseif( get_row_layout() == 'automenu' ):
										include 'modules/extended_automenu.php';
									endif;
								endwhile;*/
								
								
								
								// commented out 4/10/2015 by Scott Reston - implementing new content fields
								//while ( have_rows('page_content') ) : the_row();
//							 
//							        if( get_row_layout() == 'body_copy' ):
//							        	echo get_sub_field('text');
//							        elseif ( get_row_layout() == 'cross-section_content'): 
//							        	include 'modules/cross_section.php'; 
//											endif;
//							 
//							    endwhile;
							else :
								//No content
							endif;	 
					?>
				</section>
				
		<!-- container div -->
		</div>

<?php get_footer(); ?>