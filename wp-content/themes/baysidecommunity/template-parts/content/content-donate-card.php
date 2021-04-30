<?php

?>

	<div class="item uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-4@l tithely-give-btn" data-church-id="2819412" data-action="Donate" data-giving-to="Bayside Community Care" data-amount="<?php echo get_field('body_donate_amount');?>">
		<div class="program-card donate-card">
			<div class="donate-card-heading">
				<h3>
					<?php the_title(); ?>
				</h3>
			</div>
			<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="">
			<div class="content">				
				<?php the_content();?>
			</div>
		</div>
	</div>



