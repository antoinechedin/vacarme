<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vacarme
 */

?>
<!doctype html>
<html <?php language_attributes();
		if (is_home()) : ?> class="fullscreen-page" <?php endif; ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<!-- <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'vacarme'); ?></a> -->

		<header id="masthead" class="site-header">
			<nav id="site-navigation" class="main-navigation navbar <?php if (is_home()) echo 'fixed-top'; ?> navbar-expand-lg navbar-dark bg-dark" role="navigation">
				<div class="container-fluid">
					<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'menu' => 'Main menu',
							'container_class' => 'collapse navbar-collapse',
							'items_wrap' => '<ul id="%1$s" class="%2$s navbar-nav mx-auto">%3$s</ul>',
							'list_item_class' => 'nav-item',
							'link_class' => 'nav-link'
						)
					);
					?>
				</div>
			</nav><!-- #site-navigation -->
			<!-- <div class="site-branding">
				<?php
				the_custom_logo();
				if (is_front_page() && is_home()) :
				?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				else :
				?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				$vacarme_description = get_bloginfo('description', 'display');
				if ($vacarme_description || is_customize_preview()) :
				?>
					<p class="site-description"><?php echo $vacarme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
												?></p>
				<?php endif; ?>
			</div>-->
			<!-- .site-branding -->
		</header><!-- #masthead -->