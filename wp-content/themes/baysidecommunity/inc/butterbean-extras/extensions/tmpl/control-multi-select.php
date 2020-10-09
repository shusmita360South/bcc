<label>

	<# if ( data.label ) { #>
		<span class="butterbean-label">{{ data.label }}</span>
	<# } #>

	<# if ( data.description ) { #>
		<span class="butterbean-description">{{{ data.description }}}</span>
	<# } #>

	<select multiple name="{{ data.input_name }}">

		<# _.each( data.choices, function( label, choice ) { #>

			<option value="{{ choice }}" <# if ( -1 !== data.value.indexOf( choice ) ) { #> selected="selected" <# } #>>{{ label }}</option>

		<# } ) #>

	</select>
</label>
