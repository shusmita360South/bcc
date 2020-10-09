<?php
/**
* Template Name: Prayer Page
*
* @package WordPress
* @subpackage ComfortSleep
* @since ComfortSleep
*/

get_header();
$phone = get_option('contact_phone');
$address = get_option('contact_address');
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
			<div class="uk-width-1-1 ">
				<?php get_template_part( 'template-parts/content/form', 'prayer' );?>
			</div>
			
		</div>
	</div>
</section>	
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php
get_footer();

