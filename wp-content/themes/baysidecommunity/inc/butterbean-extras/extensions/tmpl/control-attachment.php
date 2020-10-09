<div class="butterbean-control butterbean-attachment">
	<input type="hidden" class="butterbean-attachment-id" name="{{ data.field_name }}" value="{{ data.value }}" />

	<label>
		<# if ( data.label ) { #>
			<span class="butterbean-label">{{ data.label }}</span>
		<# } #>

		<input type="text" class="widefat butterbean-attachment-filename" value="{{ data.filename }}" name="attachment_filename" />
	</label>

	<p>
		<button type="button" class="button button-secondary js-butterbean-attachment-add-media">{{ data.l10n.add_attachment }}</button>
		<button type="button" class="button button-secondary js-butterbean-attachment-remove">{{ data.l10n.remove }}</button>
	</p>
	
	<# if ( data.description ) { #>
		<span class="butterbean-description">{{{ data.description }}}</span>
	<# } #>
</div>