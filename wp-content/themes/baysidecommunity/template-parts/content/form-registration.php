<?php $retailers =[];?>

<div class="grid-container-small">
	<div class="block-9">
		<div class="block-9-inner">
			<form method="POST" action="https://comfortsleep.activehosted.com/proc.php" id="_form_3_" class="_form _form_3 _inline-form _dark section-padding-bottom section-padding-top-half" novalidate>
				<input type="hidden" name="u" value="3" />
				<input type="hidden" name="f" value="3" />
				<input type="hidden" name="s" />
				<input type="hidden" name="c" value="0" />
				<input type="hidden" name="m" value="0" />
				<input type="hidden" name="act" value="sub" />
				<input type="hidden" name="v" value="2" />

				<?php $retailers = get_retailers_title();?>
				<div uk-grid class="_form-content">	
					
					<div class="uk-width-1-2@m">
						<label class="uk-form-label" for="firstname">First name*</label>
			        	<input class="uk-input required" name="firstname" id="firstname" type="text" required>
						
			        </div>
			        <div class="uk-width-1-2@m">
			        	<label class="uk-form-label" for="lastname">Last name*</label>
			        	<input class="uk-input required" name="lastname" id="lastname" type="text" required>
						
					</div>
					<div class="uk-width-1-2@m">
						<label class="uk-form-label" for="email">Email*</label>
						<input class="uk-input required email" name="email" id="email" type="text" required>
						
			        </div>
			        <div class="uk-width-1-2@m">
			        	<label class="uk-form-label" for="phone">Contact Number</label>
			        	<input class="uk-input" name="phone" id="phone" type="text" >
						
					</div>
					<div class="uk-width-1-2@m">
			        	<label class="uk-form-label" for="field[1]">Retailer</label>
						<select class="uk-select" name="field[1]" id="field[1]">
							<option value="">Select Retailer</option>
							<?php if(sizeof($retailers) > 1):?>
								<?php foreach ($retailers as $key=>$retailer) :?>
									<option value="<?php echo $retailer;?>"><?php echo $retailer;?></option>
								<?php endforeach?>
								<?php endif;?>
			            </select>
					</div>
					<div class="uk-width-1-2@m">
			        	<label class="uk-form-label" for="field[2]">State*</label>
						<select class="uk-select required" name="field[2]" id="field[2]" required>
							<option value="">Select State</option>
						    <option value="Queensland">Queensland</option>
						    <option value="New South Wales">New South Wales</option>
						    <option value="Australian Capital Territory">Australian Capital Territory</option>
						    <option value="Victoria">Victoria</option>
						    <option value="South Australia">South Australia</option>
						    <option value="Western Australia">Western Australia</option>
						    <option value="Tasmania">Tasmania</option>
						    <option value="Northern Territory">Northern Territory</option>
			            </select>
					</div>
			        <div class="uk-width-1-2@m">
			        	<label class="uk-form-label" for="field[3]">Date of Purchase</label>
			        	<input type="text" class="uk-input date_field" name="field[3]" value="" placeholder="" />
						
					</div>
					<div class="uk-width-1-2@m">
			        	<label class="uk-form-label" for="field[4]">Bed/Collection Name*</label>
			        	<input class="uk-input required" name="field[4]" id="field[4]" type="text" required>
						
					</div>
					<div class="uk-width-1-1@m">
			        	<label class="uk-form-label" for="field[5]">Serial Number*</label>
			        	<input class="uk-input required" name="field[5]" id="field[5]" type="text" required>
					
			        	<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="info"><path d="M12.13,11.59 C11.97,12.84 10.35,14.12 9.1,14.16 C6.17,14.2 9.89,9.46 8.74,8.37 C9.3,8.16 10.62,7.83 10.62,8.81 C10.62,9.63 10.12,10.55 9.88,11.32 C8.66,15.16 12.13,11.15 12.14,11.18 C12.16,11.21 12.16,11.35 12.13,11.59 C12.08,11.95 12.16,11.35 12.13,11.59 L12.13,11.59 Z M11.56,5.67 C11.56,6.67 9.36,7.15 9.36,6.03 C9.36,5 11.56,4.54 11.56,5.67 L11.56,5.67 Z"></path><circle fill="none" stroke="#585858" stroke-width="1.1" cx="10" cy="10" r="9"></circle></svg><label class="small"> You can find your serial number on a tag located on the rear of your mattress (Where you would place your pillows)</label>

					</div>
					<div class="uk-width-1-1@m uk-margin-medium-top">
						<button id="_form_3_submit" class="button submitbutton _submit" type="submit">Submit</button>
					</div>

				</div>
					
				<div class="_form-thank-you center" style="display:none;"></div>

			</form>
		</div>
	</div>
</div>