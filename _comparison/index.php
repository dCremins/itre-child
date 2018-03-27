<?php

require(get_template_directory() .'/includes/layout.php');

function page_navi()
{
    global $wp_query;
    $bignum = 999999999;
    if ($wp_query->max_num_pages <= 1)
    return;

    echo '<nav class="pagination">';

    echo paginate_links(array(
        'base'        => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
        'format'      => '',
        'current'     => max(1, get_query_var('paged')),
        'total'       => $wp_query->max_num_pages,
        'prev_text'   => '&larr;',
        'next_text'   => '&rarr;',
        'type'        => 'list',
        'end_size'    => 3,
        'mid_size'    => 3
    ));
    echo '</nav>';
} /* end page navi */

get_header(); ?>

<div class='l-header'>
    <div class='container<?php echo $fluid; ?>'>
        <div class='page-lead'>
            <h1><?php echo get_the_title() ?></h1>
        </div>
    </div>
</div>


<div class='container newsPage<?php echo $fluid; ?>'>
<!-- index -->
    <section role="main" class='l-main archive'>
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post(); ?>
            <article class="blogpost clearfix">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="meta">
                    <p><?php echo get_the_date('F j, Y');?></p>
                </div>
                <p>
                    <?php the_excerpt(); ?>
                </p>
            </article>
        <?php
        endwhile;
        page_navi();
    endif;
    ?>
    </section>
    <?php get_sidebar('postlist');?>
<!-- container div -->
</div>

<?php get_footer(); ?>
