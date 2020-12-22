<?php
/**
 * Template part for displaying service
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */

$image_id = get_field('body_logo');
$image_header = wp_get_attachment_image_src($image_id, '700x300');
?>

<section class="program-item">
	<div class="">
		<?php get_template_part( 'template-parts/header/entry-header' ); ?>
	</div>
	<div class="grid-container-medium section-padding-tb">
		<div uk-grid>
			<div class="uk-width-1-1 uk-width-2-3@s content-left">
				
				<?php if(get_field('body_video')):?>
					<iframe width="700" height="315" src="<?php echo get_field('body_video')?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<?php else:?>
					<img src="<?php echo $image_header[0] ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>">
				<?php endif;?>
				<div class="uk-margin-medium-top">
					<?php the_content() ?>
				</div>
				<?php if(get_field('body_externalbtnlink')):?>
					
					<a class="button btn-blue uk-margin-medium-top" href="<?php echo get_field('body_externalbtnlink') ?>"><?php echo get_field('body_btntext')? get_field('body_btntext') : "Register Now"?></a>
				<?php endif;?>
			</div>
			<div class="uk-width-1-1 uk-width-1-3@s sideinfo_outer">
				<?php 
					$locations = get_field('body_location');
					//print_r($locations);
				?>
				<div class="sideinfo">
					<ul uk-accordion="collapsible: false">
						<?php foreach ($locations as $location) :?>
						<?php if($location['datetext']){
								$date = $location['datetext'];
							} else {
								$date = date_format( date_create($location['date']),"D d M");
							}
						?>	
						<li>
							<a  class="uk-accordion-title" href="#">
								<?php echo $location['heading'];?></a>
					        <div class="uk-accordion-content">
					            <span class="block">
									<i class="blue2" uk-icon="calendar"></i><?php echo $date;?><br>
									
								</span>
								<span class="block">
									<i class="blue2" uk-icon="clock"></i><?php echo $location['starttime'];?><?php if($location['starttime']){
										echo "-".$location['starttime'];
										}?>
								</span >
								<?php if($location['address']):?>
								<span class="block">
									<i class="blue2" uk-icon="location"></i><?php echo $location['address'];?>
								</span>
								<?php endif;?>
								<?php if(get_field('body_cost')):?>
									<span class="block">
										<i class="blue2 text">$</i><?php echo get_field('body_cost');?>
									</span>
								<?php endif;?>
								<?php if($location['address']):?>
						            <iframe
						              width="340"
						              height="220"
						              frameborder="0" style="border:0"
						              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAvavqTeZXc48iALmnGfypI6ZuJ1jNW-lE
						                &q=<?php echo $location['address'];?>" allowfullscreen>
						            </iframe>
					            <?php endif;?>
						    </div>
					    </li>
					    <?php endforeach;?>	
							
			        </ul>
		            <div uk-grid class="card-share uk-child-width-1-2 uk-grid-small">
		            	<div>
            				<a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><span uk-icon="icon: facebook"></span>Facebook</a>
            			</div>
            			<?php if(get_field('body_email')):?>
	            			<div>
	            				<a class="share-btn" href="mailto:<?php echo get_field('body_email')?>?subject=Bayside Church Event: <?php the_title()?>&amp;body=<?php the_permalink();?>" target="_blank" ><span uk-icon="icon: mail"></span> Email </a>
	            			</div>
	            		<?php endif;?>
            		</div>

            		<div class="commingup">
            			<p class="title">Coming Up</p>

            			<?php $programs = get_three_programs(get_the_id());?>
            			<?php if ($programs->have_posts()) :
							$count = 1;
							
								while ( $programs->have_posts() ) {
									$programs->the_post();
									$today = date("Y-m-d");

									
									get_template_part( 'template-parts/content/sidebar', 'program' );
								
								}
								wp_reset_postdata(); 
						endif;?>
            		</span>

				</div>
			</div>
		</div>
	</div>
</section>


<section class="block-1 center section-padding-tb question-bg">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<h2 class="white">Questions?</h2>
			<p class="white short-desc">Our team would love to help! Please feel free to contact us if you need further information about any of our services, groups or facilities.</p>
			<a class="button btn-white uk-margin-medium-top" href="">Contact Us</a>
		</div>
	</div>
</section>