<?php
/**
 * Template Name: Page FAQ
 *
 *
 * @package WordPress
 * @subpackage Bayside Community
 * @since 1.0.0
 */


get_header();

$faqCats = get_terms('faq_category');
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

	<section class="faq-list section-padding-tb light-bg">
		<div class="grid-container-small">
		

			<div>
				
				<?php foreach ($faqCats as $faqCat) :
					$FAQs = [];
					$faqCat = json_decode(json_encode($faqCat), true);
					$faqCatName = $faqCat['name'];	
					$faqCatId = $faqCat['term_id'];
					$faqCatSlug = $faqCat['slug'];

					echo "<h2 id=".$faqCatSlug.">". $faqCatName ."</h2>";
					$FAQs = get_faq($faqCatSlug, $faqCatId );

					echo "<ul uk-accordion>";
					if ($FAQs->have_posts()) :
					
						while ( $FAQs->have_posts() ) :
							$FAQs->the_post();
				?>			
						<li>
							<a  class="uk-accordion-title" href="#"><?php echo the_title();?></a>
					        <div class="uk-accordion-content">
					            <?php echo the_content();?>
					        </div>
					    </li>	
							
				<?php	endwhile;
						wp_reset_postdata(); 
					endif;
					echo "</ul>";
						
				endforeach;?>
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
