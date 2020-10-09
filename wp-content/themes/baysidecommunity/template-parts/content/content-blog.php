<?php


$posttags = get_the_tags();

?>
<div class="event-card-outer uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l <?php foreach ($posttags as  $tag) {
          echo " ".$tag->slug;}?>">
	<div class="event-card blog-card">
		<div class="image">
			<?php the_post_thumbnail( '460x260' ); ?>	
		</div>
		<div class="content">
			<h4><?php the_title(); ?></h4>
		
			<div class="info">
				
				<span class="blue"><i uk-icon="calendar"></i><?php echo get_the_date();?></span>
			</div>
			<div class="intro">
				<?php the_excerpt();?>
			</div>
			<div class="more-info-bottom">
				<a href="<?php the_permalink() ?>" class="button more-info">More Info</a>
			</div>
		</div>
            
	</div>
</div>