<div>
	<label>
		<# if ( data.label ) { #>
			<span class="butterbean-label">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="butterbean-description">{{{ data.description }}}</span>
		<# } #>

		<input class="butterbean-location" type="{{ data.type }}" value="{{ data.value }}" style="width: 100%" {{{ data.attr }}} />
	</label>

	<button type="button" class="button button-secondary js-butterbean-generate-lat-long" style="margin: 10px 0">{{ data.l10n.generate }}</button>

	<label>
		<# if ( data.label ) { #>
			<span class="butterbean-label">{{ data.label }} {{ data.l10n.latitude }}</span>
		<# } #>

		<input class="butterbean-location-lat" type="text" value="{{ data.lat }}" name="{{ data.lat_input_name }}" />
	</label>

	<label>
		<# if ( data.label ) { #>
			<span class="butterbean-label">{{ data.label }} {{ data.l10n.longitude }}</span>
		<# } #>

		<input class="butterbean-location-long" type="text" value="{{ data.long }}" name="{{ data.long_input_name }}" />
	</label>
</div>
