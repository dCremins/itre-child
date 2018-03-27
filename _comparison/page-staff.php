<?php
/*
Template Name: Staff Page
*/
require(get_template_directory() .'/includes/layout.php');
get_header(); ?>

<div class='l-header'>
    <div class='container<?php echo $fluid; ?>'>
        <div class='page-lead'>
            <h1 id="top"><?php echo get_the_title() ?></h1>
        </div>
    </div>
</div>

<section role="main" class='l-main'>
    <?php
    $menu = [];
// Member Section Menu

    if (have_rows('staff')) {
        echo '<div class="container" id="automenu-container">';
        echo '<ul class="automenu">';
        while (have_rows('staff')) {
            the_row();
            if (get_row_layout() == 'section' || get_row_layout() == 'link') {
                if (get_sub_field('title')) {
                    echo '<li><a href="#' . get_sub_field('title') . '">';
                    echo get_sub_field('title');
                    echo '</a></li>';
                }
                if (get_sub_field('text')) {
                    echo '<li><a href="'.get_sub_field('url').'">';
                    echo get_sub_field('text');
                    echo '</a></li>';
                }
            }
        }
        echo '</ul>';
        echo '</div>';
    }

    if (have_posts()) :
        while (have_posts()) :
            the_post();
            echo '<article class="blogpost clearfix">';
            the_content();
            echo '</article>';
        endwhile;
    endif;

    if (have_rows('staff')) {
        echo '<div class="container staff-page">';
        while (have_rows('staff')) {
            the_row();
// Section
            if (get_row_layout() == 'section' || get_row_layout() == 'link') {
                echo '<div class="staff-container">';
                echo '<div class="staff-block">';
// Title
                if (get_sub_field('title')) {
                    echo '<h2 id="' . get_sub_field('title') . '"><a href="#top">';
                    the_sub_field('title');
                    echo '</a></h2>';
                }
// Member
                if (have_rows('member')) {
                    while (have_rows('member')) {
                        the_row();
                        echo '<div class="staff-member">';
// Image
                        if (get_sub_field('image')) {
                            $image = get_sub_field('image');
                            echo '<div class="staff-image">';
                            echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
                            echo '</div>';
                        }
                        echo '<div class="staff-text"><p>';
// Name
                        echo '<strong>';
                        if (get_sub_field('file') == 'PDF') {
                            if (get_sub_field('resume')) {
                                $resume = get_sub_field('resume');
                                echo '<a href="' . $resume['url'] . '">';
                                the_sub_field('name');
                                echo '</a>';
                            } else {
                                the_sub_field('name');
                            }
                        } elseif (get_sub_field('file') == 'Link') {
                            if (get_sub_field('link')) {
                                $resume = get_sub_field('link');
                                echo '<a href="' . $resume . '">';
                                the_sub_field('name');
                                echo '</a>';
                            } else {
                                the_sub_field('name');
                            }
                        }

                        echo '</strong><br />';
// Title
                        if (get_sub_field('title')) {
                            echo '<em>';
                            the_sub_field('title');
                            echo '</em><br />';
                        }
//Phone | Email
                        if (get_sub_field('phone')) {
                            the_sub_field('phone');
                            echo ' | ';
                        }
                        if (get_sub_field('email')) {
                            echo '<a href="mailto:' . get_sub_field('email') . '">';
                            the_sub_field('email');
                            echo '</a>';
                        }
                        echo '</p></div>'; //staff text
                        echo '</div>'; //staff member
                    } //End Member While
                } // End Member If
// Link
                if (get_sub_field('text')) {
                    echo '<h2><a href="'.get_sub_field('url').'">';
                    the_sub_field('text');
                    echo '</a></h2>';
                }
                echo '</div>'; // generic block
                echo '</div>'; // content block
            } //End Section If
        } //End Staff While
        echo '</div>';
    } //End Staff If
    ?>
</section>

<?php get_footer(); ?>
