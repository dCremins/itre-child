<?php require(get_template_directory() . '/includes/layout.php'); ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5D95JDX');</script>
<!-- End Google Tag Manager -->

        <title>
            <?php wp_title(' : ', true, 'right');
            bloginfo('name'); ?>
        </title>
        <link rel="shortcut icon" href="https://www.ncsu.edu/favicon.ico" />

<!-- Social Networks Metadata -->
        <meta property="og:type" content="website" />
				<?php
				if (class_exists('acf')){
					if (get_field('social_media_image')) {
						echo '<meta property="og:image"
		              content="' . get_field('social_media_image') . '" />';
					}
				} else if (isset($theme['opt-social-image']['url'])) {
					echo '<meta property="og:image"
								content="' . $theme['opt-social-image']['url'] . '" />';
				}

				echo '<meta name="twitter:card" value="summary" />';

				if (isset($theme['opt-twitter'])) {
					echo '<meta name="twitter:site" value="@' . $theme['opt-twitter'] . '" />';
				}

				if (class_exists('acf')){
					if (get_field('search_engine_description')) {
						echo '<meta name="description"
		              content="' . get_field('search_engine_description') . '" />';
					}

					echo '<meta property="og:url" content="' . get_permalink() . '" />';

					if (get_field('social_media_title')) {
						echo '<meta property="og:title"
		              content="' . get_field('social_media_title') . '" />';
					}

					if (get_field('social_media_description')) {
						echo '<meta property="og:description"
		              content="' . get_field('social_media_description') . '" />';
					}

					echo '<meta property="twitter:url" content="' . get_permalink() . '" />';

					if (get_field('social_media_title')) {
						echo '<meta property="twitter:title"
		              content="' . get_field('social_media_title') . '" />';
					}

					if (get_field('social_media_description')) {
						echo '<meta property="twitter:description"
		              content="' . get_field('social_media_description') . '" />';
					}
				} else {
					if (isset($theme['opt-meta-description'])) {
						echo '<meta name="description"
									content="' . $theme['opt-meta-description'] . '" />';
					}

					if (isset($theme['opt-social-title'])) {
						echo '<meta property="og:title"
									content="' . $theme['opt-social-title'] . '" />';
					}

					if (isset($theme['opt-social-description'])) {
						echo '<meta property="og:description"
									content="' . $theme['opt-social-description'] . '" />';
					}

					if (isset($theme['opt-social-title'])) {
						echo '<meta property="twitter:title"
									content="' . $theme['opt-social-title'] . '" />';
					}

					if (isset($theme['opt-social-description'])) {
						echo '<meta property="twitter:description"
									content="' . $theme['opt-social-description'] . '" />';
					}
				}

				 ?>
        <?php if (empty($theme['opt-sitelogo']['url'])) { ?>
            <style>
/* style to place NC State brick in admin bar */
                .ncstate-utility-bar-home {
                   background-image: url(
									 "https://cdn.ncsu.edu/brand-assets/utility-bar/img/ncstate-brick-2x2-red.jpg"
										);
                    background-repeat: no-repeat;
                    background-size: contain;
                    height: 60px;
                }
                .ncstate-utility-bar-home a {
                    height: 60px;
                    color: transparent !important;
                    background-image: none !important;
                }
                .ncstate-utility-bar-home a:hover {
                    background-color: transparent !important;
                }
                .ncstate-utility-bar-primary-util {
                    padding-top: 30px !important;
                }
            </style>
        <?php }
        wp_head(); ?>
    </head>

    <body <?php echo ($layout=="left" ? 'class="body-fluid"' : ''); ?>>

      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5D95JDX"
height="0" width="0" style="display:none;visibility:hidden" alt="google tag manager script"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

        <div id="ncstate-utility-bar"></div>
        <?php if ($layout=="left") : ?>
            <nav class="left-nav hidden-xs">
                <button type="button" id="leftNav-menu-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-menu"></span>
                </button>
                <?php
                $args = array(
                        'container' => false,
                        'menu_class' => 'nav',
                        'depth' => 0,
                        'title_li' => false,
                        'theme_location' => 'header-menu',
                );
                wp_nav_menu($args); ?>
            </nav>
            <div class="main-content-container">
        <?php endif; ?>
        <header>
            <div class='container<?php echo $fluid; ?>'>
                <?php
                $args = array(
                    'container' => false,
                    'menu_class' => 'utility-nav',
                    'depth' => 1,
                    'title_li' => false,
                    'theme_location' => 'header-utility',
                    'fallback_cb' => null
                );
                wp_nav_menu($args); ?>
            <div class='site-title'>
                <button type="button" id="menu-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-menu"></span>
                </button>
                <a href="<?php echo home_url(); ?>">
                    <?php
                    if (!empty($theme['opt-sitelogo']['url'])) {
                        echo '<img id="logo-brick" src="'
                        . $theme['opt-sitelogo']['url']
                        . '" alt="'
                        . get_bloginfo('name')
                        . '"/>';
                    }
                    if (is_front_page()) {
                        echo "<h1 class='brick-" . $brick . "'>" . get_bloginfo('name') . "</h1>";
                    } else {
                        echo "<h6 class='brick-" . $brick . "'>" . get_bloginfo('name') . "</h6>";
                    } ?>
                </a>
            </div>
            <nav id="global-nav">
                <?php
                $item_wrap = '<ul id="%1$s" class="%2$s"> %3$s
                                  <li class="menu-item search"><a><i class="fa fa-search"></i></a>
                                       <ul class="sub-menu search">
																			     <li>
                                               <form id="search" action="'
                                               . home_url()
                                               . '">search: <input type="text" name="s" id="s"></form>
                                           </li>
                                        </ul>
                                    </li>
                                </ul>';
                $args = array(
                        'container' => false,
                        'menu_class' => 'nav',
                        'title_li' => false,
                        'theme_location' => 'header-menu',
                        'items_wrap' => $item_wrap
                );
                wp_nav_menu($args); ?>
            </nav> <!--#global-nav-->
        </div>
    </header>
