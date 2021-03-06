<?php
/**
 * Template Name: Page Donate
 *
 *
 * @package WordPress
 * @subpackage Bayside Community
 * @since 1.0.0
 */


get_header();
$donates = get_all_donates();
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

	<section class="donate-archive section-padding-tb light-bg">
		<div class="grid-container-small center section-padding-bottom">
			<h2>
				Donate Today
			</h2>
			<div class="block-1-inner">
				<?php the_content(); ?>
			</div>		
		</div>


		<div class="grid-container">
			<div uk-grid>
				
				<?php if ($donates->have_posts()) :
					$count = 1;
					
						while ( $donates->have_posts() ) {
							$donates->the_post();
							get_template_part( 'template-parts/content/content', 'donate-card' );
						}
						wp_reset_postdata(); 
				endif;?>
			</div>		
		</div>		
			
	</section>


	<?php if(get_field('body_content')): ?>
		<?php get_template_part( 'template-parts/content/content', 'pagecontent2cols' );?>
	<?php endif;?>


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


?>
<script>
	//	START THE TITHELY WIDGET
	var tw = create_tithely_widget();
</script>