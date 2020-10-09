<?php
/**
 * The template for displaying archive pages
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */

get_header(); 

?>
<?php
	$term = get_queried_object();

	//echo "<pre>"; print_r($term);echo "</pre>";

	$peopleHeaderImageUrl = get_option('event_header_image');
	$peopleHeaderImageId = attachment_url_to_postid($peopleHeaderImageUrl);

	$peopleHeader = wp_get_attachment_image_src($peopleHeaderImageId, '1920x420');


?>
<?php 
$peoples = get_people();


?>
<?php $totalCount = $peoples->post_count;?>

<section class="page-banner container">	
	<div class="page-banner-image">				
		<figure>
			<img src="<?php echo $peopleHeader[0];?>" alt="<?php the_title() ?>">
		</figure>	
	</div>
	<div class="page-banner-content">		
		<h1 class="">Our Team</h1>
	</div>
</section>

<section class="peoples-archive section-padding-tb light-bg container">
	<div class="grid-container">
		<div uk-grid>
			
			<?php if ($peoples->have_posts()) :
				$count = 1;
				
					while ( $peoples->have_posts() ) {
						$peoples->the_post();
						get_template_part( 'template-parts/content/content', 'people' );
					}
					wp_reset_postdata(); 
			endif;?>
		</div>		
	</div>		
		
</section>
<section class="block-1 center section-padding-tb connectgroup-bg container">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<h2 class="white">Connect!</h2>
			<p class="white short-desc">We endeavour to see people belong and thrive</p>
			<a class="button btn-white uk-margin-medium-top" href="">Connect Groups</a>
		</div>
	</div>
</section>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer();?>





