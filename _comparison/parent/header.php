<?php
	require 'includes/layout.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title(' : ', true, 'right'); bloginfo('name'); ?></title>
		<link rel="shortcut icon" href="https://www.ncsu.edu/favicon.ico" />

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css" />
		<!-- appears to be an empty file, remove? -->
		<!--<link rel="stylesheet" type="text/css" href="//cdn.ncsu.edu/brand-assets/wordpress-themes/lite/1.1.0/style.css" />-->

		<!-- picture element polyfill -->
		<script>
			// Picture element HTML5 shiv
			document.createElement( "picture" );
		</script>
		<script src="<?php bloginfo('template_url'); ?>/js/picturefill.min.js" async></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->

		<!-- Social Networks Metadata -->
		<meta property="og:type" content="website" /><?php
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

		<?php
		if( empty($theme['opt-sitelogo']['url']) ) { ?>
			<style>
			/* style to place NC State brick in admin bar */

			.ncstate-utility-bar-home {
			  background-image: url("https://cdn.ncsu.edu/brand-assets/utility-bar/img/ncstate-brick-2x2-red.jpg");
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

		wp_head();
		?>
	</head>

	<body <?php echo ($layout=="left" ? 'class="body-fluid"' : ''); ?>>

		<div id="ncstate-utility-bar"></div>

		<?php if($layout=="left") : ?>
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

					wp_nav_menu($args);
				?>

				</nav>

				<div class="main-content-container">
		<?php endif; ?>

		<header>
			<div class='container-header container<?php echo $fluid; ?>'>

	                <?php
	                $args = array(
	                    'container' => false,
	                    'menu_class' => 'utility-nav',
	                    'depth' => 1,
	                    'title_li' => false,
	                    'theme_location' => 'header-utility',
	                    'fallback_cb' => null
	                );

	                wp_nav_menu($args);

	                ?>

					<!-- Return-to-parent link -->
					 <?php
						if( !empty($theme['opt-parentname']) ) {
							echo '<a class="parent-link" href="' . $theme['opt-parenturl'] . '" >' . $theme['opt-parentname'] .'<span class="glyphicon glyphicon-thin-arrow"></span></a>';
						}
	                ?>
					<!-- End parent link -->
					<section class="header-primary-content">
					<div class='site-title'>
						<button type="button" id="menu-toggle">
					       <span class="sr-only">Toggle navigation</span>
					       <span class="glyphicon glyphicon-menu"></span>
					    </button>

					    <a href="<?php echo home_url(); ?>">
							<?php /*<img src='<?php bloginfo('template_directory'); ?>/img/ncstate-brick-<?php echo $brick; ?>-red.png' alt="NC State"/>*/?>
							<?php /*<img src='<?php bloginfo('template_directory'); ?>/img/wrri.png' alt="Water Resources Research Institute (WRRI)"/> */?>
	                        <?php
								if( !empty($theme['opt-sitelogo']['url']) ) {
									echo '<img id="logo-brick" src="' . $theme['opt-sitelogo']['url'] . '" alt="' . get_bloginfo('name') . '"/>';
									/* removed when brick relocated to admin bar */
								/*} else {
									echo '<img id="logo-brick" src="' . get_bloginfo('template_directory') . '/img/ncstate-brick-' . $brick . '-red.png" alt="NC State"/>';
								*/
								}
	                        ?>

							<?php
								/* Page titles always h1 */
								echo "<h1 class='brick-" . $brick . "'>" . get_bloginfo('name') . "</h1>";

							?>
						</a>
					</div>

					<nav id="global-nav">

						<?php
						$item_wrap = '<ul id="%1$s" class="%2$s">%3$s
						<li class="menu-item search"><a><i class="fa fa-search"></i></a>
							<ul class="sub-menu search"><li>
								<form id="search" action="' . home_url() . '">search: <input type="text" name="s" id="s"></form>
							</li></ul>
						</li></ul>';


							$args = array(
								'container' => false,
								'menu_class' => 'nav',
								'title_li' => false,
								'theme_location' => 'header-menu',
								'items_wrap' => $item_wrap
								);

							wp_nav_menu($args);
						?>

					</nav> <!--#global-nav-->
				</section> <!-- .header-primary-content -->

				<?php if ($theme['opt-switch']) { /* check if campaign sticker is enabled */ ?>
				<section class="campaign-sticker">
						<a href=<?php echo '"' . $theme['opt-sticker-url'] . '"'; ?> id="campaign-sticker-full"> <!-- Full Sticker (Desktop view) -->
				            <svg xmlns="http://www.w3.org/2000/svg" width="175" height="38.13" viewBox="0 0 407.98 88.9"><defs><style>.a{fill:#c00;}</style></defs><title>Think and Do The Extraordinary</title><polygon class="a" points="111.43 38.77 114.5 38.77 114.5 17.38 120.83 17.38 120.83 14.71 105.1 14.71 105.1 17.38 111.43 17.38 111.43 38.77"/><polygon class="a" points="127.88 27.77 136.31 27.77 136.31 38.77 139.38 38.77 139.38 14.71 136.31 14.71 136.31 25.11 127.88 25.11 127.88 14.71 124.82 14.71 124.82 38.77 127.88 38.77 127.88 27.77"/><rect class="a" x="144.88" y="14.71" width="3.07" height="24.06"/><polygon class="a" points="156.12 17.91 156.19 17.91 165.68 38.77 169.88 38.77 169.88 14.71 167.15 14.71 167.15 35.31 167.08 35.31 157.72 14.71 153.39 14.71 153.39 38.77 156.12 38.77 156.12 17.91"/><polygon class="a" points="178.26 26.21 178.36 26.21 186.79 38.77 190.73 38.77 181.5 25.58 190.23 14.71 186.76 14.71 178.36 25.28 178.26 25.28 178.26 14.71 175.2 14.71 175.2 38.77 178.26 38.77 178.26 26.21"/><path class="a" d="M203.83,33h9.3l1.73,5.73h3.43l-7.83-24.06h-3.9l-7.63,24.06H202Zm4.53-15.49h.07l3.86,12.83h-7.7Z"/><polygon class="a" points="225.03 17.91 225.1 17.91 234.59 38.77 238.79 38.77 238.79 14.71 236.06 14.71 236.06 35.31 235.99 35.31 226.63 14.71 222.3 14.71 222.3 38.77 225.03 38.77 225.03 17.91"/><path class="a" d="M257.6,35.67c1-1.6,1.47-4.56,1.47-9.7,0-.77-.1-5.56-1.07-7.6-1.2-2.56-3.4-3.67-6.46-3.67h-7.4V38.77h5.53C253.87,38.77,256.3,37.74,257.6,35.67ZM247.21,17.38h4c3.2,0,4.7,1.8,4.7,6.66v4.87c0,5.6-1.57,7.2-5.83,7.2h-2.9Z"/><path class="a" d="M285.36,35.67c1-1.6,1.47-4.56,1.47-9.7,0-.77-.1-5.56-1.07-7.6-1.2-2.56-3.4-3.67-6.46-3.67h-7.4V38.77h5.53C281.63,38.77,284.06,37.74,285.36,35.67ZM275,17.38h4c3.2,0,4.7,1.8,4.7,6.66v4.87c0,5.6-1.57,7.2-5.83,7.2H275Z"/><path class="a" d="M298.3,39.27c5.1,0,7.56-2.63,7.56-9.3v-7.9c0-4.8-2.47-7.86-7.56-7.86s-7.56,3.06-7.56,7.86V30C290.74,36.64,293.2,39.27,298.3,39.27ZM293.87,22c0-5,3.47-5.2,4.43-5.2s4.43.17,4.43,5.2v8.13c0,5.27-1.53,6.6-4.43,6.6s-4.43-1.33-4.43-6.6Z"/><polygon class="a" points="120.83 52.7 105.1 52.7 105.1 55.37 111.43 55.37 111.43 76.76 114.5 76.76 114.5 55.37 120.83 55.37 120.83 52.7"/><polygon class="a" points="127.88 65.76 136.31 65.76 136.31 76.76 139.38 76.76 139.38 52.7 136.31 52.7 136.31 63.1 127.88 63.1 127.88 52.7 124.82 52.7 124.82 76.76 127.88 76.76 127.88 65.76"/><polygon class="a" points="157.29 74.09 147.76 74.09 147.76 65.76 156.43 65.76 156.43 63.1 147.76 63.1 147.76 55.37 157.09 55.37 157.09 52.7 144.7 52.7 144.7 76.76 157.29 76.76 157.29 74.09"/><polygon class="a" points="171.82 65.76 180.49 65.76 180.49 63.1 171.82 63.1 171.82 55.37 181.15 55.37 181.15 52.7 168.76 52.7 168.76 76.76 181.35 76.76 181.35 74.09 171.82 74.09 171.82 65.76"/><polygon class="a" points="195.21 64.3 201.67 52.7 198.31 52.7 193.31 62.03 188.38 52.7 184.85 52.7 191.41 64.3 184.48 76.76 187.81 76.76 193.11 66.46 198.71 76.76 202.41 76.76 195.21 64.3"/><polygon class="a" points="220.55 52.7 204.82 52.7 204.82 55.37 211.15 55.37 211.15 76.76 214.22 76.76 214.22 55.37 220.55 55.37 220.55 52.7"/><path class="a" d="M238,70.46c-.17-4.83-1.17-5.76-3.93-6.2V64.2a5.19,5.19,0,0,0,4.4-5.5c0-3-1.5-6-5.76-6h-8.3V76.76h3.07V65.7h3.6c1,0,3.4.13,3.63,3.07.27,3.2.07,6.33.93,8h3.2A36.44,36.44,0,0,1,238,70.46ZM232.07,63h-4.6V55.37h4.63c2.37,0,3.23,1.93,3.23,3.66C235.34,61.13,234.27,63,232.07,63Z"/><path class="a" d="M249.79,52.7l-7.63,24.06h3.1L247,71h9.3L258,76.73h3.43l-7.78-24Zm-2,15.66,3.77-12.83h.07l3.86,12.83Z"/><path class="a" d="M271.77,52.2c-5.1,0-7.56,3.07-7.56,7.86V68c0,6.66,2.47,9.3,7.56,9.3s7.56-2.63,7.56-9.3V60.1C279.34,55.27,276.87,52.2,271.77,52.2Zm4.44,15.9c0,5.27-1.53,6.6-4.43,6.6s-4.43-1.33-4.43-6.6V60c0-5,3.47-5.2,4.43-5.2s4.43.17,4.43,5.2Z"/><path class="a" d="M298.81,76.76a36.45,36.45,0,0,1-.83-6.3c-.17-4.83-1.17-5.76-3.93-6.2V64.2a5.19,5.19,0,0,0,4.4-5.5c0-3-1.5-6-5.76-6h-8.3V76.76h3.06V65.7H291c1,0,3.4.13,3.63,3.07.27,3.2.07,6.33.93,8ZM292,63h-4.6V55.37H292c2.37,0,3.23,1.93,3.23,3.66C295.32,61.13,294.25,63,292,63Z"/><path class="a" d="M303.22,76.76h5.53c4.2,0,6.63-1,7.93-3.1,1-1.6,1.47-4.56,1.47-9.7,0-.77-.1-5.56-1.07-7.6-1.2-2.56-3.4-3.67-6.46-3.67h-7.4Zm3.07-21.39h4c3.2,0,4.7,1.8,4.7,6.66V66.9c0,5.6-1.57,7.2-5.83,7.2h-2.9Z"/><rect class="a" x="323" y="52.7" width="3.07" height="24.06"/><polygon class="a" points="345.27 73.3 345.21 73.3 335.84 52.7 331.51 52.7 331.51 76.76 334.25 76.76 334.25 55.9 334.31 55.9 343.81 76.76 348.01 76.76 348.01 52.7 345.27 52.7 345.27 73.3"/><path class="a" d="M359.65,52.7,352,76.76h3.1l1.8-5.73h9.3l1.73,5.73h3.43L363.55,52.7Zm-2,15.66,3.77-12.83h.07l3.87,12.83Z"/><path class="a" d="M384.94,64.26V64.2a5.19,5.19,0,0,0,4.4-5.5c0-3-1.5-6-5.76-6h-8.3V76.76h3.06V65.7h3.6c1,0,3.4.13,3.63,3.07.27,3.2.07,6.33.93,8h3.2a36.46,36.46,0,0,1-.83-6.3C388.7,65.63,387.71,64.7,384.94,64.26Zm-2-1.23h-4.6V55.37H383c2.37,0,3.23,1.93,3.23,3.66,0,2.1-1.1,4-3.3,4Z"/><polygon class="a" points="404.88 52.7 400.02 64.33 395.32 52.7 391.89 52.7 398.35 67.6 398.35 76.76 401.42 76.76 401.42 67.6 407.98 52.7 404.88 52.7"/><path class="a" d="M44.46,0A44.45,44.45,0,1,0,88.9,44.46v0A44.45,44.45,0,0,0,44.46,0ZM71,35,67.2,46.82l-5.92,6.79L58,68.19l.53,2L60,69.55l1.73.79v2.47H56.11l-1.65-5.93,1.15-.6.16-10.43L39.89,53.43l-3.6,5.67L29,64.61l1,5.58L32,69l2.35,1.35V72.8H27.21L25,63.09l1.59-.82L29.85,58l-2.4-4.22L25.32,59.2l-5.13,3.4-6.29-.13L9.6,57.92l8.06-2.32,6.13-9,2.69-1.63,2.68-4.25,5.63-2,15.73-.75,5.59-3.83L58,30.78l-1.2-.12a.83.83,0,0,1-.46-1.44h0l3.77-2.93,3-3.66,2.12.23,4-4,1.23,2.9L70.25,24l.93-.89.5,1.18-1.8,5.39Z"/></svg>
				            <div class="campaign-sticker-text"><?php echo $theme['opt-sticker-text']; ?><span class="glyphicon glyphicon-roman-arrow" aria-hidden="true"></span></div>
				        </a>
				        <a href=<?php echo '"' . $theme['opt-sticker-url'] . '"'; ?> id="campaign-sticker-small"><!-- Small Sticker (Mobile view) -->
				            <svg xmlns="http://www.w3.org/2000/svg" height="38" width="38" viewBox="0 0 88.9 88.9"><defs><style>.a{fill:#c00;}</style></defs><title>Think and Do The Extraordinary</title><path class="a" d="M44.46,0A44.45,44.45,0,1,0,88.9,44.46v0A44.45,44.45,0,0,0,44.46,0ZM71,35,67.2,46.82l-5.92,6.79L58,68.19l.53,2L60,69.55l1.73.79v2.47H56.11l-1.65-5.93,1.15-.6.16-10.43L39.89,53.43l-3.6,5.67L29,64.61l1,5.58L32,69l2.35,1.35V72.8H27.21L25,63.09l1.59-.82L29.85,58l-2.4-4.22L25.32,59.2l-5.13,3.4-6.29-.13L9.6,57.92l8.06-2.32,6.13-9,2.69-1.63,2.68-4.25,5.63-2,15.73-.75,5.59-3.83L58,30.78l-1.2-.12a.83.83,0,0,1-.46-1.44h0l3.77-2.93,3-3.66,2.12.23,4-4,1.23,2.9L70.25,24l.93-.89.5,1.18-1.8,5.39Z"/></svg>
				            <div class="campaign-sticker-text"><?php echo $theme['opt-sticker-text']; ?><span class="glyphicon glyphicon-roman-arrow" aria-hidden="true"></span></div>
				        </a>
				     </section>
			        <?php } ?>
			</div>
		</header>
