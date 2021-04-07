<?php
/**
 * Template Name: Page Locations
 *
 *
 * @package WordPress
 * @subpackage Bayside Community
 * @since 1.0.0
 */


get_header();
$phone = get_option('contact_phone');
$address = get_option('contact_address');
$email = get_option('contact_email');
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

	<section class="devotion-page section-padding-tb light-bg">
		<div class="grid-container">
			<div uk-grid>
				
				<div class="item event-card-outer uk-width-1-1 uk-width-1-3@s uk-width-1-3@m">
					<div class="event-card connect-group-card message-card gallery-card location-card">
						
						<div class="image">
							<iframe
				              width="340"
				              height="220"
				              frameborder="0" style="border:0"
				              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAvavqTeZXc48iALmnGfypI6ZuJ1jNW-lE
				                &q=<?php echo $address;?>" allowfullscreen>
				            </iframe>
						</div>
						<div class="content">
							
							<h4 class="">Bayside Community Cheltenham</h4>
							
							<p>
								<a href="tel:<?php echo $address;?>"><i class="uk-margin-small-right" uk-icon="location"></i><?php echo $address?></a><br>
								<a href="tel:<?php echo $phone;?>"><i class="uk-margin-small-right" uk-icon="receiver"></i><?php echo $phone?></a><br>
								<a href="mailto:<?php echo $email;?>"><i class="uk-margin-small-right" uk-icon="mail"></i><?php echo $email?></a>
							</p>
						</div>
					
				            
					</div>
				</div>
				<div class="item event-card-outer uk-width-1-1 uk-width-1-3@s uk-width-1-3@m">
					<div class="event-card connect-group-card message-card gallery-card location-card">
						
						<div class="image">
							<iframe
				              width="340"
				              height="220"
				              frameborder="0" style="border:0"
				              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAvavqTeZXc48iALmnGfypI6ZuJ1jNW-lE
				                &q=<?php echo $address;?>" allowfullscreen>
				            </iframe>
						</div>
						<div class="content">
							
							<h4 class="">Bayside Community Zambia</h4>
							
							<p>
								<a href="tel:<?php echo $address;?>"><i class="uk-margin-small-right" uk-icon="location"></i><?php echo $address?></a><br>
								<a href="tel:<?php echo $phone;?>"><i class="uk-margin-small-right" uk-icon="receiver"></i><?php echo $phone?></a><br>
								<a href="mailto:<?php echo $email;?>"><i class="uk-margin-small-right" uk-icon="mail"></i><?php echo $email?></a>
							</p>
						</div>
					
				            
					</div>
				</div>
				<div class="item event-card-outer uk-width-1-1 uk-width-1-3@s uk-width-1-3@m">
					<div class="event-card connect-group-card message-card gallery-card location-card">
						
						<div class="image">
							<img src="/img/site/default-460x300.png"/>
						</div>
						<div class="content">
							
							<h4 class="">Online Church</h4>
							
							<p>
								<a href="tel:<?php echo $address;?>"><i class="uk-margin-small-right" uk-icon="location"></i>Online</a><br>
								<a href="tel:<?php echo $phone;?>"><i class="uk-margin-small-right" uk-icon="receiver"></i><?php echo $phone?></a><br>
								<a href="mailto:<?php echo $email;?>"><i class="uk-margin-small-right" uk-icon="mail"></i><?php echo $email?></a>
							</p>
						</div>
					
				            
					</div>
				</div>
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
