<?php
/**
 * Template Name: Page News
 *
 *
 * @package WordPress
 * @subpackage Bayside Community
 * @since 1.0.0
 */


get_header();
$peoples = get_people();
?>
<section class="page-default container">
	<div class="">
		<?php get_template_part( 'template-parts/header/entry-header' ); ?>
	</div>
	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		//get_template_part( 'template-parts/content/content', 'pagecontent' );
	endwhile; // End of the loop.
	?>

	<section class="peoples-archive section-padding-tb light-bg">
		<div class="grid-container">
			<div uk-grid>
				
				<?php if ($peoples->have_posts()) :
					$count = 1;
					
						while ( $peoples->have_posts() ) {
							$peoples->the_post();
							get_template_part( 'template-parts/content/content', 'people' );
						}
						wp_reset_postdata(); 
				endif;?>
			</div>		
		</div>		
			
	</section>

	<?php if ( get_field('ctabottom_heading') ) : ?>
		<section class="block-1 center section-padding-tb ctabottom-bg">
			<div class="grid-container-small">
				<div class="block-1-inner">
					<h2 class="white"><?php the_field('ctabottom_heading') ?></h2>
					<p class="white short-desc"><?php echo nl2br(get_field('ctabottom_short_description')) ?></p>
					<a class="button btn-white uk-margin-medium-top" href="<?php echo get_the_permalink(get_field('ctabottom_button_link')) ?>"><?php the_field('ctabottom_button_text') ?></a>


				</div>
			</div>
		</section>
	<?php endif; ?>

</section>	
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php
get_footer();
