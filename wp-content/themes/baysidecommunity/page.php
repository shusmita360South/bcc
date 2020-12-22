<?php
/**
 * The template for displaying single page
 *
 *
 * @package WordPress
 * @subpackage Comfort Sleep
 * @since 1.0.0
 */


get_header();

?>
<section class="page-default container">

	<div class="">
		<?php get_template_part( 'template-parts/header/entry-header' ); ?>
	</div>


	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content/content', 'pagecontent' );
	endwhile; // End of the loop.
	?>

	<?php if(get_field('body_content')): ?>
		<?php get_template_part( 'template-parts/content/content', 'pagecontent2cols' );?>
	<?php endif;?>

	<?php if ( get_field('ctabottom_heading') ) : ?>
		<?php 
			$image_header = wp_get_attachment_image_src(get_field('ctabottom_image'), '1920x420');
			if ($image_header) {
				$ctabottomBg = $image_header[0];

			} else {
				$ctabottomBg = "../img/exploringfaith.jpg";
			}

		?>
		<section class="block-1 center section-padding-tb ctabottom-bg" style="background-image: url(<?php echo $ctabottomBg?>);">
			<div class="grid-container-small">
				<div class="block-1-inner">
					<h2 class="white"><?php the_field('ctabottom_heading') ?></h2>
					<p class="white short-desc"><?php echo nl2br(get_field('ctabottom_short_description')) ?></p>
					<a class="button btn-white uk-margin-medium-top" href="<?php echo get_the_permalink(the_field('ctabottom_button_link')) ?>"><?php the_field('ctabottom_button_text') ?></a>


				</div>
			</div>
		</section>
	<?php endif; ?>

</section>	
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php
get_footer();
