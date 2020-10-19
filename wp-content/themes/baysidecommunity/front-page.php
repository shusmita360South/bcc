<?php get_header(); ?>
<?php 
$headerBg = "white-bg";
$headerBgColor = "#FFFFFF";


?>
<div class="container">
	<section class="top-note"><?php the_field('note_text1') ?><span uk-close></span></section>
	<section class="hero">
		<?php if ($sliders = get_field('hero_slider', get_the_ID())) : ?>
			<div class="hero-slider owl-carousel">
				<?php foreach($sliders as $slider) : ?>
					<?php $image_header = wp_get_attachment_image_src($slider['image_id'], '1920x920');?>
					<div class="slide"  data-dot="<span><span class='line color-<?php echo $slider['heroslide_color'] ?>'></span><span class='text'><?php echo $slider['subheading'] ?></span></span>">
						
			            	<img class="" src="<?php echo $image_header[0]; ?>" title="<?php echo $slider['heading'] ?>" alt="<?php echo $slider['heading'] ?>">
			           
			            <div class="slide-content">
							<h1><?php echo nl2br($slider['heading']) ?></h1>
							<?php if(isset($slider['button_external_link']) && $slider['button_external_link'] != "") : ?>
								<a class="button btn-<?php echo $slider['heroslide_color'] ?> uk-margin-medium-top" href="<?php echo $slider['button_external_link']; ?>" target="_blank"><?php echo nl2br($slider['button_text']) ?></a>
							<?php else : ?>
								<a class="button btn-<?php echo $slider['heroslide_color'] ?> uk-margin-medium-top" href="<?php echo get_the_permalink($slider['button_link']); ?>"><?php echo nl2br($slider['button_text']) ?></a>
							<?php endif; ?>
						</div>
						
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>

	<?php if(get_field('note_text2')): ?>
	<section class="bottom-note">
		<div class="grid-container-small">
			<div class="bottom-note-inner">
				<span><?php the_field('note_text2') ?></span>
				<span class="close">Close</span>
			</div>
		</div>
	</section>
	<?php endif; ?>


	<?php if ( get_field('about_heading') ) : ?>
		<section class="block-1 center section-padding-tb">
			<div class="grid-container-small">
				<div class="block-1-inner">
					<h2 class="blue"><?php the_field('about_heading') ?></h2>
					<p class="short-desc"><?php echo nl2br(get_field('about_short_description')) ?></p>
					<?php if( get_field('about_button_link') ) : ?>
						<a class="button-arrow-dark" href="<?php echo get_page_link(get_field('about_button_link')) ?>"><?php the_field('about_button_text'); ?></a>	
					<?php endif; ?>	
					<?php if ($about_blocks = get_field('about_blocks', get_the_ID())) : 
						$about_blocks_counts = 0;

						?>
						<div class="about_blocks" uk-grid>
							<?php foreach($about_blocks as $about_block_id) :
								$about_blocks_counts++; 
								if ($about_blocks_counts == 1 || $about_blocks_counts==2) {
									$ukWidth = "uk-width-1-1 uk-width-1-2@s";
								} else {
									$ukWidth = "uk-width-1-1 uk-width-1-3@s";
								}
								$about_block_post = new WP_Query('page_id='.$about_block_id);
								while ($about_block_post->have_posts()) : $about_block_post->the_post();
							?>
								
								
							
								<?php //$image_header = wp_get_attachment_image_src($about_block['image_id'], '460x300');?>
								<div class="<?php echo $ukWidth;?> uk-margin-medium-top">
									<div class="about_block">
										<a href="<?php echo get_page_link()?>">
								           <?php the_post_thumbnail( '460x300' ); ?>	
								           
								            <div class="slide-content">
												<h4><?php the_title(); ?></h4>
												
											</div>
										</a>
									</div>
									
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="home-feature blue-light-bg section-padding-tb">
		<?php if ($features = get_field('home_feature', get_the_ID())) :?>
			<div class="grid-container-small">
				<div uk-grid>
				<?php foreach($features as $feature) : ?>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<div class="item center">
			            	<i class="<?php echo $feature['iconid'] ?>"></i>
			           
							<h2 class="blue uk-margin-small-top"><?php echo $feature['heading'] ?></h2>
							<h4 class="blue"><?php echo $feature['title']?></h4>
							<p><?php echo nl2br($feature['short_description']) ?></p>
							
						</div>
						
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>

	

	<?php if ( get_field('program_heading') ) : ?>
		<section class="block-1 section-padding-top green-bg">
			<div class="grid-container-small">
				<div class="block-1-inner center ">
					<h2 class="white"><?php the_field('program_heading') ?></h2>
					<p class="white short-desc"><?php echo nl2br(get_field('program_short_description')) ?></p>
				</div>
			</div>
			<div class="grid-container">

					<?php $programs = get_all_programs();?>
					<div class="owl-carousel connect-program-carousel owl-theme uk-margin-medium-top">
				
						
						<?php if ($programs->have_posts()) :
							$count = 1;
							
								while ( $programs->have_posts() ) {
									$programs->the_post();
									get_template_part( 'template-parts/content/content', 'program' );
								}
								wp_reset_postdata(); 
						endif;?>
					</div>		


			</div>
		</section>
	<?php endif; ?>

	<?php if ( get_field('getinvolve_heading') ) : ?>
		<section class="block-1 center section-padding-tb">
			<div class="grid-container-small">
				<div class="block-1-inner">
					<h2 class="blue"><?php the_field('getinvolve_heading') ?></h2>
					<p class="short-desc"><?php echo nl2br(get_field('getinvolve_short_description')) ?></p>
					<?php if( get_field('getinvolve_button_link') ) : ?>
						<a class="button-arrow-dark" href="<?php echo get_page_link(get_field('getinvolve_button_link')) ?>"><?php the_field('getinvolve_button_text'); ?></a>	
					<?php endif; ?>	
					<?php if ($getinvolve_blocks = get_field('getinvolve_posts', get_the_ID())) : 
						$getinvolve_blocks_counts = 0;

						?>
						<div class="about_blocks" uk-grid>
							<?php foreach($getinvolve_blocks as $getinvolve_block_id) :
								$getinvolve_blocks_counts++; 
								
							?>

								<?php //$image_header = wp_get_attachment_image_src($getinvolve_block['image_id'], '460x300');
								if ($getinvolve_blocks_counts == 1 ) :?>
									<div class="uk-width-1-1 uk-width-2-3@s uk-margin-medium-top">
										<?php
										$getinvolve_block_post = new WP_Query('page_id='.$getinvolve_block_id);
										while ($getinvolve_block_post->have_posts()) : $getinvolve_block_post->the_post();
										?>
										<div class="about_block">
											<a href="<?php echo get_page_link()?>">

									           <?php 
									           		the_post_thumbnail( '620x350' );
									           		
									           	?>	
									           
									            <div class="slide-content">
													<h4><?php the_title(); ?></h4>
													
												</div>
											</a>
										</div>
										<?php endwhile; ?>
									</div>
								<?php endif; ?>
								<?php wp_reset_postdata(); ?>
							<?php endforeach; ?>
							<div class="uk-width-1-1 uk-width-1-3@s uk-margin-medium-top">
								<div uk-grid>
								<?php 
								$getinvolve_blocks_counts = 0;
								foreach($getinvolve_blocks as $getinvolve_block_id) :
									$getinvolve_blocks_counts++; 
									
								?>
									<?php 
									if ($getinvolve_blocks_counts > 1 ) :?>
										<div class="uk-width-1-1">
											<?php
											$getinvolve_block_post = new WP_Query('page_id='.$getinvolve_block_id);
											while ($getinvolve_block_post->have_posts()) : $getinvolve_block_post->the_post();
											?>
											<div class="about_block">
												<a href="<?php echo get_page_link()?>">

										           
										           	<?php		the_post_thumbnail( '460x260' );?>
										           
										           
										            <div class="slide-content">
														<h4><?php the_title(); ?></h4>
														
													</div>
												</a>
											</div>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
								
								<?php wp_reset_postdata(); ?>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( get_field('subscribe_heading') ) : ?>
		<section class="block-1 center section-padding-tb subscribe-bg">
			<div class="grid-container-small">
				<div class="block-1-inner">
					<h2 class="white"><?php the_field('subscribe_heading') ?></h2>
					<form class="uk-margin-medium-top">
						
				        <input class="uk-input" type="text" placeholder="Email"><button class="uk-button uk-button-default"><span class="white" uk-icon="arrow-right"></span></button>
				    </form>
				</div>
			</div>
		</section>
	<?php endif; ?>

</div>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer();
