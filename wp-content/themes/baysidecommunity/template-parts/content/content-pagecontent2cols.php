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
$twoCols = get_field('body_content'); 

?>
<!-- 
'image_id' => '',
'videoid' => '',
'heading' => '',
'subheading' => '' 
-->



<div class="block-2">
	<div class="block-2-inner">
	<?php $count=0;?>
	<?php foreach ($twoCols as $twoCol) :?>
		<?php $count++;?>
		<?php if($count%2 == 0) {
			$rowStyle="even-row";
		}else {
			$rowStyle="odd-row";
		}?>
		<?php $image_header = wp_get_attachment_image_src($twoCol['image_id'], '460x330');?>
		<div class="<?php echo  $rowStyle;?> section-padding-tb">
			<div class="grid-container-small">
				<div uk-grid class="item ">
				
					<div class="uk-width-1-1 uk-width-1-2@s">
						<h2 class="uk-hidden@s margin-bottom-30"><?php echo $twoCol['subheading'];?></h2>
						
						<div class="item-image">
							<img src="<?php echo $image_header[0]; ?>" title="<?php echo strip_tags($twoCol['heading']);?>" alt="<?php echo strip_tags($twoCol['heading']);?>">	
						</div>
						
						
					</div>
					<div class="uk-width-1-1 uk-width-1-2@s">
						<div class="content">
							<div class="content-inner">
								<h2 class="uk-visible@s"><?php echo $twoCol['subheading'];?></h2>
								<?php 
									$short_description = apply_filters( 'the_content', $twoCol['heading'] );
									$short_description = str_replace( ']]>', ']]&gt;', $short_description );
									echo $short_description; 
								?>
								<?php if($twoCol['button_text']):?>
									<?php if($twoCol['button_external_link']):?>

										<a class="video-btn button btn-blue uk-margin-medium-top" href="<?php echo $twoCol['button_external_link']?>"><?php echo nl2br($twoCol['button_text']) ?></a>

									<?php else:?>
										<a class="button btn-blue uk-margin-medium-top" href="<?php echo get_the_permalink($twoCol['button_link']); ?>"><?php echo nl2br($twoCol['button_text']) ?></a>
									<?php endif;?>

								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach;?>
	</div>
</div>


