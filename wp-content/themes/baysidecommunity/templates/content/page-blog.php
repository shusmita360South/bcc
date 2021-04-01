<?php
/**
 * Template part for displaying service
 *
 *
 * @package WordPress
 * @subpackage Comfort_Sleep
 * @since 1.0.0
 */

//$image_id = get_field('body_logo');
//$image_header = wp_get_attachment_image_src($image_id, '700x300');
$bodyColor = get_field('_body_color');
$videoLink = get_field('_body_videolink');

$term = get_queried_object();
//print_r($term );
$pageTitle = "Blog";
$post_type = $term->post_type;
if ($post_type == "messages") {
	$pageTitle = "Messages";
}
if ($post_type == "post") {
	$pageTitle = "Blog";
}

	$blogHeaderImageUrl = get_option('event_header_image');
	$blogHeaderImageId = attachment_url_to_postid($blogHeaderImageUrl);

	$blogHeader = wp_get_attachment_image_src($blogHeaderImageId, '1920x420');

	$taxonomy = get_the_terms(get_the_id(),'category');

	$taxonomy_image_url = z_taxonomy_image_url($taxonomy[0]->term_id, '1920x420'); 
?>

<section class="connect-item theme-<?php echo $bodyColor;?>">
	<section class="page-banner">	
		<div class="page-banner-image">				
			<figure>
				<?php if ($post_type == "messages") :?>
					<?php the_post_thumbnail( '1920x420' ); ?>	
				<?php endif;?>
				<?php if ($post_type == "post") :?>
					<img src="<?php echo $taxonomy_image_url;?>" alt="<?php the_title() ?>">	
				<?php endif;?>
			</figure>	
		</div>
		<div class="page-banner-content">		
			<h1 class=""><?php echo $pageTitle;?></h1>
		</div>
	</section>
	
	<section class="block-1 page-content section-padding-tb ">
		<div class="grid-container-small">
			<div class="block-1-inner justify-left">
				
				<?php 
				$posttags = get_the_tags();
				if ($posttags) :
				  	foreach($posttags as $tag) :?>
				    	<span class="tag blue-light-bg blue"><?php echo $tag->name;?></span>
					<?php endforeach;?>
				<?php endif;?>
				<h2 class="<?php echo $bodyColor;?> uk-margin-small-top"><?php the_title();?></h2>
				<p class="blogdate"><i class="" uk-icon="calendar"></i><?php echo get_the_date();?> Hits:<?php echo getBaysidecommunityPostViews(get_the_ID());?></p>
				<?php the_content() ?>

				<?php 

				$authorId = get_field('author_info');
				$author = get_author($authorId);
				

				

				?>
				<?php 
				/* 	BLOG POST AUTHOR - REMOVED
				if ($author->have_posts()) :
					$count = 1;
					
						while ( $author->have_posts() ) {
							set_query_var('themecolor', $bodyColor);
							$author->the_post();
							get_template_part( 'template-parts/content/content', 'leader' );
							$author_email = get_field('body_email');
						}
						wp_reset_postdata(); 
				endif; 
				*/
				?>

				<?php if(isset($videoLink) && $videoLink!=""):
					$videoID = str_replace("https://youtu.be/","",$videoLink);
					?>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe src="https://www.youtube.com/embed/<?php echo $videoID;?>" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" class="embed-responsive-item" frameborder="0"></iframe>
				</div>
				<?php endif;?>

				

				<h2 class="section-padding-top">Share Us</h2>
				<div class="social-icon ">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['REQUEST_URI'];?>" target="_blank"><span class="icon-outer blue-bg"><i uk-icon="icon: facebook"></i></span></a>
				
					<a href="mailto:<?php echo get_option('contact_email'); ?>?subject=<?php echo $pageTitle; ?>&amp;body=<?php echo $_SERVER['REQUEST_URI'];?>"><span class="icon-outer blue-bg"><i uk-icon="icon: mail"></i></span></a>
					
				</div>

				<?php

				/**
				 *  Output comments wrapper if it's a post, or if comments are open,
				 * or if there's a comment number – and check for password.
				 * */
				/* 	BLOG POST COMMENT SECTION - REMOVED 
				if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
					?>

					<div class="comments-wrapper section-inner uk-margin-medium-top">

						<?php comments_template(); ?>

					</div><!-- .comments-wrapper -->

					<?php
				} */
				?>
			</div>
		</div>
	</section>

</section>


<section class="block-1 center section-padding-tb question-bg">
	<div class="grid-container-small">
		<div class="block-1-inner">
			<h2 class="white">Questions?</h2>
			<p class="white short-desc">Our team would love to help! Please feel free to contact us if you need further information about any of our services, groups or facilities.</p>
			<a class="button btn-white uk-margin-medium-top" href="/contact-us/">Contact Us</a>
		</div>
	</div>
</section>
