<?php
/**
* Template Name: Contact Page
*
* @package WordPress
* @subpackage ComfortSleep
* @since ComfortSleep
*/

get_header();
$phone = get_option('contact_phone');
$address = get_option('contact_address');
$suburb = get_option('contact_suburb');
$email = get_option('contact_email');
$phonecare = get_option('contact_phonecare');
$phonemedia = get_option('contact_phonemedia');

?>


<section class="page-default light-bg section-padding-bottom container">
	<div class="">
		<?php get_template_part( 'template-parts/header/entry-header' ); ?>
	</div>
	
	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content/content', 'pagecontent' );
	endwhile; // End of the loop.
	?>
	<div class="grid-container-small">
		<div uk-grid>
			<div class="uk-width-1-1 uk-width-3-5@s">
				<?php get_template_part( 'template-parts/content/form', 'contact' );?>
			</div>
			<div class="uk-width-1-1 uk-width-2-5@s contact-sidebar">
				<span class="icon-outer blue-bg"><span uk-icon="icon: home"></span></span>
				<p class="title">Office</p>
				<p><a class="" href="https://www.google.com/maps/place/<?php echo $address?>" target="_blank"><?php echo $address; ?><br /><?php echo $suburb; ?></a></p>

				<span class="icon-outer blue-bg uk-margin-small-top"><span uk-icon="icon: phone"></span></span>
				<p class="title">Phone</p>
				<p><a href="tel:+<?php echo $phone; ?>"><?php echo $phone; ?></a></p>

				<span class="icon-outer blue-bg uk-margin-small-top"><span uk-icon="icon: mail"></span></span>
				<p class="title">Email</p>
				<p><a href="mailto:+<?php echo $email; ?>"><?php echo $email; ?></a></p>

				<?php 
					if ($phonecare != '') {
				?>
				
				<span class="icon-outer blue-bg uk-margin-small-top"><span uk-icon="icon: lifesaver"></span></span>
				<p class="title">Pastoral Care</p>
				<p><a href="tel:+<?php echo $phonecare; ?>"><?php echo $phonecare; ?></a></p>
				
				<?php 				
					};
				?>

				<span class="icon-outer blue-bg uk-margin-small-top"><span uk-icon="icon: nut"></span></span>
				<p class="title">Media Enquiries </p>
				<p><a href="tel:+<?php echo $phonemedia; ?>"><?php echo $phonemedia; ?></a></p>




					
			</div>
		</div>
	</div>
</section>	
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php
get_footer();

