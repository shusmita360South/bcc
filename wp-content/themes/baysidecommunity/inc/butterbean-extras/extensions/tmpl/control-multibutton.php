<?php
function butterbean_multibutton_template( $multibutton_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';
	if ( ! $values ) {
		$values = array(
			'buttontext' => '',
			'buttonlink' => ''
		);
	}

	if ( $clonable ) {
		$class = 'butterbean-multibutton-clonable';
	}

	?>
	<div class="butterbean-multibutton <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-multibutton-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-multibutton-sortable-handle"><span class="-multibutton-number"><?php echo $multibutton_name; ?></span> - <span class="-multibutton-title"><?php echo $values['buttontext']; ?></span></h2>

		<div class="inside">

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.buttontext }}</span>

					<input type="text" class="js-butterbean-multibutton-buttontext widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][buttontext]" value="<?php echo $values['buttontext']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.buttonlink }}</span>

					<input type="text" class="js-butterbean-multibutton-buttonlink widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][buttonlink]" value="<?php echo $values['buttonlink']; ?>"/>
				</label>
			</div>


			<br />
			<a class="js-butterbean-multibutton-remove" href="#" class="delete">{{ data.l10n.remove_multibutton }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new multibuttons

$multibutton_name = '_multibutton_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_multibutton_template( $multibutton_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-multibuttons">
	<?php // show the saved multibuttons ?>

	<# _.each( data.multibuttons, function( multibutton, index ) { #>
		<?php
		$values = array(
			'buttontext' => '{{ multibutton.buttontext }}',
			'buttonlink' => '{{ multibutton.buttonlink }}'
		);

		butterbean_multibutton_template( 'Shop Online Button {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-multibutton-add button button-primary">{{ data.l10n.add_multibutton }}</button>