<?php
$image_id = get_field('_body_image');
$image_header = wp_get_attachment_image_src($image_id, '460x260');
?>
<div class="item event-card-outer uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l">
	<div class="event-card connect-group-card message-card gallery-card">
		<a class="" href="<?php echo get_permalink();?>">
			<div class="image">
				<img src="<?php echo $image_header[0]  ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>">
			</div>
			<div class="content">
				
				<h4 class=""><?php the_title(); ?></h4>
				<p><?php the_field('_body_intro'); ?></p>
				<div class="more-info-bottom">
					<span class="blue" href="<?php echo get_the_permalink() ?>" class="button more-info">More Info</span>
					
				</div>
			</div>
		</a>
            
	</div>
</div>