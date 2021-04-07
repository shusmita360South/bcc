<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>
<?php 

?>
<section class="block-1 page-content section-padding-tb ">
	<div class="grid-container-small">
		<div class="block-1-inner justify-left">
			
			<?php the_content() ?>
		</div>
	</div>
</section>
<?php $faqId = get_field('body_faq');?>
<?php if ($faqId ) :?>
	<section class="block-1 page-content section-padding-tb light-bg faq-list">
		<div class="grid-container-small">
			<h2 class='center'>FAQs</h2>
			<div class="block-1-inner justify-left">
			
				<?php
					$faqCat = get_term($faqId);
					$FAQs = [];
					$faqCat = json_decode(json_encode($faqCat), true);
					$faqCatName = $faqCat['name'];	
					$faqCatId = $faqCat['term_id'];
					$faqCatSlug = $faqCat['slug'];

					
					$FAQs = get_faq($faqCatSlug, $faqCatId );

					echo "<ul uk-accordion class=''>";
					if ($FAQs->have_posts()) :
					
						while ( $FAQs->have_posts() ) :
							$FAQs->the_post();
				?>			
						<li>
							<a  class="uk-accordion-title" href="#"><?php echo the_title();?></a>
					        <div class="uk-accordion-content ">
					            <?php echo the_content();?>
					        </div>
					    </li>	
							
				<?php	endwhile;
						wp_reset_postdata(); 
					endif;
					echo "</ul>";
				?>		
			
			</div>
		</div>
	</section>
<?php endif;?>