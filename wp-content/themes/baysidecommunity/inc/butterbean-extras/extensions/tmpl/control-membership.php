<?php
function butterbean_membership_template( $membership_name, $setting_name, $index, $values = false, $clonable = false ) {
	$class = '';

	if ( ! $values ) {
		$values = array(
			'image_src' => '',
			'image_id' => '',
			'heading' => '',
			'price' => '',
			'short_description' => '',
			'service_id' => ''
		);
	}

	if ( $clonable ) {
		$class = 'butterbean-membership-clonable';
	}
	
	?>
	<div class="butterbean-membership <?php echo $class; ?>">
		<input type="hidden" class="index" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][index]" value="<?php echo $index; ?>" />

		<button type="button" class="js-butterbean-membership-handlediv handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="butterbean-membership-sortable-handle"><span class="-membership-number"><?php echo $membership_name; ?></span> - <span class="-membership-title"><?php echo $values['heading']; ?></span></h2>

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
					<span class="butterbean-label">{{ data.l10n.heading }}</span>

					<textarea type="text" class="js-butterbean-membership-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][heading]" /><?php echo $values['heading']; ?></textarea>
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.price }}</span>

					<input type="number" value="<?php echo $values['price']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][price]" class="widefat" />
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.short_description }}</span>

					<textarea type="text" class="js-butterbean-membership-title widefat" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][short_description]" /><?php echo $values['short_description']; ?></textarea>
				</label>
			</div>

			<div class="butterbean-control">
				<label>
					<span class="butterbean-label">{{ data.l10n.service_id }}</span>

					<input type="text" value="<?php echo $values['service_id']; ?>" name="<?php echo $setting_name; ?>[<?php echo $index; ?>][service_id]" class="widefat" />
				</label>
			</div>

			<br />
			<a class="js-butterbean-membership-remove" href="#" class="delete">{{ data.l10n.remove_membership }}</a>
		</div>
	</div>

	<?php
}
?>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<?php
// clonable template for new memberships

$membership_name = '_membership_name_';
$setting_name = '_setting_name_';
$index = '_index_';
$values = false;

butterbean_membership_template( $membership_name, $setting_name, $index, $values, 'clonable' );
?>

<div class="butterbean-memberships">
	<?php // show the saved memberships ?>

	<# _.each( data.memberships, function( membership, index ) { #>
		<?php
		$values = array(
			'image_id' => '{{ membership.image_id }}',
			'image_src' => '{{ membership.image_src }}',
			'heading' => '{{ membership.heading }}',
			'price' => '{{ membership.price }}',
			'short_description' => '{{ membership.short_description }}',
			'service_id' => '{{ membership.service_id }}'
		);

		butterbean_membership_template( 'Membership {{ index + 1 }}', '{{ data.name }}', '{{ index }}', $values );
		?>
	<# } ) #>
</div>

<button class="js-butterbean-membership-add button button-primary">{{ data.l10n.add_membership }}</button>