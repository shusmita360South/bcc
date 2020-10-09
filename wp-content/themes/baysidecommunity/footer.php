<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bayside_Church
 * @since Bayside Community 1.0
 */

?>
		<footer id="site-footer" role="contentinfo" class="container">
			<div class="grid-container">
				<div class="footer-section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://www.php.net/date */
								_x( 'Y', 'copyright date format', 'baysidecommunity' )
							);
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</p><!-- .footer-copyright -->

						

					</div><!-- .footer-credits -->
					<div>
						<p class="powered-by-wordpress">
							<a href="<?php echo esc_url( __( 'https://360south.com.au', 'baysidecommunity' ) ); ?>">
								<?php _e( ' Website by 360South', 'baysidecommunity' ); ?>
							</a>
						</p><!-- .powered-by-wordpress -->
					</div>

					

				</div><!-- .section-inner -->
			</div>
		</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
