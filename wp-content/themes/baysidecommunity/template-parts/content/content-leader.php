<?php
$bodyColor = $themecolor; 



?>
<div class="item-leader center uk-margin-medium-top">
	<div class="">
		<div class="image">
			<?php the_post_thumbnail( '300x300' ); ?>	
		</div>
		<div class="content">
			<div class="content-inner">
				<p class="title <?php echo $bodyColor;?>"><?php the_title(); ?></p>
				<p><?php echo get_field('body_subtitle'); ?></p>
			</div>
		</div>
            
	</div>
</div>