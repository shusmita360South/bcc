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

<section class="event-item">
	<div class="">
		<?php get_template_part( 'template-parts/header/entry-header' ); ?>
	</div>
	<div class="grid-container-medium section-padding-tb">
		<div uk-grid>
			<div class="uk-width-1-1 uk-width-2-3@s content-left">
				<img src="<?php echo $image_header[0] ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>">
				<h4 class="uk-margin-medium-top"><?php the_title() ?></h4>
				<?php the_content() ?>
				<a class="button btn-blue uk-margin-medium-top" href="<?php echo get_page_link(get_field('body_externalbtnlink')) ?>">Register Now</a>
			</div>
			<div class="uk-width-1-1 uk-width-1-3@s sideinfo_outer">
				<?php 
				$locations = get_field('body_location');
			?>
				<div class="sideinfo">
					<span class="block">
						<i class="blue" uk-icon="calendar"></i><?php echo date_format( date_create(get_field('body_startdate')),"D d M");?><br>
						<?php echo get_field('body_starttime')."-".get_field('body_endtime');?>
					</span>
					<span class="block">
						<i class="blue" uk-icon="clock"></i><?php echo get_field('body_starttime');?>
					</span >
					
					<span class="block">
						<i class="blue" uk-icon="location"></i><?php echo get_field('body_locationtitle');?>
					</span>
					<span class="block">
						<i class="blue text">$</i><?php echo get_field('body_cost');?>

					</span>
					<?php if(get_field('body_map')):?>
			            <iframe
			              width="340"
			              height="220"
			              frameborder="0" style="border:0"
			              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAvavqTeZXc48iALmnGfypI6ZuJ1jNW-lE
			                &q=<?php echo get_field('body_map');?>" allowfullscreen>
			            </iframe>
		            <?php endif;?>
		            <div uk-grid class="card-share uk-child-width-1-2 uk-grid-small">
		            	<div>
            				<a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['REQUEST_URI'];?>"><span uk-icon="icon: facebook"></span>Facebook</a>
            			</div>
            			<div>
            				<a class="share-btn" href="mailto:?subject=<?php echo $item->title ?>&amp;body=<?php echo $_SERVER['REQUEST_URI'];?>" target="_blank" ><span uk-icon="icon: mail"></span> Email </a>
            			</div>
            		</div>

            		<div class="commingup">
            			<p class="title">Coming Up</p>

            			<?php $events = get_three_events();?>
            			<?php if ($events->have_posts()) :
							$count = 1;
							
								while ( $events->have_posts() ) {
									$events->the_post();
									$today = date("Y-m-d");

									$endDate = date_format( date_create(get_field('body_enddate')),"Y-m-d");
									if ($endDate > $today) {
										get_template_part( 'template-parts/content/sidebar', 'event' );
									}
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