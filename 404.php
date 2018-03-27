<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<div class='l-header'>
    <div class='container'>
        <div class='page-lead'>
            <h1>Not Found</h1>
        </div>
    </div>
</div>

<div class='container'>
    <section class="l-main post">
        <p>Oops! It looks like nothing was found at this location.</p>
				<h4>Were you looking for:</h4>
				<ul>
				    <li><a href="<?php bloginfo('url'); ?>/training/">A Course or Workshop?</a></li>
					  <li><a href="<?php bloginfo('url'); ?>/technical-services/">A Download or Resource?</a></li>
					  <li><a href="<?php bloginfo('url'); ?>/research/">A Paper or Report?</a></li>
					  <li><a href="<?php bloginfo('url'); ?>/focus/">An ITRE Group?</a></li>
				</ul>
				<h4>None of those? Maybe try a search.</h4>
				<br/>
				<div class="404Search"><?php get_search_form(); ?></div>
				<br/>
				<br/>
				<br/>
    </section><!-- .l-main -->
</div><!-- #container -->

<?php
get_footer();
