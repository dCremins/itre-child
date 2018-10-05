<?php

namespace ITRE\Custom;

function theme_enqueue_styles()
{
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/dist/main.css', array($parent_style));

		wp_enqueue_script('poulton', get_template_directory_uri() . '/js/main.js', '', '', true);
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\theme_enqueue_styles');


function ncsu_enqueue_styles()
{
	wp_enqueue_style('ncsu-fonts', 'https://cdn.ncsu.edu/brand-assets/fonts/include.css');
	wp_enqueue_style('ncsu-bootstrap', get_stylesheet_directory_uri() . '/ncsu/bootstrap.css');

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_stylesheet_directory_uri() . '/ncsu/jquery-3.3.1.min.js', '', '3.3.1', true);
	wp_enqueue_script('jquery');
	wp_register_script('menu_toggle', get_stylesheet_directory_uri() . '/dist/bundled.min.js', '', '', true);
	wp_enqueue_script('menu_toggle');
	//wp_enqueue_script('fontawesome', get_stylesheet_directory_uri() . '/ncsu/fontawesome-all.min.js');
	//wp_enqueue_script('ncsu-javascript', get_stylesheet_directory_uri() . '/ncsu/bootstrap.min.js');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\ncsu_enqueue_styles');

/*Function to defer or asynchronously load scripts*/
function js_async_attr($tag, $handle) {
	$scripts_to_exclude = ['acf', 'core'];
	if (is_admin()) {
  	return $tag;
  }
	foreach($scripts_to_exclude as $exclude_script) {
		if (true == strpos($handle, $exclude_script)) {
			return $tag;
		}
	}
	# Defer or async all remaining scripts not excluded above
	return str_replace( ' src', ' defer="defer" src', $tag );
}
add_filter( 'script_loader_tag', __NAMESPACE__ . '\\js_async_attr', 10, 2 );

// custom 'read more' link for MANUAL excerpts
function wpdocs_custom_excerpt_length($length)
{
    return 20;
}

// custom 'read more' link for content
function wpdocs_custom_content_readmore($more_link_text)
{
    return '... Read More <span class="glyphicon glyphicon-right-arrow readmore-link" data-alt="search"></span>';
}

// custom 'read more' link for AUTOMATIC excerpts
function wpdocs_custom_excerpt_readmore($more)
{
  global $post;
	if (is_home()) {
		return;
	} else {
		return '... <a class="readmore-link"> Read More<span class="sr-only"> '.get_the_title($post->ID).'</span><span class="glyphicon glyphicon-thin-arrow" data-alt="search"></span></a>';
	}
}

// custom 'read more' link for MANUAL excerpts
function custom_excerpt($text)
{
  global $post;
	if (is_home()) {
		return;
	} else {
    if (!empty($post->post_excerpt)) {
        $excerpt = '<p>'
        . strip_tags($text)
        . '... <a class="readmore-link" href="'
        . get_permalink($post->ID)
        . '"> Read More<span class="sr-only"> '.get_the_title($post->ID).'</span><span class="glyphicon glyphicon-thin-arrow" data-alt="search"></span></a></p>';
        return $excerpt;
    } else {
        return $text;
    }
	}
}

// custom 'read more' link for MANUAL excerpts
add_filter('the_excerpt', __NAMESPACE__ . '\\custom_excerpt');

// custom excerpt length
add_filter('excerpt_length', __NAMESPACE__ . '\\wpdocs_custom_excerpt_length', 999);

// custom 'read more' link for content
add_filter('the_content_more_link', __NAMESPACE__ . '\\wpdocs_custom_content_readmore');

// custom 'read more' link for AUTOMATIC excerpts
add_filter('excerpt_more', __NAMESPACE__ . '\\wpdocs_custom_excerpt_readmore');

function childtheme_remove_filters() {
// remove filters from parent theme
	remove_filter('excerpt_length', 'custom_excerpt_length', 999);
	remove_filter('excerpt_more', 'new_excerpt_more');
}

add_action('after_setup_theme', __NAMESPACE__ . '\\childtheme_remove_filters');


// fix tinyMCE messing with empty elements
function override_mce_options($initArray)
{
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}

add_filter('tiny_mce_before_init', __NAMESPACE__ . '\\override_mce_options');
