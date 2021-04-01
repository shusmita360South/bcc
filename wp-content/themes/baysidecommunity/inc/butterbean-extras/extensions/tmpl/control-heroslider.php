<div class="butterbean-heroslides">
	<# _.each( data.herosliders, function( heroslider, index ) { #>
		<div class="butterbean-heroslide <# if ( heroslider.index == -1 ) { #> butterbean-heroslide-clonable <# } #>">
			<# if ( heroslider.index == -1 ) { #>
				<input type="hidden" class="index" name="_setting_name_[_index_][index]" value="_index_" />
			<# } else { #>
				<input type="hidden" class="index" name="{{ data.name }}[{{ index }}][index]" value="{{ index }}" />
			<# } #>

			<button type="button" class="js-butterbean-heroslide-handlediv handlediv button-link" aria-expanded="true">
				<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
			</button>

			<# if ( heroslider.index == -1 ) { #>
				<h2 class="butterbean-heroslide-sortable-handle"><span class="-heroslide-number">_heroslide_name_</span></h2>
			<# } else { #>
				<h2 class="butterbean-heroslide-sortable-handle"><span class="-heroslide-number">Slide {{ index }}</span> - <span class="-heroslide-title">{{ heroslider.heading }}</span></h2>
			<# } #>

			<div class="inside">
				<div class="butterbean-control">
					<span class="butterbean-label">{{ data.l10n.image }}</span>

					<# if ( heroslider.index == -1 ) { #>
						<input type="hidden" class="butterbean-img-id-input" value="" name="_setting_name_[_index_][image_id]" class="widefat" />
					<# } else { #>
						<input type="hidden" class="butterbean-img-id-input" value="{{ heroslider.image_id }}" name="{{ data.name }}[{{ index }}][image_id]" class="widefat" />
					<# } #>
					
					<img class="butterbean-img" src="{{ heroslider.image_src }}" />

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
				</div>
				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.subheading }}</span>

						<# if ( heroslider.index == -1 ) { #>
							<input type="text" class="js-butterbean-heroslide-title widefat" value="" name="_setting_name_[_index_][subheading]" />
						<# } else { #>
							<input type="text" class="js-butterbean-heroslide-title widefat" value="{{ heroslider.subheading }}" name="{{ data.name }}[{{ index }}][subheading]" />
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.heading }}</span>

						<# if ( heroslider.index == -1 ) { #>
							<textarea type="text" class="js-butterbean-heroslide-title widefat" name="_setting_name_[_index_][heading]"></textarea>
						<# } else { #>
							<textarea type="text" class="js-butterbean-heroslide-title widefat" name="{{ data.name }}[{{ index }}][heading]">{{ heroslider.heading }}</textarea>
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.button_link }}</span>
						
						<# if ( heroslider.index == -1 ) { #>
							<select class="butterbean-heroslide-select widefat" name="_setting_name_[_index_][button_link]">
								<option value="0">- None -</option>
								<# _.each( data.choices, function( choices, index ) { #>
									<optgroup label="{{ index }}">
										<# _.each( choices, function( label, value ) { #>
											<option value="{{ value }}">{{ label }}</option>
										<# } ) #>
									</optgroup>
								<# } ) #>
							</select>
							<span class="butterbean-description">{{{ data.l10n.notice }}}</span>
						<# } else { #>
							<select class="butterbean-heroslide-select widefat" name="{{ data.name }}[{{ index }}][button_link]">
								<option value="0">- None -</option>
								<# _.each( data.choices, function( choices, index ) { #>
									<optgroup label="{{ index }}">
										<# _.each( choices, function( label, value ) { #>
											<option value="{{ value }}" <# if ( heroslider.button_link == value ) { #> selected="selected" <# } #>>{{ label }}</option>
										<# } ) #>
									</optgroup>
								<# } ) #>
							</select>
						<# } #>
					</label>
				</div>
				
				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.button_external_link }}</span>

						<# if ( heroslider.index == -1 ) { #>
							<input type="text" value="{{ heroslider.button_external_link }}" name="_setting_name_[_index_][button_external_link]" class="widefat" />
						<# } else { #>
							<input type="text" value="{{ heroslider.button_external_link }}" name="{{ data.name }}[{{ index }}][button_external_link]" class="widefat" />
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.heroslide_color }}</span>

						<# if ( heroslider.index == -1 ) { #>
							<input type="text" value="{{ heroslider.heroslide_color }}" name="_setting_name_[_index_][heroslide_color]" class="widefat" />
						<# } else { #>
							<input type="text" value="{{ heroslider.heroslide_color }}" name="{{ data.name }}[{{ index }}][heroslide_color]" class="widefat" />
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.button_text }}</span>

						<# if ( heroslider.index == -1 ) { #>
							<input type="text" value="{{ heroslider.button_text }}" name="_setting_name_[_index_][button_text]" class="widefat" />
						<# } else { #>
							<input type="text" value="{{ heroslider.button_text }}" name="{{ data.name }}[{{ index }}][button_text]" class="widefat" />
						<# } #>
					</label>
				</div>

				<br />
				<a class="js-butterbean-heroslide-remove" href="#" class="delete">{{ data.l10n.remove_heroslide }}</a>
			</div>
		</div>
	<# } ) #>

	<# if ( data.description ) { #>
		<span class="butterbean-description">{{{ data.description }}}</span>
	<# } #>
</div>

<button class="js-butterbean-heroslide-add button button-primary">{{ data.l10n.add_heroslide }}</button>