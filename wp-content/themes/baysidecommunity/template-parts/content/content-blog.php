<<<<<<< HEAD
<?php


$posttags = get_the_tags();

?>
<div class="program-card-outer uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l <?php foreach ($posttags as  $tag) {
          echo " ".$tag->slug;}?>">
	<div class="program-card blog-card">
		<a href="<?php the_permalink() ?>">
			<div class="image">
				<?php  if ( has_post_thumbnail() ):?>
					<?php the_post_thumbnail( '460x260' ); ?>	
				<?php else:?>
					<img src="/img/deafult-blog-list.png"/>
				<?php endif;?>
			</div>
			<div class="content">
				<h4><?php the_title(); ?></h4>
			
				<span class="blue blogdate"><i uk-icon="calendar"></i><?php echo get_the_date();?></span>
				<div class="intro">
					<?php the_excerpt();?>
				</div>
				<div class="more-info-bottom">
					<div class="button more-info">More Info</div>
				</div>
			</div>
        </a>    
	</div>
=======
<?php


$posttags = get_the_tags();
?>
<div class="program-card-outer uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l <?php 
if ($posttags) {
	foreach ($posttags as $tag) {
          echo " ".$tag->slug;
	};
}; ?>">
	<div class="program-card blog-card">
		<a href="<?php the_permalink() ?>">
			<div class="image">
				<?php  if ( has_post_thumbnail() ):?>
					<?php the_post_thumbnail( '460x260' ); ?>	
				<?php else:?>
					<img src="<?php echo get_site_url(); ?>/img/deafult-blog-list.png"/>
				<?php endif;?>
			</div>
			<div class="content">
				<h4><?php the_title(); ?></h4>
			
				<span class="blue blogdate"><i uk-icon="calendar"></i><?php echo get_the_date();?></span>
				<div class="intro">
					<?php the_excerpt();?>
				</div>
				<div class="more-info-bottom">
					<div class="button more-info">More Info</div>
				</div>
			</div>
        </a>    
	</div>
>>>>>>> fbdbbc5b7b10b3713902bcd556463e36c8e0b55b
</div>