<?php
/**
 * Displays the menus and widgets at the end of the main element.
 * Visually, this output is presented as part of the footer element.
 *
 * @package WordPress
 * @subpackage Bayside_Church
 * @since Bayside Community 1.0
 */

?>

<div class="footer-nav-widgets-wrapper section-padding-tb container">

	<div class="footer-inner grid-container">

		<div uk-grid>
			<div class="uk-width-1-1 uk-width-1-1@s uk-width-1-3@m uk-width-1-3@l uk-width-1-2@xl">
				<div class="site-title faux-heading"><a href="/"><img src="/img/logo-white.svg" width="240"/></a></div>
				<div class="widget-2">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
				<nav aria-label="<?php esc_attr_e( 'Social links', 'baysidecommunity' ); ?>" class="footer-social-wrapper">

					<ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">

						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'social',
								'container'       => '',
								'container_class' => '',
								'items_wrap'      => '%3$s',
								'menu_id'         => '',
								'menu_class'      => '',
								'depth'           => 1,
								'link_before'     => '<span class="screen-reader-text">',
								'link_after'      => '</span>',
								'fallback_cb'     => '',
							)
						);
						?>

					</ul><!-- .footer-social -->

				</nav><!-- .footer-social-wrapper -->

			</div>
			<div class="uk-visible@m uk-width-1-1 uk-width-2-3@s uk-width-2-3@m uk-width-2-3@l uk-width-1-2@xl nav-outer">
				<div uk-grid>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<p class="title">Connect with God</p>
						<nav aria-label="<?php esc_attr_e( 'Footer', 'baysidecommunity' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php
								$menu_items = wp_get_nav_menu_items(3, array());?>
								
								<?php foreach ($menu_items as $item) {
								    if ($item->menu_item_parent == 15) {?>
								        <li><a href="<?php print_r($item->url);?>"><?php print_r($item->title);?></a></li>
								<?php
								    }
								}
								?>
							</ul>

						</nav><!-- .site-nav -->
					</div>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<p class="title">Connect with People</p>
						<nav aria-label="<?php esc_attr_e( 'Footer', 'baysidecommunity' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php foreach ($menu_items as $item) {
								    if ($item->menu_item_parent == 34) {?>
								        <li><a href="<?php print_r($item->url);?>"><?php print_r($item->title);?></a></li>
								<?php
								    }
								}
								?>
							</ul>

						</nav><!-- .site-nav -->
					</div>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<p class="title">Connect with Church</p>
						<nav aria-label="<?php esc_attr_e( 'Footer', 'baysidecommunity' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php foreach ($menu_items as $item) {
								    if ($item->menu_item_parent == 35) {?>
								        <li><a href="<?php print_r($item->url);?>"><?php print_r($item->title);?></a></li>
								<?php
								    }
								}
								?>
							</ul>

						</nav><!-- .site-nav -->
					</div>
				</div><!-- uk-grid -->	
			</div>
		</div><!-- uk-grid -->

		<div uk-grid>
			<div class="uk-width-1-1 uk-width-1-1@s uk-width-1-3@m uk-width-1-3@l uk-width-1-2@xl">
				<div class="site-title faux-heading"><a href="/"><img src="/img/acnc-logo.png" width="62"/></a></div>
				<div class="widget-1 uk-margin-medium-top">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			</div>
			<div class="uk-visible@m uk-width-1-1 uk-width-2-3@s uk-width-2-3@m uk-width-2-3@l uk-width-1-2@xl nav-outer">
				<div uk-grid>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<p class="title">Connect with Community</p>
						<nav aria-label="<?php esc_attr_e( 'Footer', 'baysidecommunity' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php foreach ($menu_items as $item) {
								    if ($item->menu_item_parent == 36) {?>
								        <li><a href="<?php print_r($item->url);?>"><?php print_r($item->title);?></a></li>
								<?php
								    }
								}
								?>
							</ul>

						</nav><!-- .site-nav -->
					</div>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<p class="title">Help</p>
						<nav aria-label="<?php esc_attr_e( 'Footer', 'baysidecommunity' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php foreach ($menu_items as $item) {
								    if ($item->menu_item_parent == 37) {?>
								        <li><a href="<?php print_r($item->url);?>"><?php print_r($item->title);?></a></li>
								<?php
								    }
								}
								?>
							</ul>

						</nav><!-- .site-nav -->
					</div>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<p class="title">Legal</p>
						<nav aria-label="<?php esc_attr_e( 'Footer', 'baysidecommunity' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php
								wp_nav_menu(
									array(
										'container'      => '',
										'depth'          => 1,
										'items_wrap'     => '%3$s',
										'theme_location' => 'footer',
										'menu_id' => 'footer1',
									)
								);
								?>
							</ul>

						</nav><!-- .site-nav -->
					</div>
				</div><!-- uk-grid -->	
			</div>
		</div><!-- uk-grid -->

	</div><!-- .footer-inner -->

</div><!-- .footer-nav-widgets-wrapper -->		
				

						

					
					

						

			
		

