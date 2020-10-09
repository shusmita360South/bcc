<?php
/**
 * Template part for displaying service
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */

//$image_id = get_field('body_logo');
//$image_header = wp_get_attachment_image_src($image_id, '700x300');
$bodyColor = get_field('_body_color');

$galleries = get_field('_body_gallery');

?>

<section class="connect-item theme-<?php echo $bodyColor;?>">
	<div class="">
		<?php get_template_part( 'template-parts/header/entry-header' ); ?>
	</div>
	
	<section class="block-1 page-content section-padding-tb ">
		<div class="grid-container-small">
			<div class="block-1-inner center">
				
				<p><?php echo get_field('_body_intro');?></p>
				
				<div class="uk-margin-medium-top uk-grid-small uk-child-width-1-2 uk-child-width-1-2@xs uk-child-width-1-3@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-grid uk-lightbox="animation: fade">
					<?php foreach ($galleries as $gallery) :?>
						<?php $image_header = wp_get_attachment_image_src($gallery['image_id'], '300x300');?>
						<?php $image_full = wp_get_attachment_image_src($gallery['image_id'], 'full');?>
						<?php
							$caption = "<p >".$gallery['subheading']."<br>". $gallery['artist']."<br>". $gallery['subtitle']."<br>". $gallery['heading']."</p>";
						?>
						<div class="gallery-items">
					        <a class="uk-inline" href="<?php echo $image_full[0]; ?>" data-caption="<?php echo $caption;?>">
					            <img class="" src="<?php echo $image_header[0]; ?>" title="<?php echo $gallery['heading'] ?>" alt="<?php echo $gallery['heading'] ?>">
					        </a>
					    </div>
					<?php endforeach;?>
				    
				    
				</div>

			</div>
		</div>
	</section>
	
	

</section>


<section class="block-1 center section-padding-tb question-bg">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<h2 class="white">Questions?</h2>
			<p class="white short-desc">Our team would love to help! Please feel free to contact us if you need further information about any of our services, groups or facilities.</p>
			<a class="button btn-white uk-margin-medium-top" href="/contact-us">Contact Us</a>
		</div>
	</div>
</section>