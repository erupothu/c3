<?php $this->load->view('common/header.include.php'); ?>

	<h2>Add an Address</h2>
	
	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		<fieldset>
	
			<?php if($this->form_validation->has_errors()): ?>
			<div class="row form-errors">
				<?php echo $this->form_validation->errors(); ?>
			</div>
			<?php endif; ?>
	
			<div class="row<?php echo $this->form_validation->earmark('address_label'); ?>">
				<label for="address_label">Label</label>
				<span><input type="text" name="address_label" id="address_label" value="<?php echo $this->form_validation->value('address_label'); ?>"></span>
				<span>A memorable name for this address</span>
			</div>
	
			<div class="row required<?php echo $this->form_validation->earmark('address_name'); ?>">
				<label for="address_name">Full Name</label>
				<span><input type="text" name="address_name" id="address_name" value="<?php echo $this->form_validation->value('address_name', $this->user->name()); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('address_line1'); ?>">
				<label for="address_line1">Line 1</label>
				<span><input type="text" name="address_line1" id="address_line1" value="<?php echo $this->form_validation->value('address_line1'); ?>"></span>
			</div>

			<div class="row<?php echo $this->form_validation->earmark('address_line2'); ?>">
				<label for="address_line2">Line 2</label>
				<span><input type="text" name="address_line2" id="address_line2" value="<?php echo $this->form_validation->value('address_line2'); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('address_city'); ?>">
				<label for="address_city">Town/City</label>
				<span><input type="text" name="address_city" id="address_city" value="<?php echo $this->form_validation->value('address_city'); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('address_state'); ?>">
				<label for="address_state">State</label>
				<span><input type="text" name="address_state" id="address_state" value="<?php echo $this->form_validation->value('address_state'); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('address_postcode'); ?>">
				<label for="address_postcode">Postcode</label>
				<span><input type="text" name="address_postcode" id="address_postcode" value="<?php echo $this->form_validation->value('address_postcode'); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('address_country'); ?>">
				<label for="address_country">Country</label>
				<span><select name="address_country" id="address_country">
					<option value="">Select Country</option>
					<?php $countries = $this->config->item('alpha-2', 'countries'); if(isset($countries['important']) && count($countries['important']) > 0): ?>
					<option value="">----------------</option>
					<?php foreach($countries['important'] as $iso_code): ?>
					<option value="<?php echo $iso_code; ?>"<?php echo $this->form_validation->selected('address_country', $iso_code, 'UK'); ?>><?php echo htmlentities($countries['countries'][$iso_code], ENT_COMPAT, 'UTF-8', false); ?></option>
					<?php endforeach; endif; ?>
					<option value="">----------------</option>
					<?php foreach($countries['countries'] as $iso_code => $iso_title): ?>
					<option value="<?php echo $iso_code; ?>"<?php echo $this->form_validation->selected('address_country', $iso_code); ?>><?php echo htmlentities($iso_title, ENT_COMPAT, 'UTF-8', false); ?></option>
					<?php endforeach; ?>
				</select></span>
			</div>
	
			<div class="button-row">
				<input type="submit" value="Add Address">
			</div>
	
		</fieldset>
	</form>

<?php $this->load->view('common/footer.include.php'); ?>