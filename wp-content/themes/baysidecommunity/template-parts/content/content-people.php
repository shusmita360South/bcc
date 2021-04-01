<?php

?>
<div class="item program-card-outer uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l">
	<div class="program-card connect-group-card people-card">
		<div class="image">
			<?php  if ( has_post_thumbnail() ):?>
				<?php the_post_thumbnail( '300x300' ); ?>	
			<?php else:?>
				<img src="/img/site/default-300x300.png"/>
			<?php endif;?>	
		</div>
		<div class="content">
			
			<h4 class=""><?php the_title(); ?></h4>
			<p class="subtitle"><?php echo get_field('body_subtitle');?></p>
			
			<div class="intro">
				<?php echo get_field('body_bio');?>
				<?php if(get_field('body_biolong')):?>
					<a href="#people-popup-<?php echo get_the_id(); ?>" uk-toggle class="button more-info uk-margin-small-top">More Info</a>
				<?php endif;?>
			</div>
			<div class="more-info-bottom">
				<?php if(get_field('body_phone')):?>
					<a href="tel:<?php echo get_field('body_phone');?>" class="uk-icon-button uk-margin-small-right" uk-icon="receiver"></a>
				<?php endif;?>
				<?php if(get_field('body_email')):?>
					<a href="mailto:<?php echo get_field('body_email');?>" class="uk-icon-button uk-margin-small-right" uk-icon="mail"></a>
				<?php endif;?>
				<?php if(get_field('body_linkedinlink')):?>
					<a href="<?php echo get_field('body_linkedinlink');?>" class="uk-icon-button" uk-icon="linkedin"></a>
				<?php endif;?>

			</div>
		</div>
            
	</div>
</div>

<!-- This is the modal with the default close button -->
<div id="people-popup-<?php echo get_the_id(); ?>" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h3 class="uk-modal-title"><?php the_title(); ?></h3>
        <p><?php echo get_field('body_biolong');?></p>
    </div>
</div>

