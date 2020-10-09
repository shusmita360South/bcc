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
$featureBlocks = get_field('feature_blocks'); 
$count =0;
?>
<section class="block-1 page-content section-padding-tb light-bg">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<?php the_content() ?>
		</div>
	</div>
	<?php if($featureBlocks):?>
		<div class="grid-container">
			<div uk-grid class="item section-padding-top">
			<?php foreach ($featureBlocks as $featureBlock) :?>
			<?php $count++;?>
				<?php if($count <= 3):?>
				<?php $image_header = wp_get_attachment_image_src($featureBlock['image_id'], '460x260');?>


					<div class="item event-card-outer uk-width-1-1 uk-width-1-3@s">
						<div class="event-card feature-card">
							<div class="image">
								<img src="<?php echo $image_header[0]; ?>" title="<?php echo strip_tags($featureBlock['heading']);?>" alt="<?php echo strip_tags($featureBlock['heading']);?>"/>	
							</div>
							<div class="content">
								
								<h4 class="<?php echo $featureBlock['slide_color'];?>"><?php echo $featureBlock['subheading']; ?></h4>
								
								<div class="intro">
									<?php 
										$short_description = apply_filters( 'the_content', $featureBlock['heading'] );
										$short_description = str_replace( ']]>', ']]&gt;', $short_description );
										echo $short_description; 
									?>
								</div>
								<div class="more-info-bottom <?php echo $featureBlock['slide_color'];?>-bg">
									<a class="blue" href="<?php echo $featureBlock['button_external_link'] ?>" class="button more-info"><?php echo nl2br($featureBlock['button_text']) ?></a>
									
								</div>
							</div>
					            
						</div>
					</div>
					
						
							
						
				<?php endif;?>	
				
			<?php endforeach;?>
			</div>
	<?php endif;?>
</section>