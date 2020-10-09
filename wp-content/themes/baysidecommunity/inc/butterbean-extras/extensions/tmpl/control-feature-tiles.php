<?php
function butterbean_feature_tiles_template( $tile_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( $clonable ) {
		$class = 'butterbean-tile-clonable';
	}

	if ( ! $values ) {
		$values = array(
			'image_id' => '',
			'image_src' => '',
			'title' => '',
			'link' => '',
		);
	}
	?>

	<div class="butterbean-tile <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-tile-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-tile-sortable-handle"><span><?php echo $tile_name; ?></span></h2>

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

			<label>
				<span class="butterbean-label">{{ data.l10n.title }}</span>

				<input type="text" value="<?php echo $values['title']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][title]" class="widefat" />
			</label>

			<label>
				<span class="butterbean-label">{{ data.l10n.link }}</span>

				<input type="text" value="<?php echo $values['link']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][link]" class="widefat" />
			</label>

			<br />
			<a class="js-butterbean-tile-remove" href="#" class="delete">{{ data.l10n.remove_tile }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new tiles

$tile_name = '_tile_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_feature_tiles_template( $tile_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-tiles">
	<?php // show the saved tiles ?>

	<# _.each( data.tiles, function( tile, index ) { #>
		<?php
		$values = array(
			'image_id' => '{{ tile.image_id }}',
			'image_src' => '{{ tile.image_src }}',
			'title' => '{{ tile.title }}',
			'link' => '{{ tile.link }}',
		);

		butterbean_feature_tiles_template( 'Tile {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>


<button class="js-butterbean-tile-add button button-primary">{{ data.l10n.add_tile }}</button>
