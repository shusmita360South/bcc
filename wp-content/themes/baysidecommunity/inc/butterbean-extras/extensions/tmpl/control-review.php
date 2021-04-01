<?php
function butterbean_review_template( $review_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( ! $values ) {
		$values = array(
			'image_src' => '',
			'image_id' => '',
			'iconid' => '',
			'heading' => '',
			'title' => '',
			'short_description' => ''
		);
	} 
					
					
	$choices = [
		"icon-meal" => "Meal",
		"icon-busket" => "Busket",
		"icon-hand" => "Hand"
	]; 				

	if ( $clonable ) {
		$class = 'butterbean-review-clonable';
	}

	?>
	<div class="butterbean-review <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-review-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-review-sortable-handle"><span class="-review-number"><?php echo $review_name; ?></span> - <span class="-review-title"><?php echo $values['heading']; ?></span></h2>

		<div class="inside">

			<span class="butterbean-label">{{ data.l10n.image }}</span>

			<input type="hidden" class="butterbean-img-id-input" value="<?php echo $values['image_id']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][image_id]" class="widefat" />

			<img class="butterbean-img" src="<?php echo $values['image_src']; ?>" />

			<div class="butterbean-img-wrap">
				<div class="butterbean-placeholder">{{ data.l10n.placeholder }}</div>

				<div class="butterbean-img-actions">
					<p class="butterbean-img-actions-with-image">
						<button type="button" class="button button-secondary butterbean-change-media">{{ data.l10n.change }}</button>
						<button type="button" class="button button-secondary butterbean-remove-media">{{ data.l10n.remove }}</button>
					</p>

					<p class="butterbean-img-actions-no-image">
						<button type="button" class="button button-secondary butterbean-add-media">{{ data.l10n.upload }}</button>
					</p>

					<br />
				</div>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.iconid }}</span>
					<select name="<?php echo $setting_name; ?>[<?php echo $index; ?>][iconid]" class="js-butterbean-review-iconid widefat" data-value="<?php echo $values['iconid']; ?>">
						<?php foreach ($choices as $value => $choice) : ?>
							<option value="<?php echo $value; ?>"><?php echo $choice; ?></option>
						<?php endforeach; ?>
					</select> 
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.heading }}</span>

					<textarea type="text" class="js-butterbean-review-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][heading]" /><?php echo $values['heading']; ?></textarea>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.title }}</span>

					<input type="text" class="js-butterbean-review-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][title]" value="<?php echo $values['title']; ?>"/>
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.short_description }}</span>

					<textarea type="text" class="js-butterbean-review-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][short_description]" /><?php echo $values['short_description']; ?></textarea>
				</label>
			</div>

			<br />
			<a class="js-butterbean-review-remove" href="#" class="delete">{{ data.l10n.remove_review }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new reviews

$review_name = '_review_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_review_template( $review_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-reviews">
	<?php // show the saved reviews ?>

	<# _.each( data.reviews, function( review, index ) { #>
		<?php
		$values = array(
			'image_id' => '{{ review.image_id }}',
			'image_src' => '{{ review.image_src }}',
			'iconid' => '{{ review.iconid }}',
			'heading' => '{{ review.heading }}',
			'title' => '{{ review.title }}',
			'short_description' => '{{ review.short_description }}'
		);

		butterbean_review_template( 'Block {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-review-add button button-primary">{{ data.l10n.add_review }}</button>