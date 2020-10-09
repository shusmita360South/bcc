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

	$eventHeaderImageUrl = get_option('event_header_image');
	$eventHeaderImageId = attachment_url_to_postid($eventHeaderImageUrl);

	$eventHeader = wp_get_attachment_image_src($eventHeaderImageId, '1920x420');


?>
<?php 
$events = get_all_events();

$next_church_onine = get_option('next_church_onine');

?>
<?php $totalCount = $events->post_count;?>

<section class="page-banner container">	
	<div class="page-banner-image">				
		<figure>
			<img src="<?php echo $eventHeader[0];?>" alt="<?php the_title() ?>">
		</figure>	
	</div>
	<div class="page-banner-content">		
		<h1 class="">What’s on at Bayside</h1>
	</div>
</section>
<section class="filter-btn-outer event-filter dark-bg container">
	<div class="grid-container">
		<div uk-grid id="filter-btn">
	      	<div class="uk-width-auto">
	        <?php 
	          $allCats['slug'] = array();
	          $allCats['title'] = array();
	        
	          foreach ($events as $item): 
	            $catsObj = get_terms('event_group');
				$cats = json_decode(json_encode($catsObj), true);
	            foreach ($cats as  $cat) {
	              array_push($allCats['slug'],$cat['slug']);
	              array_push($allCats['title'],$cat['name']);
	            }
	            
	          endforeach;
	          $allCats['slug'] = array_unique($allCats['slug']);
	          $allCats['title'] = array_unique($allCats['title']);
	        ?>
		        <div class="select-outer">
		          	<select class="filter-select uk-select">
			            <option value="">All Categories</option>
			            <?php foreach ($allCats['slug'] as $key=>$allCat): ?>
			              <option value="<?php echo $allCats['slug'][$key];?>"><?php echo $allCats['title'][$key];?></option>
			            <?php endforeach;?>
		          	</select>
		        </div>
	      	</div>

	      	<div class="uk-width-auto">
	      		<div class="select-outer">
		          	<select class="filter-select uk-select">
			            <option value="">All Genger</option>
			            <?php 
			            	$allGenders = array (
							  array("male","Male"),
							  array("female","Female")
							);

			            ?>
			            <?php foreach ($allGenders as $key=>$allGender): ?>
			              <option value="<?php echo $allGender[0];?>"><?php echo $allGender[1];?></option>
			            <?php endforeach;?>
		          	</select>
		        </div>
	      	</div>

	      	<div class="uk-width-auto">
	      		<div class="select-outer">
		          	<select class="filter-select uk-select">
			            <option value="">All Age</option>
			            <?php 
			            	$allAges = array (
							  array("0-18","Under 18"),
							  array("18-30","18-30"),
							  array("30-40","30-40"),
							  array("40-50","40-50"),
							  array("50+","Over 50")
							);

			            ?>
			            <?php foreach ($allAges as $key=>$allAge): ?>
			              <option value="<?php echo $allAge[0];?>"><?php echo $allAge[1];?></option>
			            <?php endforeach;?>
		          	</select>
		        </div>
	      	</div>
	      	<div class="uk-width-auto@s uk-margin-auto-left event-note">
	      		<div class="event-note-inner">
	      			<span class="blue">NEXT BAYSIDE CHURCH ONLINE: </span> <span class="white"> <?php echo $next_church_onine;?></span>
	      		</div>
	      	</div>

	      	
	    </div>
	</div>
</section>
<section class="events-archive section-padding-tb light-bg container">
	<div class="grid-container">
		<div uk-grid>
			
			<?php if ($events->have_posts()) :
				$count = 1;
				
					while ( $events->have_posts() ) {
						$events->the_post();
						$today = date("Y-m-d");

						$endDate = date_format( date_create(get_field('body_enddate')),"Y-m-d");
						if ($endDate > $today) {
							get_template_part( 'template-parts/content/content', 'event' );
						}
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





