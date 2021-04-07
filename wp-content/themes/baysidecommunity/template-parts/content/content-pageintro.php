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
$introBg = "white-bg";
//is_page_template( array( 'page-people.php', 'page-other.php' ) 

if(is_archive()|| is_page_template( 'page-people.php' )){
	$introBg = "light-bg";
}

?>
<section class="block-1 page-intro center section-padding-top <?php echo $introBg?>">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<h2><?php echo get_field('subheading'); ?></h2>

			<?php 
				$short_description = apply_filters( 'the_content', get_field('short_description') );
				$short_description = str_replace( ']]>', ']]&gt;', $short_description );
				echo $short_description; 
			?>

			<?php $topSliders = get_field('top_slider'); ?>
			<?php if($topSliders):?>
				<div class="section-top-slider uk-margin-medium-top owl-carousel">
					<?php foreach($topSliders as $topSlider) : ?>
						<?php $image_header = wp_get_attachment_image_src($topSlider['image_id'], '800x450');?>

						<?php if($topSlider['videoid']):?>
							<a class="video-btn" href="<?php echo $topSlider['videoid']?>">
								<div class="slide">
									<img src="<?php echo $image_header[0]; ?>" title="<?php echo $topSlider['heading'] ?>" alt="<?php echo $topSlider['heading'] ?>">	
									<div class="video-play-btn"></div>
								</div>
							</a>
						<?php else:?>
						<div class="slide">
							<img src="<?php echo $image_header[0]; ?>" title="<?php echo $topSlider['heading'] ?>" alt="<?php echo $topSlider['heading'] ?>">	
						</div>
						<?php endif;?>
					<?php endforeach; ?>
				</div>
				<div class="progress-bar-outer">
					<div class="progress-bar">
						<div class="progress-bar-inner"></div>
					</div>	
				</div>
			<?php endif;?>
			
		</div>
	</div>
</section>