<?php
function butterbean_pin_template( $pin_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( ! $values ) {
		$values = array(
			'pos_x' => 0,
			'pos_y' => 0,
			'icon_id' => '',
			'icon_src' => '',
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
		"icon-knit" => "Knit",
		
		
	]; 
					

	if ( $clonable ) {
		$class = 'butterbean-pin-clonable';
	}

	?>
	<div class="butterbean-pin <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-pin-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-pin-sortable-handle"><span class="-pin-number"><?php echo $pin_name; ?></span> - <span class="-pin-title"><?php echo $values['heading']; ?></span></h2>

		<div class="inside">
			<input type="hidden" class="butterbean-pos-x-input" value="<?php echo $values['pos_x']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][pos_x]" />
			
			<input type="hidden" class="butterbean-pos-y-input" value="<?php echo $values['pos_y']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][pos_y]" />

			<input type="hidden" class="butterbean-icon-id-input" value="<?php echo $values['icon_id']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][icon_id]" class="widefat" />

			<img class="butterbean-img butterbean-icon-src" src="<?php echo $values['icon_src']; ?>" />

			<div class="butterbean-img-wrap">
				<div class="butterbean-placeholder">{{ data.l10n.icon_id }}</div>

				<div class="butterbean-img-actions">
					<p class="butterbean-img-actions-with-image">
						<button type="button" class="button button-secondary butterbean-change-media-icon">{{ data.l10n.change }}</button>
						<button type="button" class="button button-secondary butterbean-remove-media-icon">{{ data.l10n.remove }}</button>
					</p>

					<p class="butterbean-img-actions-no-image">
						<button type="button" class="button button-secondary butterbean-add-media-icon">{{ data.l10n.upload }}</button>
					</p>

					<br />
				</div>
			</div>
			
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.heading }}</span>

					<textarea type="text" class="js-butterbean-pin-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][heading]" /><?php echo $values['heading']; ?></textarea>
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.short_description }}</span>

					<textarea type="text" class="js-butterbean-pin-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][short_description]" /><?php echo $values['short_description']; ?></textarea>
				</label>
			</div>

			<br />
			<a class="js-butterbean-pin-remove" href="#" class="delete">{{ data.l10n.remove_pin }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new pins

$pin_name = '_pin_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_pin_template( $pin_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-pin-image">
	<span class="butterbean-label">{{ data.l10n.image }}</span>

	<input type="hidden" class="butterbean-img-id-input" value="{{ data.img_id }}" name="{{ data.name }}_image" class="widefat" />

	<div class="butterbean-pin-image-container" id="butterbean-pin-image-container">
		<img class="butterbean-img-src" src="{{ data.img_src }}" />

		<# _.each( data.pins, function( pin, index ) { #>
			<div class="target-pin" style="left: {{ pin.pos_x }}px; top: {{ pin.pos_y }}px;"></div>
		<# } ) #>
	</div>

	<div class="butterbean-img-wrap">
		<# if ( ! data.img_src ) { #>
			<div class="butterbean-placeholder">{{ data.l10n.placeholder }}</div>
		<# } #>
		
		<div class="butterbean-img-actions">
			<# if ( data.img_src ) { #>
				<p class="butterbean-img-actions-with-image">
					<button type="button" class="button button-secondary butterbean-change-media">{{ data.l10n.change }}</button>
					<button type="button" class="button button-secondary butterbean-remove-media">{{ data.l10n.remove }}</button>
				</p>
			<# } #>

			<# if ( ! data.img_src ) { #>
				<p class="butterbean-img-actions-no-image">
					<button type="button" class="button button-secondary butterbean-add-media">{{ data.l10n.upload }}</button>
				</p>
			<# } #>

			<br />
		</div>
	</div>
</div>

<div class="butterbean-pins">
	<?php // show the saved pins ?>

	<# _.each( data.pins, function( pin, index ) { #>
		<?php
		$values = array(
			'pos_x' => '{{ pin.pos_x }}',
			'pos_y' => '{{ pin.pos_y }}',
			'icon_id' => '{{ pin.icon_id }}',
			'icon_src' => '{{ pin.icon_src }}',
			'heading' => '{{ pin.heading }}',
			'short_description' => '{{ pin.short_description }}'
		);

		butterbean_pin_template( 'Pin {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-pin-add button button-primary">{{ data.l10n.add_pin }}</button>