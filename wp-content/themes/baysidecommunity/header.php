<?php
/**
 * Header file for the Bayside Community WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bayside_Church
 * @since Bayside Community 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/favicon/apple-touch-icon-57x57.png" />

		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png" />

		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png" />

		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/favicon/apple-touch-icon-144x144.png" />

		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="/img/favicon/apple-touch-icon-60x60.png" />

		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/favicon/apple-touch-icon-120x120.png" />

		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="/img/favicon/apple-touch-icon-76x76.png" />

		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/favicon/apple-touch-icon-152x152.png" />

		<link rel="icon" type="image/png" href="/img/favicon/favicon-196x196.png" sizes="196x196" />

		<link rel="icon" type="image/png" href="/img/favicon/favicon-96x96.png" sizes="96x96" />

		<link rel="icon" type="image/png" href="/img/favicon/favicon-32x32.png" sizes="32x32" />

		<link rel="icon" type="image/png" href="/img/favicon/favicon-16x16.png" sizes="16x16" />

		<link rel="icon" type="image/png" href="/img/favicon/favicon-128.png" sizes="128x128" />

		<meta name="application-name" content="&nbsp;"/>

		<meta name="msapplication-TileColor" content="#FFFFFF" />

		<meta name="msapplication-TileImage" content="mstile-144x144.png" />

		<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />

		<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />

		<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />

		<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>
		<div class="container">
			
			<header uk-sticky="offset: 0" id="site-header" class="header-footer-group" role="banner">

				<div class="grid-container">

					<div class="header-inner">

						<div class="header-titles-wrapper">

							<?php

							// Check whether the header search is activated in the customizer.
							$enable_header_search = get_theme_mod( 'enable_header_search', true );
							$enable_header_search = false;

							if ( true === $enable_header_search ) {

								?>

								<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<span class="toggle-icon">
											<?php baysidecommunity_the_theme_svg( 'search' ); ?>
										</span>
										<span class="toggle-text"><?php _e( 'Search', 'baysidecommunity' ); ?></span>
									</span>
								</button><!-- .search-toggle -->

							<?php } ?>

							<div class="header-titles">

								<div class="site-title faux-heading"><a href="/"><img src="<?php echo get_site_url(); ?>/img/logo.svg" /></a></div>

							</div><!-- .header-titles -->

							<div class="header-navigation-wrapper uk-visible@l">

							

							<?php
							if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
								?>

									<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'baysidecommunity' ); ?>" role="navigation">

										<ul class="primary-menu reset-list-style">

										<?php
										if ( has_nav_menu( 'primary' ) ) {

											wp_nav_menu(
												array(
													'container'  => '',
													'items_wrap' => '%3$s',
													'theme_location' => 'primary',
												)
											);

										} elseif ( ! has_nav_menu( 'expanded' ) ) {

											wp_list_pages(
												array(
													'match_menu_classes' => true,
													'show_sub_menu_icons' => true,
													'title_li' => false,
													'walker'   => new BaysideCommunity_Walker_Page(),
												)
											);

										}
										?>

										</ul>

									</nav><!-- .primary-menu-wrapper -->

								<?php
							}

							if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
								?>

								<div class="header-toggles hide-no-js">

								<?php
								if ( has_nav_menu( 'expanded' ) ) {
									?>

									<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

										<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
											<span class="toggle-inner">
												<span class="toggle-text"><?php _e( 'Menu', 'baysidecommunity' ); ?></span>
												<span class="toggle-icon">
													<?php baysidecommunity_the_theme_svg( 'ellipsis' ); ?>
												</span>
											</span>
										</button><!-- .nav-toggle -->

									</div><!-- .nav-toggle-wrapper -->

									<?php
								}

								if ( true === $enable_header_search ) {
									?>

									<div class="toggle-wrapper search-toggle-wrapper">

										<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
											<span class="toggle-inner">
												<?php baysidecommunity_the_theme_svg( 'search' ); ?>
												<span class="toggle-text"><?php _e( 'Search', 'baysidecommunity' ); ?></span>
											</span>
										</button><!-- .search-toggle -->

									</div>

									<?php
								}
								?>

								</div><!-- .header-toggles -->
								<?php
							}
							?>

							</div><!-- .header-navigation-wrapper -->


							<button class="uk-hidden@l toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<?php baysidecommunity_the_theme_svg( 'ellipsis' ); ?>
									</span>
									<span class="toggle-text"><?php _e( 'Menu', 'baysidecommunity' ); ?></span>
								</span>
							</button><!-- .nav-toggle -->

						</div><!-- .header-titles-wrapper -->

						

					</div><!-- .header-inner -->

					<?php
					// Output the search modal (if it is activated in the customizer).
					if ( true === $enable_header_search ) {
						get_template_part( 'template-parts/modal-search' );
					}
					?>
				</div><!-- .grid-container -->
			</header><!-- #site-header -->

		</div><!-- .container -->
		<?php
		if ( !is_front_page() && function_exists('yoast_breadcrumb') ) {
		  yoast_breadcrumb( '<div class="breadcrumbs-outer container"><div class="grid-container"><div id="breadcrumbs">','</div></div></div>' );
		}
		?>

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
