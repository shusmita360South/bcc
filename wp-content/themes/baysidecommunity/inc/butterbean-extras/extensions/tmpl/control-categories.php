<# if ( data.label ) { #>
	<span class="butterbean-label">{{ data.label }}</span>
<# } #>

<# if ( data.description ) { #>
	<span class="butterbean-description">{{{ data.description }}}</span>
<# } #>

<p>
	Select categories to be displayed on this page:
</p>

<select class="js-categories-select">
	<option value="">Select a Category</option>

	<# _.each( data.categories, function( categoryId, label ) { #>
		<option value="{{ categoryId }}">{{ label }}</option>
	<# } ) #>
</select>

<br />

<h3>Selected:</h3>

<ul class="js-categories-chosen">
	<# _.each( data.chosen_categories, function( categoryId, label ) { #>
		<li data-id="{{ categoryId }}">
			{{ label }}
			<span class="js-category-remove">
				<span class="dashicons dashicons-no-alt"></span>
			</span>
		</li>
	<# } ) #>
</ul>

<br /><br /><br />
<input class="js-categories-input" type="hidden" {{{ data.attr }}} value="{{ data.value }}" />
