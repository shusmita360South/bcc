<?php
/**
 * The template for displaying all single posts
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */

get_header(); ?>


<div class="container">
<?php 
	// start counting
	$count = 1;

	// Load services loop.
	while ( have_posts() ) {
		the_post(); 
		get_template_part( 'templates/content/page', 'program' );
	}
	wp_reset_postdata(); ?>

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>
</div>