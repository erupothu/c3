
	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		
		<?php if($this->form_validation->has_errors()): ?>
		<div class="row form-errors">
			<?php echo $this->form_validation->errors(); ?>
		</div>
		<?php endif; ?>
		
		<fieldset>
			
			<input type="hidden" name="contact_origin" value="<?php echo $this->uri->uri_string(); ?>">
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_name'); ?>">
				<label for="contact_name">Full Name</label>
				<span><input type="text" name="contact_name" id="contact_name" value="<?php echo $this->form_validation->value('contact_name'); ?>"></span>
			</div>
		
			<div class="row<?php echo $this->form_validation->earmark('contact_company'); ?>">
				<label for="contact_company">Company</label>
				<span><input type="text" name="contact_company" id="contact_company" value="<?php echo $this->form_validation->value('contact_company'); ?>"></span>
			</div>
		
			<div class="row required<?php echo $this->form_validation->earmark('contact_email'); ?>">
				<label for="contact_email">Email Address</label>
				<span><input type="text" name="contact_email" id="contact_email" value="<?php echo $this->form_validation->value('contact_email'); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('contact_telephone'); ?>">
				<label for="contact_telephone">Telephone Number</label>
				<span><input type="text" name="contact_telephone" id="contact_telephone" value="<?php echo $this->form_validation->value('contact_telephone'); ?>"></span>
			</div>
			
			<div class="row<?php echo $this->form_validation->earmark('contact_enquiry_type'); ?>">
				<label for="contact_enquiry_type">Enquiry Type</label>
				<span><select id="contact_enquiry_type" name="contact_enquiry_type">
					<option value="">---select---</option>
					<option value="Risk Management">Risk Management</option>
					<option value="Training">Training</option>
					<option value="Special Projects">Special Projects</option>
				</select></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('contact_enquiry'); ?>">
				<label for="contact_enquiry">Enquiry/Comments</label>
				<span><textarea name="contact_enquiry" id="contact_enquiry"><?php echo $this->form_validation->value('contact_enquiry'); ?></textarea>
			</div>
			
			<div class="row clearfix checkbox<?php echo $this->form_validation->earmark('contact_marketing'); ?>">
				<span><input type="checkbox" name="contact_marketing" id="contact_marketing" value="1"<?php echo $this->form_validation->checked('contact_marketing', '1'); ?>></span>
				<label for="contact_marketing">
					Please tick this box if you do not wish to receive any form of contact from Anubis via email.
				</label>
			</div>
			
			<div class="row button">
				<input type="submit" value="Send">
			</div>
			
			<small class="contact_notes">
				Note: We will not use or pass your details on to any third parties<br />
				Anubis is registered on the Data Protection Public Register with the 
				Information Commissioner's Office with No Z1178771
			</small>
			
		</fieldset>
	</form>
