<?php
function butterbean_technology_template( $technology_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( ! $values ) {
		$values = array(
			'image_src' => '',
			'image_id' => '',
			//'iconid' => '',
			'heading' => '',
			'short_description' => ''
		);
	}

	$choices = [
		"icon-celltek" => "CellTek",
		"icon-enviroform" => "Enviroment Form",
		"icon-pocket" => "Pocket",
		"icon-zonetech" => "ZoneTech",
		"icon-getflow" => "GetFlow",
		
	]; 
					

	if ( $clonable ) {
		$class = 'butterbean-technology-clonable';
	}

	?>
	<div class="butterbean-technology <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-technology-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-technology-sortable-handle"><span class="-technology-number"><?php echo $technology_name; ?></span> - <span class="-technology-title"><?php echo $values['heading']; ?></span></h2>

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
			<!-- <div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.iconid }}</span>
					<select name="<?php echo $setting_name; ?>[<?php echo $index; ?>][iconid]" class="js-butterbean-technology-iconid widefat" data-value="<?php echo $values['iconid']; ?>">
						<?php foreach ($choices as $value => $choice) : ?>
							<option value="<?php echo $value; ?>"><?php echo $choice; ?></option>
						<?php endforeach; ?>
					</select> 
				</label>
			</div> -->
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.heading }}</span>

					<textarea type="text" class="js-butterbean-technology-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][heading]" /><?php echo $values['heading']; ?></textarea>
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.short_description }}</span>

					<textarea type="text" class="js-butterbean-technology-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][short_description]" /><?php echo $values['short_description']; ?></textarea>
				</label>
			</div>

			<br />
			<a class="js-butterbean-technology-remove" href="#" class="delete">{{ data.l10n.remove_technology }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new technologys

$technology_name = '_technology_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_technology_template( $technology_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-technologys">
	<?php // show the saved technologys ?>

	<# _.each( data.technologys, function( technology, index ) { #>
		<?php
		$values = array(
			'image_id' => '{{ technology.image_id }}',
			'image_src' => '{{ technology.image_src }}',
			//'iconid' => '{{ technology.iconid }}',
			'heading' => '{{ technology.heading }}',
			'short_description' => '{{ technology.short_description }}'
		);

		butterbean_technology_template( 'Block {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-technology-add button button-primary">{{ data.l10n.add_technology }}</button>