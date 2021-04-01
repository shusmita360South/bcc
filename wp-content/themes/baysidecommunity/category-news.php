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

	
	$taxonomy_image_url = z_taxonomy_image_url($term_id, '1920x420'); 

	
	$tax_query = array();
	$keyword = "";
	if (isset($_GET["keyword"])) {
		$keyword =$_GET["keyword"];
	}
	if (isset($_GET["pg-num"])) {
		echo $_GET["pg-num"];
	}
	
	$filterTag = "";
	if (isset($_GET["btag"])) {

		$filterTag = array(
			'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => $_GET["btag"],
		);
		array_push($tax_query,$filterTag);
	} 
	if (isset($_GET["topic"])) {
		$filterTopic = $_GET['topic'];
		$filterTopicArry = array(
			'taxonomy' => 'post_topic',
            'field' => 'term_id',
            'terms' => $_GET["topic"],
		);
		array_push($tax_query,$filterTopicArry);
		
	}
	$big = 999999999; 
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	$post_query = new WP_Query( array(
		'post_type' => 'post', 
		'posts_per_page' => 12,
		'paged' => $paged,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'order' => 'DESC', // 'ASC'
		'orderby' => 'date', // modified | title | name | ID | rand
	    'tax_query' => $tax_query,
	    's'			=> $keyword
	    
	) );
	$currentUrl = home_url( add_query_arg( array(), $wp->request ) );
?>

<?php 
$tags = get_tags();


?>


<section class="page-banner container">	
	<div class="page-banner-image">				
		<figure>
			<img src="<?php echo $taxonomy_image_url;?>" alt="<?php the_title() ?>">
		</figure>	
	</div>
	<div class="page-banner-content">		
		<h1 class="">News</h1>
	</div>
</section>
<section class="filter-btn-outer blog-filter dark-bg container">
	<div class="grid-container">
		<div uk-grid id="filter-btn">
			
	      	<div class="uk-width-auto">
	        <?php 
	          $allTags['slug'] = array();
	          $allTags['title'] = array();
	        
	          
	            $tagsObj =  get_tags();
				$tags = json_decode(json_encode($tagsObj), true);
	            foreach ($tags as  $tag) {
	              array_push($allTags['slug'],$tag['term_id']);
	              array_push($allTags['title'],$tag['name']);
	            }
	            

	          
	         
	        ?>
		        <div class="select-outer">
		          	<select id="blog-tag-select" class="filter-select uk-select filter-select-tag">
			            <option value="" selected="selected">All Tags</option>
			            <?php foreach ($allTags['slug'] as $key=>$allTag): ?>
			              <option value="<?php echo $allTags['slug'][$key];?>"><?php echo $allTags['title'][$key];?></option>
			            <?php endforeach;?>
		          	</select>
		        </div>
	      	</div>
	      	
	      	<div class="uk-width-auto">
	      		<div class="input-outer">
	      			<input class="uk-input filter-select-keyword-input" placeholder="Search..." name="keyword" value=""/><span uk-icon="icon: search" class="filter-select-keyword"></span>

	      		</div>
	      	</div>
	      	
	    </div>
	    
	</div>
</section>
<section class="blogs-archive section-padding-tb light-bg container">
	<div class="grid-container">
		<div uk-grid id='blogList'>
			
			
			<?php
				if ( $post_query->have_posts() ):
					// Load podcast loop.
					while ( $post_query->have_posts() ) {
						$post_query->the_post();
						get_template_part( 'template-parts/content/content', 'blog' );
						
					 }
				
				
				?>
				<div id="pagination-outer" class="uk-margin-medium-top">
					<div id="pagination" >
					<?php echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $post_query->max_num_pages
                            ) );	?>
					
					</div>
				</div>	
				<?php	wp_reset_postdata(); 
				else:
					echo '<p>'.__('Sorry, no posts matched your criteria.').'</p>';
				endif;
				?>
				
		</div>		
	</div>		
		
</section>

<section class="block-1 center section-padding-tb subscribe-bg">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<h2 class="white">Subscribe to our Newsletter</h2>
			
			<form action="//baysidechurch.us7.list-manage.com/subscribe/post?u=61c4df35245596836679fc55e&amp;id=5bbbe1b0e5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate uk-margin-medium-top" target="_blank" novalidate="novalidate">
				
		        <input name="FNAME" id="mce-FNAME" class="uk-input" type="text" placeholder="Name">

		        <input type="email" value="" name="EMAIL" class="required email uk-input" id="mce-EMAIL" aria-required="true" placeholder="Email"/>

		        <div id="mce-responses" class="clear">
					<div class="response red" id="mce-error-response" style="display:none"></div>
					<div class="response white" id="mce-success-response" style="display:none"></div>
				</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_61c4df35245596836679fc55e_5bbbe1b0e5" tabindex="-1" value=""></div>
			    <div class="clear uk-margin-medium-top"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
		    </form>
		</div>
	</div>
</section>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer();?>

<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>



