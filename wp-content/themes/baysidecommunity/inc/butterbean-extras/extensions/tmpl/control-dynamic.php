<?php
function butterbean_dynamic_template( $dynamic_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( ! $values ) {
		$values = array(
			'image_src' => '',
			'image_id' => '',
			'videoid' => '',
			'heading' => '',
			'short_description' => ''
		);
	}

	if ( $clonable ) {
		$class = 'butterbean-dynamic-clonable';
	}

	?>
	<div class="butterbean-dynamic <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-dynamic-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-dynamic-sortable-handle"><span class="-dynamic-number"><?php echo $dynamic_name; ?></span> - <span class="-dynamic-title"><?php echo $values['heading']; ?></span></h2>

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
					<span class="butterbean-label">{{ data.l10n.videoid }}</span>

					<input type="text" class="js-butterbean-dynamic-videoid widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][videoid]" value="<?php echo $values['videoid']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.heading }}</span>

					<textarea type="text" class="js-butterbean-dynamic-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][heading]" /><?php echo $values['heading']; ?></textarea>
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.short_description }}</span>

					<textarea type="text" class="js-butterbean-dynamic-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][short_description]" /><?php echo $values['short_description']; ?></textarea>
				</label>
			</div>

			<br />
			<a class="js-butterbean-dynamic-remove" href="#" class="delete">{{ data.l10n.remove_dynamic }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new dynamics

$dynamic_name = '_dynamic_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_dynamic_template( $dynamic_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-dynamics">
	<?php // show the saved dynamics ?>

	<# _.each( data.dynamics, function( dynamic, index ) { #>
		<?php
		$values = array(
			'image_id' => '{{ dynamic.image_id }}',
			'image_src' => '{{ dynamic.image_src }}',
			'videoid' => '{{ dynamic.videoid }}',
			'heading' => '{{ dynamic.heading }}',
			'short_description' => '{{ dynamic.short_description }}'
		);

		butterbean_dynamic_template( 'Block {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-dynamic-add button button-primary">{{ data.l10n.add_dynamic }}</button>