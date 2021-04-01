<?php
$bodyColor = get_query_var('themecolor');

$intro = get_field('body_intro'); 
$image_id = get_field('body_logo');
$image_header = wp_get_attachment_image_src($image_id, '460x300');

$catsObj = get_the_terms(get_the_ID(),'program_group');
$cats = json_decode(json_encode($catsObj), true);
?>
<!-- <div class="item program-card-outer <?php //foreach ($cats as  $cat) {echo " ".$cat['slug'];}?>"> -->
	<div class="program-card connect-program-card">
		<a  href="<?php echo get_permalink() ?>">
			<div class="image">
				<?php $url = $image_header[0]; ?>
				<?php if ($url) : ?>
					<img src="<?php echo $url ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>">
				<?php else : ?>
					<img src="https://via.placeholder.com/400x310" title="<?php the_title() ?>" alt="<?php the_title() ?>">
				<?php endif; ?>
			</div>
			<div class="content">
				<h4 class="blue"><?php the_title(); ?></h4>
				
				<p><?php the_field('body_intro');?></p>

				<div class="more-info-bottom">
					<div class="button more-info green">More Info</div>
					
				</div>
			</div>
        </a>   
	</div>
<!-- </div> -->