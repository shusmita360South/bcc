<?php

$image_id = get_field('body_logo');
$image_header = wp_get_attachment_image_src($image_id, '460x260');
$locations = get_field('body_location');
?>
<div uk-grid class="uk-grid-small">
	<div class="uk-width-1-3">

		<div class="image">
			<?php $url = $image_header[0]; ?>
			<?php if ($url) : ?>
				<img src="<?php echo $url ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>">
			<?php else : ?>
				<img src="https://via.placeholder.com/400x310" title="<?php the_title() ?>" alt="<?php the_title() ?>">
			<?php endif; ?>
		</div>
	</div>
	<div class="uk-width-2-3">
		<div class="content">
			<div class="content-inner">
				<span class="date"><?php echo date_format( date_create(get_field('body_startdate')),"D d M");?></span>
				<p><?php the_title(); ?></p>
				
			</div>
		</div>
            
	</div>
</div>