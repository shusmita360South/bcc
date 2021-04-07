<?php
function butterbean_multilocation_template( $multilocation_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( ! $values ) {
		$values = array(
			'heading' => '',
			'date' => '',
			'datetext' => '',
			'address' => '',
			'starttime' => '',
			'endtime' => ''
		);
	}

	if ( $clonable ) {
		$class = 'butterbean-multilocation-clonable';
	}

	?>
	<div class="butterbean-multilocation <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-multilocation-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-multilocation-sortable-handle"><span class="-multilocation-number"><?php echo $multilocation_name; ?></span> - <span class="-multilocation-title"><?php echo $values['heading']; ?></span></h2>

		<div class="inside">

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.heading }}</span>

					<input type="text" class="js-butterbean-multilocation-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][heading]"  value="<?php echo $values['heading']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.date }}</span>

					<input type="text" class="datepicker js-butterbean-multilocation-date widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][date]" value="<?php echo $values['date']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.datetext }}</span>

					<input type="text" class="datetextpicker js-butterbean-multilocation-datetext widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][datetext]" value="<?php echo $values['datetext']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.address }}</span>

					<input type="text" class="addresspicker js-butterbean-multilocation-address widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][address]" value="<?php echo $values['address']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.starttime }}</span>

					<input type="text" class="js-butterbean-multilocation-starttime widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][starttime]" value="<?php echo $values['starttime']; ?>"/>
				</label>
			</div>
			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.endtime }}</span>

					<input type="text" class="js-butterbean-multilocation-endtime widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][endtime]" value="<?php echo $values['endtime']; ?>"/>
				</label>
			</div>
			

			<br />
			<a class="js-butterbean-multilocation-remove" href="#" class="delete">{{ data.l10n.remove_multilocation }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new multilocations

$multilocation_name = '_multilocation_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_multilocation_template( $multilocation_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-multilocations">
	<?php // show the saved multilocations ?>

	<# _.each( data.multilocations, function( multilocation, index ) { #>
		<?php
		$values = array(

			'heading' => '{{ multilocation.heading }}',
			'date' => '{{ multilocation.date }}',
			'datetext' => '{{ multilocation.datetext }}',
			'address' => '{{ multilocation.address }}',
			'starttime' => '{{ multilocation.starttime }}',
			'endtime' => '{{ multilocation.endtime }}'
			
		);

		butterbean_multilocation_template( 'Location {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-multilocation-add button button-primary">{{ data.l10n.add_multilocation }}</button>