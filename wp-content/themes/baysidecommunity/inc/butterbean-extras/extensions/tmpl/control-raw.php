<label>
	<# if ( data.label ) { #>
		<span class="butterbean-label">{{ data.label }}</span><br />
	<# } #>

	<textarea {{{ data.attr }}} style="width: 100%;" rows="7">{{{ data.value }}}</textarea>

	<# if ( data.description ) { #>
		<span class="butterbean-description">{{{ data.description }}}</span>
	<# } #>
</label>
