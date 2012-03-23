	
	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		
		<?php if($this->form_validation->has_errors()): ?>
		<div class="row form-errors">
			<?php echo $this->form_validation->errors(); ?>
		</div>
		<?php endif; ?>
		
		<fieldset class="contact contact-default">
			
			<input type="hidden" name="contact_origin" value="<?php echo $this->uri->uri_string(); ?>">
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_name'); ?>">
				<label for="contact_name">Name</label>
				<span><input type="text" name="contact_name" id="contact_name" value="<?php echo $this->form_validation->value('contact_name'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_email'); ?>">
				<label for="contact_email">Email Address</label>
				<span><input type="text" name="contact_email" id="contact_email" value="<?php echo $this->form_validation->value('contact_email'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_telephone'); ?>">
				<label for="contact_telephone">Telephone</label>
				<span><input type="text" name="contact_telephone" id="contact_telephone" value="<?php echo $this->form_validation->value('contact_telephone'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_enquiry'); ?>">
				<label for="contact_enquiry">Enquiry</label>
				<span><textarea name="contact_enquiry" id="contact_enquiry" rows="4" cols="40"><?php echo $this->form_validation->value('contact_enquiry'); ?></textarea></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_captcha'); ?>">
				<label for="contact_captcha">Anti Spam</label>
				<span style="float: left; margin-right: 4px;"><img src="<?php echo $captcha; ?>" alt="Anti-Spam Image"></span>
				<span><input name="contact_captcha" id="contact_captcha" class="captcha" autocomplete="off" value="<?php echo $this->form_validation->value('contact_captcha'); ?>"></span>
			</div>
			
			<div class="row button">
				<span><input type="submit" value="Send"></span>
			</div>
			
		</fieldset>
		
	</form>
	