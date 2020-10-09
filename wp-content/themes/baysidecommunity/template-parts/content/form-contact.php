<?php $submission = contact_submission('Contact Us'); ?>

		<div class="form-outer">
			<form name="contactform" id="contactform" class="validate-form" action="" method="POST">
				<?php if( isset( $submission['success'] ) ) : ?>
					<script type="text/javascript">
      					document.location.href="https://www.comfortsleepbedding.com.au/thank-you/";
					</script>
					<div class="success-msg">
						<h3 class="center">Thank you for your enquiry!</h3>
						<p class="big center">The team at Comfort Sleep will endeavour to contact you as soon as possible.</p>
						<div class="center uk-margin-large-top">
							<a class="button" href="/">Back Home</a>
						</div>
					</div>	
					<style>
							.block-1-inner{
								display: none;
							}
					</style>
				<?php elseif( isset( $submission['error'] ) ) : ?>
					<p class="c-error-message c-message big center"><?php echo $submission['error']; ?></p>
					<style>
							.block-1-inner{
								display: none;
							}
					</style>
				<?php elseif( isset( $submission['recaptcha'] ) ) : ?>
					<p class="c-error-message c-message big center red"><?php echo $submission['recaptcha']; ?></p>
					<div class="center uk-margin-large-top">
						<a class="button" href="/contact">Contact</a>
					</div>
					<style>
							.block-1-inner{
								display: none;
							}
					</style>
				<?php endif; ?>
					<?php if (empty($_POST)){?>
						
							<div uk-grid class="">	
								<div class="uk-width-1-2@m">
									<label class="uk-form-label" for="fname">Name<span class="astrick"><sup>*</sup></span></label>
						        	<input placeholder ="Your name" class="uk-input required" name="fname" id="fname" value="<?php echo isset( $_SESSION['fname'] ) ? $_SESSION['fname'] : ''; ?>" type="text">
									<?php if( isset( $submission['fname'] ) ) : ?>
						            	<div id="fname-error" class="error"><?php echo $submission['fname']; ?></div>
						        	<?php endif; ?>
						        </div>
						        <div class="uk-width-1-2@m">
									<label class="uk-form-label" for="cemail">Email<span class="astrick"><sup>*</sup></span></label>
									<input placeholder ="Your email" class="uk-input required email" name="cemail" id="cemail" value="<?php echo isset( $_SESSION['cemail'] ) ? $_SESSION['cemail'] : ''; ?>" type="email">
									<?php if( isset( $submission['cemail'] ) ) : ?>
						            	<div id="cemail-error" class="error"><?php echo $submission['cemail']; ?></div>
						        	<?php endif; ?>
						        </div>
								<div class="uk-width-1-1">
									<label class="uk-form-label" for="type">Topic<span class="astrick"><sup>*</sup></span></label>
						        	<select class="uk-select required" name="type" id="type">
						               	<option value="">Select an option</option>
						               	<option value="General">General</option>
										<option value="Other">Other</option>
						            </select>
						        </div>	
								
						       
						        <div class="uk-width-1-1">
									<label class="uk-form-label" for="message">Message<span class="astrick"><sup>*</sup></span></label>
						        	<textarea placeholder ="How can we help you?" class="uk-textarea required" rows="5" name="message" id="message"></textarea>
						        </div>	
							</div>
							<div class="center uk-margin-medium-top">

								<div class="g-recaptcha" data-sitekey="6LccwS8UAAAAAMV_c_7n4zVmDAgudcf2PVf88_tn"></div>
								<?php if( isset( $submission['recaptcha'] ) ) : ?>
					            	<div id="recaptcha-error" class="error"><?php echo $submission['recaptcha']; ?></div>
					        	<?php endif; ?>
					        </div>

							<div class="uk-margin-medium-top">
	
									<input class="button btn-blue" name="submit" type="submit" value="Submit" />
							
							</div>

					<?php }?>
			</form>
		</div>
	