<?php

?>
<div class="item event-card-outer uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l">
	<div class="event-card connect-group-card people-card">
		<div class="image">
			<?php the_post_thumbnail( '460x260' ); ?>	
		</div>
		<div class="content">
			
			<h4 class=""><?php the_title(); ?></h4>
			<p class="subtitle"><?php echo get_field('body_subtitle');?></p>
			
			<div class="intro">
				<?php echo get_field('body_bio');?>
			</div>
			<div class="more-info-bottom">
				<a href="tel:<?php echo get_field('body_phone');?>" class="uk-icon-button uk-margin-small-right" uk-icon="receiver"></a>
				<a href="mailto:<?php echo get_field('body_email');?>" class="uk-icon-button uk-margin-small-right" uk-icon="mail"></a>
				<a href="<?php echo get_field('body_linkedinlink');?>" class="uk-icon-button" uk-icon="linkedin"></a>

			</div>
		</div>
            
	</div>
</div>