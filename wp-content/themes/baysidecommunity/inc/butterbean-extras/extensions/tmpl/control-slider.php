<div class="butterbean-slides">
	<# _.each( data.sliders, function( slider, index ) { #>
		<div class="butterbean-slide <# if ( slider.index == -1 ) { #> butterbean-slide-clonable <# } #>">
			<# if ( slider.index == -1 ) { #>
				<input type="hidden" class="index" name="_setting_name_[_index_][index]" value="_index_" />
			<# } else { #>
				<input type="hidden" class="index" name="{{ data.name }}[{{ index }}][index]" value="{{ index }}" />
			<# } #>

			<button type="button" class="js-butterbean-slide-handlediv handlediv button-link" aria-expanded="true">
				<span class="screen-reader-text">{{ data.l10n.toggle_panel }}</span><span class="toggle-indicator" aria-hidden="true"></span>
			</button>

			<# if ( slider.index == -1 ) { #>
				<h2 class="butterbean-slide-sortable-handle"><span class="-slide-number">_slide_name_</span></h2>
			<# } else { #>
				<h2 class="butterbean-slide-sortable-handle"><span class="-slide-number">Slide {{ index }}</span> - <span class="-slide-title">{{ slider.heading }}</span></h2>
			<# } #>

			<div class="inside">
				<div class="butterbean-control">
					<span class="butterbean-label">{{ data.l10n.image }}</span>

					<# if ( slider.index == -1 ) { #>
						<input type="hidden" class="butterbean-img-id-input" value="" name="_setting_name_[_index_][image_id]" class="widefat" />
					<# } else { #>
						<input type="hidden" class="butterbean-img-id-input" value="{{ slider.image_id }}" name="{{ data.name }}[{{ index }}][image_id]" class="widefat" />
					<# } #>
					
					<img class="butterbean-img" src="{{ slider.image_src }}" />

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

						<# if ( slider.index == -1 ) { #>
							<input type="text" class="js-butterbean-slide-title widefat" value="" name="_setting_name_[_index_][subheading]" />
						<# } else { #>
							<input type="text" class="js-butterbean-slide-title widefat" value="{{ slider.subheading }}" name="{{ data.name }}[{{ index }}][subheading]" />
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.heading }}</span>

						<# if ( slider.index == -1 ) { #>
							<textarea type="text" class="js-butterbean-slide-title widefat" name="_setting_name_[_index_][heading]"></textarea>
						<# } else { #>
							<textarea type="text" class="js-butterbean-slide-title widefat" name="{{ data.name }}[{{ index }}][heading]">{{ slider.heading }}</textarea>
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.button_link }}</span>
						
						<# if ( slider.index == -1 ) { #>
							<select class="butterbean-slide-select widefat" name="_setting_name_[_index_][button_link]">
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
							<select class="butterbean-slide-select widefat" name="{{ data.name }}[{{ index }}][button_link]">
								<option value="0">- None -</option>
								<# _.each( data.choices, function( choices, index ) { #>
									<optgroup label="{{ index }}">
										<# _.each( choices, function( label, value ) { #>
											<option value="{{ value }}" <# if ( slider.button_link == value ) { #> selected="selected" <# } #>>{{ label }}</option>
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

						<# if ( slider.index == -1 ) { #>
							<input type="text" value="{{ slider.button_external_link }}" name="_setting_name_[_index_][button_external_link]" class="widefat" />
						<# } else { #>
							<input type="text" value="{{ slider.button_external_link }}" name="{{ data.name }}[{{ index }}][button_external_link]" class="widefat" />
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.slide_color }}</span>

						<# if ( slider.index == -1 ) { #>
							<input type="text" value="{{ slider.slide_color }}" name="_setting_name_[_index_][slide_color]" class="widefat" />
						<# } else { #>
							<input type="text" value="{{ slider.slide_color }}" name="{{ data.name }}[{{ index }}][slide_color]" class="widefat" />
						<# } #>
					</label>
				</div>

				<div class="butterbean-control">
					<label>
						<span class="butterbean-label">{{ data.l10n.button_text }}</span>

						<# if ( slider.index == -1 ) { #>
							<input type="text" value="{{ slider.button_text }}" name="_setting_name_[_index_][button_text]" class="widefat" />
						<# } else { #>
							<input type="text" value="{{ slider.button_text }}" name="{{ data.name }}[{{ index }}][button_text]" class="widefat" />
						<# } #>
					</label>
				</div>

				<br />
				<a class="js-butterbean-slide-remove" href="#" class="delete">{{ data.l10n.remove_slide }}</a>
			</div>
		</div>
	<# } ) #>

	<# if ( data.description ) { #>
		<span class="butterbean-description">{{{ data.description }}}</span>
	<# } #>
</div>

<button class="js-butterbean-slide-add button button-primary">{{ data.l10n.add_slide }}</button>