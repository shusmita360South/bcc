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
	$term_id = $term->term_id;
	$taxonomy_name = $term->taxonomy;

	$subtitle = get_term_meta($term_id, 'subtitle', true);

	$termchildren = get_term_children( $term_id, $taxonomy_name );

	//echo "<pre>"; print_r($term);echo "</pre>";

	$blogHeaderImageUrl = get_option('event_header_image');
	$blogHeaderImageId = attachment_url_to_postid($blogHeaderImageUrl);

	$blogHeader = wp_get_attachment_image_src($blogHeaderImageId, '1920x420');


?>
<?php 
$tags = get_tags();


?>


<section class="page-banner container">	
	<div class="page-banner-image">				
		<figure>
			<img src="<?php echo $blogHeader[0];?>" alt="<?php the_title() ?>">
		</figure>	
	</div>
	<div class="page-banner-content">		
		<h1 class="">Blog</h1>
	</div>
</section>
<section class="filter-btn-outer blog-filter dark-bg container">
	<div class="grid-container">
		<div uk-grid id="filter-btn">
	      	<div class="uk-width-1-2 uk-width-auto@s">
	        <?php 
	          $allTags['slug'] = array();
	          $allTags['title'] = array();
	        
	          
	            $tagsObj =  get_tags();
				$tags = json_decode(json_encode($tagsObj), true);
	            foreach ($tags as  $tag) {
	              array_push($allTags['slug'],$tag['slug']);
	              array_push($allTags['title'],$tag['name']);
	            }
	            

	          
	         
	        ?>
		        <div class="select-outer">
		          	<select class="filter-select uk-select">
			            <option value="">All Tags</option>
			            <?php foreach ($allTags['slug'] as $key=>$allTag): ?>
			              <option value="<?php echo $allTags['slug'][$key];?>"><?php echo $allTags['title'][$key];?></option>
			            <?php endforeach;?>
		          	</select>
		        </div>
	      	</div>
	      	
	    </div>
	</div>
</section>
<section class="blogs-archive section-padding-tb light-bg container">
	<div class="grid-container">
		<div uk-grid>
			
			
			<?php
				if ( have_posts() ) {
					// Load podcast loop.
					while ( have_posts() ) {
						the_post(); 
						get_template_part( 'template-parts/content/content', 'blog' );
						
					 }
				}
				wp_reset_postdata(); 
			?>
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





