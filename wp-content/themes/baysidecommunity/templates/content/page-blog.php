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

?>

<section class="connect-item theme-<?php echo $bodyColor;?>">
	<section class="page-banner">	
		<div class="page-banner-image">				
			<figure>
				<?php the_post_thumbnail( '1920x420' ); ?>	
			</figure>	
		</div>
		<div class="page-banner-content">		
			<h1 class="">Blog</h1>
		</div>
	</section>
	
	<section class="block-1 page-content section-padding-tb ">
		<div class="grid-container-small">
			<div class="block-1-inner center">
				
				<?php 
				$posttags = get_the_tags();
				if ($posttags) :
				  	foreach($posttags as $tag) :?>
				    	<span class="tag blue-light-bg blue"><?php echo $tag->name;?></span>
					<?php endforeach;?>
				<?php endif;?>
				<h2 class="<?php echo $bodyColor;?> uk-margin-small-top"><?php the_title();?></h2>
				<p class="blogdate"><i class="" uk-icon="calendar"></i><?php echo get_the_date();?></p>
				<?php the_content() ?>

				<?php 

				$authorId = get_field('author_info');
				$author = get_author($authorId);
				
				?>
				<?php if ($author->have_posts()) :
					$count = 1;
					
						while ( $author->have_posts() ) {
							set_query_var('themecolor', $bodyColor);
							$author->the_post();
							get_template_part( 'template-parts/content/content', 'leader' );
						}
						wp_reset_postdata(); 
				endif;?>

				<h2 class="section-padding-top">Share Us</h2>
				<div class="social-icon ">

					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['REQUEST_URI'];?>" target="_blank"><span class="icon-outer blue-bg"><i uk-icon="icon: facebook"></i></span></a>
				
					<a href="mailto:?subject=<?php echo $item->title ?>&amp;body=<?php echo $_SERVER['REQUEST_URI'];?>"><span class="icon-outer blue-bg"><i uk-icon="icon: mail"></i></span></a>
					
				</div>
			</div>
		</div>
	</section>

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